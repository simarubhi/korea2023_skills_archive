<x-head title='Dashbaord' />
    <body class="vw-100 vh-100 d-flex justify-content-center align-items-start">
        <x-header />

        <div class="d-flex w-75 flex-column justify-content-center align-items-start gap-3" style="padding-top: 100px";>
            <h1>Overview</h1>
            <div class="w-100">
                <h2>Admin Users</h2>

                <table class="table mt-4">
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
                                <td>{{ $admin->registered }}</td>
                                <td>{{ $admin->last_login }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           
            <div class="w-100">
                <h2>Platform Users</h2>

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Username</th>
                            <th scope="col">Created</th>
                            <th scope="col">Last Login</th>
                            <th scope="col">Profile</th>
                            <th scope="col">Status</th>
                            <th scope="col">Block</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr @if($user->blocked) class="table-danger" @endif>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->registered }}</td>
                                <td>{{ $user->last_login }}</td>
                                <td><a href="{{ route('user-profile', ['username' => $user->username]) }}">See Profile</a></td>
                                @if ($user->blocked)
                                    <td>Blocked</td>
                                    <td>
                                        <form method="POST" action="{{ route('unblock') }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <button type="submit" class="btn btn-success">Unblock User</button>
                                        </form>
                                    </td>
                                @else
                                    <td>Active</td>
                                    <td>
                                        <form method="POST" action="{{ route('block') }}" class="d-flex flex-column gap-3">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <label for="block_reason">Reason for block:</label>
                                            <select name="block_reason" name="block_reason" id="block_reason">
                                                {{ $admin = 'You have been blocked by an administrator' }}
                                                {{ $spam = 'You have been blocked for spamming' }}
                                                {{ $cheat = 'You have been blocked for cheating' }}
                                                <option value="{{ $admin }}">{{ $admin }}</option>
                                                <option value="{{ $spam }}">{{ $spam }}</option>
                                                <option value="{{ $cheat }}">{{ $cheat }}</option>
                                            </select>
                                            <button type="submit" class="btn btn-danger d-inline">Block User</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="w-100">
                <h2>All Games</h2>

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Author</th>
                            <th scope="col">Versions</th>
                            <th scope="col">Game Page</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($games as $game)
                            <tr>
                                <td>
                                    <img @isset($game->thumbnail) src="{{ route('get-thumbnail', ['id' => $game->id]) }}" @endisset alt="Game Thumbnail">
                                </td>
                                <th scope="row">{{ $game->id }}</th>
                                <td>{{ $game->title }}</td>
                                <td>{{ $game->description }}</td>
                                <td>{{ App\Models\User::where('id', $game->user_id)->first()->username }}</td>
                                <td>
                                    @foreach ($game->versions as $version)
                                        @if (!$loop->last)
                                            <span>{{ $version->version }}, </span>
                                        @else
                                            <span>{{ $version->version }}</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td><a href="#">Game Page</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
