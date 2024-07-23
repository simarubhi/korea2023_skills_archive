<x-head title="{{ $game->title }} Page"/>
    <body>
        <x-header />
            <div class="container mt-5 d-flex flex-column gap-4">
                <h1>{{ $game->title}}</h1>

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
            </div>
    </body>
</html>