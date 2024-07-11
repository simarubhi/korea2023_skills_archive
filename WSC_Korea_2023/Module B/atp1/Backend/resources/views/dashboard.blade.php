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
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->registered }}</td>
                                <td>{{ $user->last_login }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
