<x-head title='Login' />
    <body class="d-flex justify-content-center align-items-center vw-100 vh-100">
      @if ($errors->any())
      <div class="alert alert-danger position-absolute translate-middle-x" style="top: 50px; left: 50%;">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif


        <div class="card p-4">
            <div class="card-header mb-3">
                <h2>Admin Login</h2>
              </div>
            <form method="POST" action="{{ route('admin-login')}}">
                @csrf
                <div class="mb-3">
                  <label for="username"class="form-label">username</label>
                  <input type="text" name="username"  class="form-control" id="username" aria-describedby="username">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </body>
</html>
