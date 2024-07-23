<x-head title="{{ $user->username }}'s Profile"/>
<body>
    <x-header />

    <div class="container mt-5 d-flex flex-column gap-4">
        <h1>{{ $user->username}}</h1>

        <div class="container-fluid">
            <h2>User Information</h2>

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
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->created }}</td>
                        @if (isset($user->last_login))
                            <td>{{ $user->last_login }}</td>
                        @else
                            <td>No Login Activity</td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>