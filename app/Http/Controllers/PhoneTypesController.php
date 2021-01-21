<?php

namespace App\Http\Controllers;

use App\Models\PhoneType;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StorePhoneTypeRequest;

class PhoneTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phone_types = PhoneType::orderBy('id')->paginate(10);
        return view('phone_type.index')->with('phone_types', $phone_types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phone_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhoneTypeRequest $request)
    {
        $validated = $request->validated();

        $phone_type = new PhoneType;
        $phone_type->name = $request->input('name');
        $phone_type->save();

        return redirect('/phone_types')->with('success', 'The phone type is added successfully!');
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
        $phone_type = PhoneType::find($id);
        return view('phone_type.edit')->with('phone_type', $phone_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePhoneTypeRequest $request, $id)
    {
        $validated = $request->validated();
        $phone_type = PhoneType::find($id);
        $phone_type->name = $request->input('name');
        $phone_type->save();

        return redirect('/phone_types')->with('success', 'The phone type is added successfullyn');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $phone_type = PhoneType::find($id);
        $phone_type->delete();

        return redirect('/phone_types')->with('success', 'The phone type is deleted successfully!');
    }
}
