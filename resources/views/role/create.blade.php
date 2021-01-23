@extends('layouts.app')

@section('content')
    <a href="/administration/roles" class="btn btn-default back-btn-margin">Back</a>
    <h1 style="center-align">Add new role</h1>
    <form action="{{ action('RolesController@store') }}" method="POST" enctype="multipart/form-data">
        <div class="container width-div-40">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="center-align">
                <button type="submit" id="addRoles" class="btn btn-success">Save</button>
                <button type="reset" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </form>

@endsection
