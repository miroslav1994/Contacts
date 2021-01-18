

@extends('layouts.app')

@section('content')
    <a href="/users" class="btn btn-default" style="margin-left:31% !important">Back</a>
    <h1 style="text-align:center">Add the contact</h1>
    <form method="post">
        <div data-bind="foreach: myFieldList">
            <div>
                <label data-bind="text: label_fn"></label>
                <input data-bind="attr: { name: fname}">
                <label data-bind="text: label_ln"></label>
                <input data-bind="attr: { name: lname}">
                <div data-bind="foreach: myFieldList2" style="display:inline">
                    <label data-bind="text: label_pt"></label>
                    <select data-bind="attr: { name: phone_type}">
                        @foreach ($phone_types as $phone_type)
                        <option value="{{$phone_type->id}}">{{$phone_type->name}}</option>
                        @endforeach
                    </select>
                    <label data-bind="text: label_p"></label>
                    <input data-bind="attr: { name: phone}">
                <span id="addVar" data-bind="click: addField2" style="color:green">Add Number</span>
                <span class="removeVar" data-bind="click: removeField2" style="color:red">Remove Number</span>
                </div>

            </div>
            <span class="removeVar" data-bind="click: removeField">Remove Variable</span>
        </div>

        <p>
            <span id="addVar" data-bind="click: addField">Add Contact</span>
        </p>

        <p class="alignRight">
            <input type="submit" value="Check">
        </p>

    </form>

@endsection
