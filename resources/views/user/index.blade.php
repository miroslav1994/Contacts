@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="center-align">Users</h1>
        <br /><br />
        <a href="/administration/users/create" class="btn btn-primary back-btn-margin"> Add the user</a>
        <br />
        <br />
        <br />
        <table class="table table-striped table-hover center-align full-width" >
            <tr>
                <th class="td-width-5 center-align">ID</th>
                <th class="td-width-10 center-align">Name</th>
                <th class="td-width-12 center-align">Email</th>
                <th class="td-width-10 center-align">Role</th>
                <th class="td-width-20 center-align">Edit</th>
                <th class="td-width-20 center-align">Delete</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td class="td-width-5">{{$user->id}}</td>
                    <td class="td-width-10">{{$user->name}}</td>
                    <td class="td-width-12">{{$user->email}}</td>
                    <td class="td-width-10">@if(!empty($user->role)) {{$user->role->name}} @endif</td>
                    <td class="td-width-30">
                        <a href="/administration/users/{{$user->id}}/edit" class="btn btn-default">Edit</a><br />

                    </td>


                    <td class="td-width-30">
                        @if(Auth::id() != $user->id)
                            <form action="/administration/users/{{$user->id}}" method="POST">
                                {{ method_field('DELETE') }}
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $users->links() }}
    </div>
@endsection
