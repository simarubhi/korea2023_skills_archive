@extends('layouts.admin')
@section('title', 'Platform Users')
@section('main')
<table class="table table-striped">
    <thead>
        <tr>
            <th>Username</th>
            <th>Created at</th>
            <th>Last login</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->last_login_at }}</td>
                <td>
                    @if($user->trashed())
                        <form method="POST" action="{{ url('/user/'.$user->id.'/unlock') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Unlock</button>
                        </form>
                    @else
                        <form method="POST" action="{{ url('/user/'.$user->id.'/lock') }}">
                            @csrf
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Lock
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <button type="submit" class="dropdown-item" name="reason" value="spamming">Spamming</a>
                                    </li>
                                    <li>
                                        <button type="submit" class="dropdown-item" name="reason" value="cheating">Cheating</a>
                                    </li>
                                    <li>
                                        <button type="submit" class="dropdown-item" name="reason" value="other">Other</a>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
