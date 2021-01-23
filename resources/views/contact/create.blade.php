

@extends('layouts.app')

@section('content')
    <a href="/administration/contacts" class="btn btn-default" style="margin-left:31% !important">Back</a>
    <h1 class="center-align">Add the contact</h1>

<div id='contactsList' class="col-md-offset-3">
    <h2>Contacts</h2>
    <table class='contactsEditor'>
        <tr>
            <th>First name</th>
            <th>Last name</th>`
            <th>Phone numbers</th>
        </tr>
        <tbody data-bind="foreach: contacts">
        <tr>
            <td>
                <input class="form-control" data-bind='value: firstName' placeholder="First name" />
                <div><a href='#' data-bind='click: $root.removeContact'>Delete</a></div>
            </td>
            <td>
                <input class="form-control margin-input" data-bind='value: lastName' placeholder="Last name" />

            </td>


            <td>
                <table>
                    <tbody data-bind="foreach: phones">
                    <tr>
                        <td><input class="form-control" data-bind='value: type' placeholder="Phone type"></td>
                        <td><input class="form-control" data-bind='value: number' placeholder="Phone number"/></td>
                        <td><a href='#' data-bind='click: $root.removePhone'>Delete</a></td>
                    </tr>
                    </tbody>
                </table>
                <a href='#' data-bind='click: $root.addPhone'>Add number</a>
            </td>
        </tr>
        </tbody>
    </table>
    <p>
        <button class="btn btn-primary" data-bind='click: addContact'>Add a contact</button>
        <button class="btn btn-success"data-bind='click: save, enable: contacts().length > 0'>Save </button>
    </p>
</div>
@endsection
