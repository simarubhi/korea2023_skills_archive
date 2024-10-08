<x-head title='Login' />
<body class="vw-100 vh-100 d-flex justify-content-center align-items-center">
        
    @if ($errors->any())
    	<div class="alert alert-danger position-absolute top-0" style="transform: translateY(150px) !important;">
			<ul>
				@foreach ($errors->all() as $error)    
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
    @endif

    <div class="card p-4" style="width:400px;">
        <div class="card-header mb-3"><span class="fs-3 fw-semibold">Admin Login</span></div>
        <form method="POST" action="{{ route('admin-login') }}">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" >
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
    </div>
</body>
</html>
