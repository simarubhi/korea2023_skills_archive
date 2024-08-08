<x-head title='{{ $game->title }}' />
<body class="">
    <x-header />

    <main class="container-lg mt-4">
        <h1>{{ $game->title }}</h1>

        <div class="container-fluid mt-4">
            <h2>Scores</h2>

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
                    {{-- @foreach ($admins as $admin)
                    <tr>
                      <th scope="row">{{ $admin->id }}</th>
                      <td>{{ $admin->username }}</td>
                      <td>{{ $admin->registered_at }}</td>
                      <td>{{ $admin->last_login_at }}</td>
                    </tr>
                    @endforeach --}}
                </tbody>
              </table>
        </div>

       
    </main>


</body>
</html>
