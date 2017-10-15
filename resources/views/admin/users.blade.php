@extends('template')


@section('content')
    @include('admin.menu')
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Last login date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key=>$user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->last_login}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

