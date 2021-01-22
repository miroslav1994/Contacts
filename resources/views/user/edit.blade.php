

@extends('layouts.app')

@section('content')
    <a href="/users" class="btn btn-default" style="margin-left:31% !important">Back</a>
    <h1 style="text-align:center">Edit the user</h1>
    <form action="/users/{{$user->id}}" method="POST" enctype="multipart/form-data">
        <div class="container" style="width:40%;">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{$user->name}}">
                </div>
                <!--<div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="{{$user->password}}">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm password" value="{{$user->password}}">
                </div>-->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="{{$user->email}}">
                    <input type="hidden" value="{{ $user->id }}" name="user_id">
                </div>
                <div class="form-group">
                    <label for="role_id">The role</label>
                    <select id="role_id" name="role_id" class="form-control">
                            @foreach($roles as $role)
                                <?php $selected = '' ?>;
                                @if($role->id == $user->role_id) <?php $selected = 'selected' ?>;
                                @endif
                                <option value="{{$role->id}}" <?php echo $selected; ?> >{{$role->name}}</option>
                            @endforeach
                    </select>
                </div>
                <div style="text-align:center;">
                    <button type="submit" id="editCompany" class="btn btn-success">Save</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
            </div>
    </form>

@endsection
