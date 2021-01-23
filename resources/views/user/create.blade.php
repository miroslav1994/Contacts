

@extends('layouts.app')

@section('content')
    <a href="/administration/users" class="btn btn-default back-btn-margin">Back</a>
    <h1 class="center-align">Add the user</h1>
    <form action="{{ action('UsersController@store') }}" method="POST" enctype="multipart/form-data">
        <div class="container width-div-40">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm password">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="role_id">The role</label>
                <select id="role_id" name="role_id" class="form-control">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                </select>
            </div>
            <div class="center-align">
                <button type="submit" id="addUser" class="btn btn-success">Save</button>
                <button type="reset" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </form>
@endsection
