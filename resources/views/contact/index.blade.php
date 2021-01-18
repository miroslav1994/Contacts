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
                <th style="width:10% !important; text-align:center;">Name</th>
                <th style="width:12% !important; text-align:center;">Phone type</th>
                <th style="width:10% !important; text-align:center;">Phone</th>
                <th style="width:20% !important; text-align:center;">Edit</th>
                <th style="width:20% !important; text-align:center;">Delete</th>
            </tr>
            @foreach ($contacts as $contact)
            <?php


            ?>
                <tr>
                    <td style="width:5% !important">{{$contact->id}}</td>
                    <td style="width:10% !important">{{$contact->name}}</td>
                    <td style="width:12% !important">{{$contact->phone_type_id}}</td>
                    <td style="width:10% !important">{{$contact->phone}}</td>
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
