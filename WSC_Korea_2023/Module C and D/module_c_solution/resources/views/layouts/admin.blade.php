@extends('layouts.app')
@section('content')
<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ url('/admin/user') }}" class="nav-link px-2 text-{{ request()->is('admin/user') ? 'secondary' : 'white' }}">Admin Users</a></li>
                <li><a href="{{ url('/user') }}" class="nav-link px-2 text-{{ request()->is('user') ? 'secondary' : 'white' }}">Platform Users</a></li>
                <li><a href="{{ url('/game') }}" class="nav-link px-2 text-{{ request()->is('game') ? 'secondary' : 'white' }}">Games</a></li>
            </ul>

            <div class="text-end">
                <a href="{{ url('/admin/logout') }}" class="btn btn-outline-light me-2">Logout</a>
            </div>
        </div>
    </div>
</header>
<main class="container">
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@yield('title')</h1>
    </div>
    @yield('main')
</main>
@endsection
