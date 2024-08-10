@extends('layouts.admin')
@section('title', 'Admin Users')
@section('main')
<table class="table table-striped">
    <thead>
        <tr>
            <th>Username</th>
            <th>Created at</th>
            <th>Last login</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->last_login_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
