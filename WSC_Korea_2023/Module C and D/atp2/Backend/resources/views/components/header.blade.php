<header>
  <nav class="navbar bg-primary">
      <div class="container">
        <a class="navbar-brand text-white" href="{{ route('admin-login-view')}}">Dashboard</a>

        <div class="d-flex justify-content-center align-items-center gap-4">
          <span class="fw-semibold text-white ">Current Admin: {{ Auth::guard('admin')->user()->username }}</span>

          <form method="POST" action="{{ route('admin-logout')}}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
          </form>
        </div>

      </div>
  </nav>
</header>