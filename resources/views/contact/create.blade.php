

@extends('layouts.app')

@section('content')
    <a href="/users" class="btn btn-default" style="margin-left:31% !important">Back</a>
    <h1 style="text-align:center">Add the contact</h1>
<h2>Contacts</h2>
<div id='contactsList'>
    <table class='contactsEditor'>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Phone numbers</th>
        </tr>
        <tbody data-bind="foreach: contacts">
        <tr>
            <td>
                <input data-bind='value: firstName' />
                <div><a href='#' data-bind='click: $root.removeContact'>Delete</a></div>
            </td>
            <td><input data-bind='value: lastName' /></td>
            <td>
                <table>
                    <tbody data-bind="foreach: phones">
                    <tr>
                        <td><select data-bind='value: type' >
                                @foreach($phone_types as $phone_type)
                                    <option value="{{$phone_type->id}}">{{$phone_type->name}}</option>
                                @endforeach
                            </select></td>
                        <td><input data-bind='value: number' /></td>
                        <td><a href='#' data-bind='click: $root.removePhone'>Delete</a></td>
                    </tr>
                    </tbody>
                </table>
                <a href='#' data-bind='click: $root.addPhone'>Add number</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<p>
    <button data-bind='click: addContact'>Add a contact</button>
    <button data-bind='click: save, enable: contacts().length > 0'>Save </button>
</p>


@endsection
