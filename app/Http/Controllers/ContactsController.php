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
        $this->middleware(function ($request, $next) {
            $user = Auth::user();


            if ($user->role->name != 'admin') {
                return redirect()->back();
            }


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
        $contacts = Contact::orderBy('id')->paginate(10);
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

            $new_contact = Contact::create([
                'first_name' => $contact->firstName,
                'last_name' => $contact->lastName
            ]);

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

        foreach ($phones as $phone) {
            $phone->delete();
        }

        $contact->delete();

        return redirect('/contacts')->with('success', 'The contact is deleted successfully!');
    }
}
