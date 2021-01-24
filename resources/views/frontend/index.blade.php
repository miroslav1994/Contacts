@extends('layouts.app_frontend')

@section('content')
<section>
    <!--for demo wrap-->
    <h1><a href="/" style="text-decoration: none; color:white;">Contacts</a></h1>

    <form action="{{ action('SearchController@search') }}" method="POST" role="SearchContact">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <div class="col-md-offset-5 col-md-3 ">
            <div class="input-group">
                <input type="text" class="form-control" name="search" @if(!empty($search)) value="{{$search}} @endif" placeholder="Search"> <span class="input-group-btn">
                 <button type="submit" class="btn btn-default">
                     <span class="glyphicon glyphicon-search"></span>
                 </button>
             </span>
            </div>
        </div>
    </form>
    <div class="tbl-header">
        <table cellpadding="0" cellspacing="0" border="0">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last name</th>
                <th>Phone type</th>
                <th>Phone</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="tbl-content">
        <table cellpadding="0" cellspacing="0" border="0">
            <tbody>
            @foreach($contacts as $contact)
                <?php
                    $phones_string = "";
                    $phones_string_types = "";
                ?>
                @foreach($contact->phones as $contact_phone)
                    <?php
                        $phones_string .= $contact_phone->phone . "\r\n";
                        $phones_string_types .= $contact_phone->type . "\r\n";
                    ?>
                @endforeach
                <?php
                    $phones_string = rtrim($phones_string, "\r\n");
                    $phones_string_types = rtrim($phones_string_types, "\r\n");
                ?>

                <tr>
                    <td>{{$contact->first_name}}</td>
                    <td>{{$contact->last_name}}</td>
                    <td>{{$phones_string_types}}</td>
                    <td>{{$phones_string}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection
