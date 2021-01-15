@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align:center;">Users</h1>
        <br /><br />
        <a href="/users/create" class="btn btn-primary" style="float:right;"> Add the user</a>
        <br />
        <br />
        <br />
        <table class="table table-striped table-hover" style="text-align:center;width:100%; ">
            <tr>
                <th style="width:5% !important; text-align:center;">ID</th>
                <th style="width:10% !important; text-align:center;">Name</th>
                <th style="width:12% !important; text-align:center;">Email</th>
                <th style="width:10% !important; text-align:center;">Role</th>
                <th style="width:20% !important; text-align:center;">Edit</th>
                <th style="width:20% !important; text-align:center;">Delete</th>
            </tr>
            @foreach ($users as $user)
            <?php


            ?>
                <tr>
                    <td style="width:5% !important">{{$user->id}}</td>
                    <td style="width:10% !important">{{$user->name}}</td>
                    <td style="width:12% !important">{{$user->email}}</td>
                    <td style="width:10% !important">{{$user->roles->name}}</td>
                    <td style="width:30% !important">
                        <a href="/users/{{$user->id}}/edit" class="btn btn-default">Edit</a><br />

                    </td>
                    <td style="width:30% !important">
                        <form action="/users/{{$user->id}}" method="POST">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $users->links() }}
    </div>


@endsection
