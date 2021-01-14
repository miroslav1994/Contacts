@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align:center;">Roles</h1>
        <br /><br />
        <a href="/roles/create" class="btn btn-primary" style="float:right;"> Add the role</a>
        <br />
        <br />
        <br />
        <table class="table table-striped table-hover" style="text-align:center;width:100%; ">
            <tr>
                <th style="width:5% !important; text-align:center;">ID</th>
                <th style="width:10% !important; text-align:center;">Name</th>
                <th style="width:20% !important; text-align:center;">Edit</th>
                <th style="width:20% !important; text-align:center;">Delete</th>
            </tr>
            @foreach ($roles as $role)
                <tr>
                    <td style="width:5% !important">{{$role->id}}</td>
                    <td style="width:10% !important">{{$role->name}}</td>
                    <td style="width:30% !important">
                        <a href="/roles/{{$role->id}}/edit" class="btn btn-default">Edit</a><br />
                    </td>
                    <td style="width:30% !important">
                        <form action="/roles/{{$role->id}}" method="POST">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $roles->links() }}
    </div>


@endsection
