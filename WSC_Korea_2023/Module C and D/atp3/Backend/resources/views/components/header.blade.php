<header>
  <nav class="navbar navbar-expand-lg bg-body-secondary">
      <div class="container-lg">
        <a class="navbar-brand" href="{{ route('admin-dashboard')}}">Dashboard</a>
  
        <div class="d-flex justify-content-center align-items-center gap-3 ">
          <span class="fs-5 fw-3">Current Admin: <span class="fw-semibold">{{ Auth::user()->username; }}</span></span>
  
          <form method="POST" action="{{ route('admin-logout')}}">
              @csrf
          <button class="btn btn-danger">Logout</button>
          </form>
        </div>
      </div>
    </nav>
</header>