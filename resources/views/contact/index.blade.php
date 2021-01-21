@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align:center;">Contacts</h1>
        <br /><br />
        <a href="/contacts/create" class="btn btn-primary" style="float:right;"> Add the contact</a>
        <br />
        <br />
        <br />
        <table class="table table-striped table-hover" style="text-align:center;width:100%; ">
            <tr>
                <th style="width:5% !important; text-align:center;">ID</th>
                <th style="width:10% !important; text-align:center;">First Name</th>
                <th style="width:10% !important; text-align:center;">Last Name</th>
                <th style="width:12% !important; text-align:center;">Phone type</th>
                <th style="width:10% !important; text-align:center;">Phone</th>
                <th style="width:20% !important; text-align:center;">Edit</th>
                <th style="width:20% !important; text-align:center;">Delete</th>
            </tr>
            <?php $phones_string = ""; ?>
            @foreach ($contacts as $contact)
                @foreach($contact->phones as $contact_phone)
                    <?php
                        $phones_string .= $contact_phone->phone . ";";
                    ?>
                @endforeach
                <?php
                    $phones_string = rtrim($phones_string, ";");
                ?>

                <tr>
                    <td style="width:5% !important">{{$contact->id}}</td>
                    <td style="width:10% !important">{{$contact->first_name}}</td>
                    <td style="width:10% !important">{{$contact->last_name}}</td>
                    <td style="width:10% !important"></td>
                    <td style="width:10% !important">{{$phones_string}}</td>
                    <td style="width:30% !important">
                        <a href="/contacts/{{$contact->id}}/edit" class="btn btn-default">Edit</a><br />

                    </td>
                    <td style="width:30% !important">
                        <form action="/users/{{$contact->id}}" method="POST">
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
