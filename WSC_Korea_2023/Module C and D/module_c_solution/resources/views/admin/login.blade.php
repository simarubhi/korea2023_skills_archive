@extends('layouts.app')
@section('title', 'Admin login')
@section('content')
<div class="w-100 vh-100 d-flex align-items-center justify-content-center">
    <main style="width: 350px">
        <form method="POST" action="">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            @if($errors->has('login'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('login')}}
                </div>
            @endif

            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                <label for="username">Username</label>
                @if ($errors->has('username'))
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Sign in</button>
        </form>
    </main>
</div>
@endsection
