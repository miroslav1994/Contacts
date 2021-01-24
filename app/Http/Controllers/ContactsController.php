<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Phone;
use App\Models\Role;
use App\Policies\ContactPolicy;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

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

    public function edit($id)
    {
        $contact = Contact::find($id);
        $phones = Phone::where('contact_id', '=', $id)->get();

        $data = [
            'contact' => $contact,
            'phones' => $phones
        ];

        return view('contact.edit')->with($data);
    }

    public function update(Request $request) {
        $array_contacts = json_decode($request->input('contacts'));

        foreach($array_contacts as $contact) {

            if(empty($contact->firstName) || empty($contact->lastName)) {

                return Response::json(array(
                    'success' => false,
                    'data'   => 'You cannot save contact without first name or last name'
                ));
            }

            $contact_edit = Contact::find($contact->contact_id);
            $contact_edit->first_name = $contact->firstName;
            $contact_edit->last_name = $contact->lastName;
            $contact_edit->save();

            //insert into table phones
            foreach ($contact->phones as $phone) {

                if(empty($phone->type) || empty($phone->number)) {

                    return Response::json(array(
                        'success' => false,
                        'data'   => 'You cannot save contact without type or phone'
                    ));
                }

                $phones_all = Phone::where('phone', '=', $phone->number)
                                    ->where('id', '!=', $phone->phones_id)
                                    ->first();
                if(!empty($phones_all)) {
                    return Response::json(array(
                        'success' => false,
                        'data'   => 'Phone already exists'
                    ));
                }
                $phone_edit = Phone::find($phone->phones_id);
                $phone_edit->type = $phone->type;
                $phone_edit->phone = $phone->number;
                $phone_edit->save();

            }
        }
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

            if(empty($contact->firstName) || empty($contact->lastName)) {
                return Response::json(array(
                    'success' => false,
                    'data'   => 'You cannot add contact with empty first name or last name'
                ));
            }
            //insert into table contacts
            $new_contact_arr = [
                'first_name' => $contact->firstName,
                'last_name' => $contact->lastName
            ];
            //insert into table phones
            foreach ($contact->phones as $key => $phone) {
                if(empty($phone->type) || empty($phone->number)) {

                    return Response::json(array(
                        'success' => false,
                        'data'   => 'You cannot save contact without type or phone'
                    ));
                }

                if ($key == 0) {
                    $new_contact = Contact::create($new_contact_arr);
                }

                $phones_all = Phone::where('phone', '=', $phone->number)->first();
                if(!empty($phones_all)) {
                    return Response::json(array(
                        'success' => false,
                        'data'   => 'Phone already exists'
                    ));
                }
                $phone = Phone::create([
                    'type'=> $phone->type,
                    'contact_id' => $new_contact->id,
                    'phone' => $phone->number
                ]);
            }
        }
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
