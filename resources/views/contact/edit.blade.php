@extends('layouts.app')

@section('content')
<a href="/administration/contacts" class="btn btn-default" style="margin-left:31% !important">Back</a>
<h1 class="center-align">Edit the contact</h1>

<div id='contactsList' class="col-md-offset-3">
    <h2>Contacts</h2>
    <table class='contactsEditor'>
        <tr>
            <th>First name</th>
            <th>Last name</th>`
            <th>Phone numbers</th>
        </tr>
        <?php
            $types_string = "";
            $phones_string = "";
            $phones_id_string = "";
        ?>
        @foreach($phones as $phone)
            <?php
                $types_string .= $phone->type . ",";
                $phones_string .= $phone->phone . ",";
                $phones_id_string .= $phone->id . ",";
            ?>
        @endforeach
        <?php
            $types_string = rtrim($types_string, ",");
            $phones_string = rtrim($phones_string, ",");
            $phones_id_string = rtrim($phones_id_string, ",");
        ?>
        <input type="hidden" id="is_edit_id" value="1" />
        <input type="hidden" id="contact_id_edit" value="{{$contact->id}}" />
        <input type="hidden" id="firstName_contact" value="{{$contact->first_name}}" />
        <input type="hidden" id="lastName_contact" value="{{$contact->last_name}}" />
        <input type="hidden" id="type_phone" name="type_phone[]" value="{{$types_string}}" />
        <input type="hidden" id="phone_number" name="phones_number[]" value="{{$phones_string}}" />
        <input type="hidden" id="phone_id" name="phone_id[]" value="{{$phones_id_string}}" />

        <tbody data-bind="foreach: contacts">
            <tr>
                <td>
                    <input class="form-control" data-bind='value: firstName' placeholder="First name" value="{{$contact->first_name}}"/>
                </td>
                <td>
                    <input class="form-control" data-bind='value: lastName' placeholder="Last name" value="{{$contact->last_name}}" />
                </td>
                <td>
                    <table>
                        <tbody data-bind="foreach: phones">
                        <tr>
                            <td><input class="form-control" data-bind='value: type' placeholder="Phone type"></td>
                            <td><input class="form-control" data-bind='value: number'  placeholder="Phone number"/></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <p>
        <button class="btn btn-success"data-bind='click: save, enable: contacts().length > 0'>Save </button>
    </p>
</div>
@endsection
