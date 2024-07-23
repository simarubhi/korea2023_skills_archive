<x-head title="{{ $game->title }} Page"/>
    <body>
        <x-header />
            <div class="container mt-5 d-flex flex-column gap-4">
                <h1>{{ $game->title}}</h1>
                @if ($game->thumbnail)
                    <img class="img-thumbnail" style="max-width: 200px;" src="{{ route('game-thumbnail', $game->id)}}" alt="Game Thumbnail">
                @endif

                <div class="container-fluid">
                    <h2>Game Information</h2>
        
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Id</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Author</th>
                                <th scope="col">Versions</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
        
                        <tbody>
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
                        </tbody>
                    </table>
                </div>

                <div class="container-fluid">
                    <h2>Score Information</h2>
        
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Score</th>
                                <th scope="col">User</th>
                                <th scope="col">Version</th>
                                <th scope="col">Created</th>
                                <th scope="col">Updated</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
        
                        <tbody>
                            @foreach ($game->versions as $version)
                                @foreach ($version->scores as $score)
                                    @php
                                        $user = App\Models\User::find($score->user_id);
                                    @endphp
                                    <tr class="@if ($user->blocked) table-danger @endif">
                                        <th scope="row">{{ $score->id }}</th>
                                        <td>{{ $score->score }}</td>
                                        @if ($user->blocked)
                                            <td>{{ $user->username }} (Blocked)</td>
                                        @else
                                            <td>{{ $user->username }}</td>
                                        @endif
                                        <td>{{ App\Models\Version::find($score->version_id)->version_time }}</td>
                                        <td>{{ $score->created_at }}</td>
                                        <td>{{ $score->updated_at }}</td>
                                        <form method="POST" action="{{ route('score-delete', [$game->id, $score->id])}}">
                                            @csrf
                                            @method('DELETE')
                                            <td>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    </body>
</html>