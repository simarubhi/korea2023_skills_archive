<header class="position-absolute top-0 vw-100">
    <nav class="navbar  p-2" style="background-color: #e3f2fd;"">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard')}}">Dashboard</a>
            <div class="d-flex justify-content-center align-items-center gap-3">
              <span class="fw-medium">Current Admin: {{ Auth::guard('admin')->user()->username }}</span>

              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
              </form>

            </div>
        </div>
    </nav>
</header>