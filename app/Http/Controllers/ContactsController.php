<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\PhoneType;
use App\Models\Phone;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
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
        $phone_types = PhoneType::orderBy('id')->paginate(10);
        return view('contact.create')->with('phone_types', $phone_types);
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

            $contact_new = new Contact;
            $contact_new->first_name = $contact->firstName;
            $contact_new->last_name = $contact->lastName;
            $contact_new->save();

            for($i = 0;$i<count($contact->phones); $i++) {
                $contact_phone = new Phone();
                $contact_phone->contact_id = $contact_new->id;
                $contact_phone->phone_type_id = $contact->phones[$i]->type;
                $contact_phone->phone = $contact->phones[$i]->number;
                $contact_phone->save();
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
        //
    }
}
