<header>
  <nav class="navbar bg-primary">
      <div class="container-fluid" style="padding: 0 35px;">
        <a class="navbar-brand text-white" href="{{ route('admin-login-view')}}">Home</a>

        <form method="POST" action="{{ route('admin-logout')}}">
          @csrf
          <button type="submit" class="btn btn-danger">Logout</button>
        </form>
      </div>
  </nav>
</header>