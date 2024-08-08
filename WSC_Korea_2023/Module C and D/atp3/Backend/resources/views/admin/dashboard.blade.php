<x-head title='Dashboard' />
<body class="">
    <x-header />

    <main class="container-lg mt-4">
        <h1>Admin Dashboard</h1>

        <div class="container-fluid mt-4">
            <h2>Admins</h2>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Created</th>
                    <th scope="col">Last Login</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                      <th scope="row">{{ $admin->id }}</th>
                      <td>{{ $admin->username }}</td>
                      <td>{{ $admin->registered_at }}</td>
                      <td>{{ $admin->last_login_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>

        <div class="container-fluid mt-4">
            <h2>Users</h2>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Created</th>
                    <th scope="col">Last Login</th>
                    <th scope="col">Profile Page</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="@if ($user->trashed()) table-danger @endif">
                      <th scope="row">{{ $user->id }}</th>
                      <td>{{ $user->username }}</td>
                      <td>{{ $user->registered_at }}</td>
                      <td>{{ $user->last_login_at }}</td>
                      <td><a href="{{ route('user-page', $user->username)}}">Profile Page</a></td>
                      @if (!$user->trashed())
                      <td>
                        <form method="POST" action="{{ route('user-block', $user->id)}}" class="d-flex gap-3">
                            @csrf
                            @method('DELETE')
                            <select id="block-reason" class="form-select" name="reason">
                                <option value="general">General</option>
                                <option value="spam">Spam</option>
                                <option value="cheating">Cheating</option>
                            </select>

                            <button type="submit" class="btn btn-danger">Block</button>
                        </form>
                      </td>
                      @else
                      <td>
                        <form method="POST" action="{{ route('user-unblock', $user->id)}}" class="d-flex gap-3">
                            @csrf
                            <button type="submit" class="btn btn-success">Unblock</button>
                        </form>
                      </td>
                      @endif
                    </tr>
                    @endforeach
                </tbody>
              </table>

              <div class="container-fluid mt-4">
                <h2>Users</h2>
    
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Author</th>
                        <th scope="col">Versions</th>
                        <th scope="col">Game Page</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($games as $game)
                        <tr class="@if ($game->trashed()) table-danger @endif">
							<td></td>
							<th scope="row">{{ $game->id }}</th>
							<td>{{ $game->title }}</td>
							<td>{{ $game->description }}</td>
							<td>
								@foreach ($game->versions as $version)
									@if ($loop->last)
										<span>{{ $version->version_time }} </span>
									@else
										<span>{{ $version->version_time }} |</span>
									@endif
								@endforeach
							</td>
							<td>{{ $game->author->username }}</td>
							<td><a href="{{ route('game-page', $game->slug)}}">Game Page</a></td>
							@if (!$game->trashed())
							<td>
								<form method="POST" action="{{ route('game-delete', $game->id)}}">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger">Delete Game</button>
								</form>
							</td>
							@else
							<td>
								<span>Game is deleted</span>
							</td>
							@endif
							</tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </main>


</body>
</html>
