<x-head title='Login' />
    <body class="vw-100 vh-100 d-grid">
        <div class="d-flex justify-content-center align-items-center gap-3">

			@if ($errors->any())
			<div class="alert alert-danger position-absolute mt-2.translate-middle-x right-50 z-3" style="top: 10%;">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif

            <div class="card text-center mb-3 p-3">

                <form method="POST" action={{ route('login')}}>
                  @csrf
                    <span class="d-block fs-3 fw-semibold mb-2">Admin Login</span>
                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" id="username" name="username" aria-describedby="username">
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                  </form>
              </div>
        </div>
    </body>
</html>
