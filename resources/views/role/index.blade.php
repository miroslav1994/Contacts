@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="center-align">Roles</h1>
        <br /><br />
        <a href="/administration/roles/create" class="btn btn-primary btn-float"> Add the role</a>
        <br />
        <br />
        <br />
        <table class="table table-striped table-hover" style="text-align:center;width:100%; ">
            <tr>
                <th class="td-width-5 center-align">ID</th>
                <th class="td-width-10 center-align">Name</th>
                <th class="td-width-20 center-align">Edit</th>
                <th class="td-width-20 center-align">Delete</th>
            </tr>
            @foreach ($roles as $role)
                <tr>
                    <td class="td-width-5">{{$role->id}}</td>
                    <td class="td-width-10">{{$role->name}}</td>
                    <td class="td-width-30">
                        <a href="/administration/roles/{{$role->id}}/edit" class="btn btn-default">Edit</a><br />
                    </td>
                    <td class="td-width-30">
                        <form action="/administration/roles/{{$role->id}}" method="POST">
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
