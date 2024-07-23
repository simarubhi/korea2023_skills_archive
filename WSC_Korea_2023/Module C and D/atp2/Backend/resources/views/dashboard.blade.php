<x-head title='dashboard'/>
<body>
    <x-header />
    <div class="container mt-5 d-flex flex-column gap-4">
        <h1>Admin Dashboard</h1>

        <div class="container-fluid">
            <h2>All Admins</h2>
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
                    @foreach (App\Models\Admin::all() as $admin)
                        <tr>
                            <th scope="row">{{ $admin->id }}</th>
                            <td>{{ $admin->username }}</td>
                            <td>{{ $admin->created }}</td>
                            @if (isset($admin->last_login))
                                <td>{{ $admin->last_login }}</td>
                            @else
                                <td>No Login Activity</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="container-fluid">
            <h2>All Users</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Created</th>
                        <th scope="col">Last Login</th>
                        <th scope="col">Profile</th>
                        <th scope="col">Action</th>
                        <th scope="col">Reason</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach (App\Models\User::all() as $user)
                        <tr class="@if ($user->blocked) table-danger @endif">
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->created }}</td>
                            @if (isset($user->last_login))
                                <td>{{ $user->last_login }}</td>
                            @else
                                <td>No Login Activity</td>
                            @endif
                            
                            @if ($user->blocked)
                            <td>No Profile Page</td>
                            <form method="POST" action="{{ route('user-unblock', $user->id)}}">
                                @csrf
                                <td>
                                    <button type="submit" class="btn btn-success">Unblock</button>
                                </td>
                                <td>
                                    {{ $user->reason }}
                                </td>
                            </form>
                            @else
                            <td><a href="{{ route('user-profile', $user->username) }}">Profile Page</a></td>
                                <form method="POST" action="{{ route('user-block', $user->id)}}">
                                    @csrf
                                    <td>
                                        <button type="submit" class="btn btn-danger">Block</button>
                                    </td>
                                    
                                    <td>
                                        <select class="form-select" name='reason' aria-label="Reason for Block">
                                            <option selected value="admin">You have been blocked by an administrator</option>
                                            <option value="spam">You have been blocked for spamming</option>
                                            <option value="chating">You have been blocked for cheating</option>
                                        </select>
                                    </td>
                                </form>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="container-fluid">
            <h2>All Games</h2>

            <input id="game-search" class="form-control my-3" type="text" placeholder="Search Game Title">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Author</th>
                        <th scope="col">Versions</th>
                        <th scope="col">Game</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach (App\Models\Game::all() as $game)
                        <tr class="game-row @if ($game->deleted) table-danger @endif">
                            <th>Image</th>
                            <th scope="row">{{ $game->id }}</th>
                            <td class="game-title">{{ $game->title }}</td>
                            <td>{{ $game->description }}</td>
                            <td>{{ $game->author->username }}</td>
                            <td>
                                @foreach ($game->versions as $version)
                                    <span>{{ $version->version_time }} | </span>
                                    
                                    @if ($loop->last)
                                        <span>{{ $version->version_time }}</span>
                                    @endif

                                @endforeach
                            </td>
                            <td><a href="{{ route('game-page', $game->slug) }}">Game Page</a></td>
                            @if ($game->deleted)
                                <td class="text-danger fw-bold">Deleted</td>
                                <form method="POST" action="{{ route('game-restore', $game->id)}}">
                                    @csrf
                                    <td>
                                        <button type="submit" class="btn btn-success">Restore</button>
                                    </td>
                                </form>
                            @else
                                <td class="text-success fw-bold">Active</td>
                                <form method="POST" action="{{ route('game-delete', $game->id)}}">
                                    @csrf
                                    <td>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </td>
                                </form>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>