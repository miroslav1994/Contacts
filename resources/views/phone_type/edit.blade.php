

@extends('layouts.app')

@section('content')
    <a href="/phone_types" class="btn btn-default" style="margin-left:31% !important">Back</a>
    <h1 style="text-align:center">Edit phone type</h1>
    <form action="/phone_types/{{$phone_type->id}}" method="POST" enctype="multipart/form-data">
        <div class="container" style="width:40%;">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            {{ method_field('PATCH') }}

                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{$phone_type->name}}">
                </div>
                <div style="text-align:center;">
                    <button type="submit" id="addPhoneTypes" class="btn btn-success">Save</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
            </div>
    </form>
@endsection
