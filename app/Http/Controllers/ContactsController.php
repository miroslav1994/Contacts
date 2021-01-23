<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Phone;
use App\Policies\ContactPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ContactsController extends Controller
{
    public function __construct()
    {
        //Check if user is admin
        $this->middleware(function ($request, $next) {

            if(Gate::denies('checkIsAdmin', [Contact::class])) return redirect()->back();

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('first_name')
                            ->orderBy('last_name')
                            ->paginate(10);
        return view('contact.index')->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $array_contacts = json_decode($request->input('contacts'));
        foreach($array_contacts as $contact) {
            //insert into table contacts
            $new_contact = Contact::create([
                'first_name' => $contact->firstName,
                'last_name' => $contact->lastName
            ]);
            //insert into table phones
            foreach ($contact->phones as $phone) {
                $phone = Phone::create([
                    'type'=> $phone->type,
                    'contact_id' => $new_contact->id,
                    'phone' => $phone->number
                ]);
            }
        }

        return redirect('/contacts')->with('success', 'Action is performed successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $phones = $contact->phones;
        //delete phones for this contact
        foreach ($phones as $phone) {
            $phone->delete();
        }
        $contact->delete();

        return redirect('/administration/contacts')->with('success', 'The contact is deleted successfully!');
    }
}
