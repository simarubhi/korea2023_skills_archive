<x-head title='Dashbaord' />
    <body class="vw-100 vh-100 d-flex justify-content-center align-items-start">
        <x-header />

        <div class="d-flex w-75 flex-column justify-content-center align-items-start gap-3" style="padding-top: 100px";>
            <h1>{{ $user->username }}'s Profile</h1>
           
            <div class="w-100">
                <h2>Information</h2>

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Username</th>
                            <th scope="col">Created</th>
                            <th scope="col">Last Login</th>
                            <th scope="col">Status</th>
                            <th scope="col">Block</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr @if($user->blocked) class="table-danger" @endif>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->registered }}</td>
                            <td>{{ $user->last_login }}</td>
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
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
