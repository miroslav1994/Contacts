@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="center-align">Contacts</h1>
        <br /><br />
        <a href="/administration/contacts/create" class="btn btn-primary btn-float"> Add the contact</a>
        <br />
        <br />
        <br />
        <table class="table table-striped table-hover center-align full-width" >
            <tr>
                <th class="td-width-5 center-align">ID</th>
                <th class="td-width-10 center-align">First Name</th>
                <th class="td-width-10 center-align">Last Name</th>
                <th class="td-width-12 center-align">Phone type</th>
                <th class="td-width-10 center-align">Phone</th>
                <th class="td-width-20 center-align">Delete</th>
            </tr>

            @foreach ($contacts as $contact)
                <?php
                    $phones_string = "";
                    $phones_string_types = "";
                ?>
                @foreach($contact->phones as $contact_phone)
                    <?php
                        $phones_string .= $contact_phone->phone . "\r\n";
                        $phones_string_types .= $contact_phone->type . "\r\n";
                    ?>
                @endforeach
                <?php
                    $phones_string = rtrim($phones_string, "\r\n");
                    $phones_string_types = rtrim($phones_string_types, "\r\n");
                ?>
                <tr>
                    <td class="td-width-5">{{$contact->id}}</td>
                    <td class="td-width-10">{{$contact->first_name}}</td>
                    <td class="td-width-10">{{$contact->last_name}}</td>
                    <td style="">{{$phones_string_types}}</td>
                    <td style="">{{$phones_string}}</td>
                    <td class="td-width-30">
                        <form action="/contacts/{{$contact->id}}" method="POST">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $contacts->links() }}
    </div>
@endsection
