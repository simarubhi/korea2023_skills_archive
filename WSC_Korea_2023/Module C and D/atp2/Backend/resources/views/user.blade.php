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

        <div class="container-fluid">
            <h2>User Score Information</h2>

            @php
            $filtered_scores = $user->scores->filter(function ($score) {
                return !$score->version->game->deleted;
            });

                $sorted_scores = $filtered_scores->sortBy(function ($score) {
                    return $score->version->game->title . $score->version->version_time;
                });

                $grouped_scores = $sorted_scores->groupBy(function ($score) {
                    return $score->version->game->title;
                });

            @endphp

            @if (!count($grouped_scores) == 0)  
                @foreach ($grouped_scores as $game_title => $scores)
                    <h3 class="mt-5">{{ $game_title }}</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Score</th>
                                <th scope="col">Game</th>
                                <th scope="col">Version</th>
                                <th scope="col">Created</th>
                                <th scope="col">Updated</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $current_version = null;
                                $version_changed = false;
                            @endphp
                            @foreach ($scores as $score)
                                @php
                                    $version = $score->version;
                                    $game = $version->game;

                                    if ($current_version !== $version->version_time && !$loop->first) {
                                        $current_version = $version->version_time;
                                        $version_changed = true;
                                    } else {
                                        $version_changed = false;
                                    }
                                @endphp
                                <tr @if ($version_changed && !$loop->last) style="border-bottom: black;" @endif>
                                    <th scope="row">{{ $score->id }}</th>
                                    <td>{{ $score->score }}</td>
                                    <td>{{ $game->title }}</td>
                                    <td>{{ $version->version_time }}</td>
                                    <td>{{ $score->created_at }}</td>
                                    <td>{{ $score->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <form method="POST" action="{{ route('user-delete-game-scores', [$user->id, $game->id])}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete All User {{ $game_title }} Scores</button>
                    </form>

                @endforeach

                <form method="POST" action="{{ route('user-delete-scores', $user->id)}}" class="my-5">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete All User Game Scores</button>
                </form>
            @else
                <span>No Scores</span>
            @endif
        </div>
    </div>
</body>
</html>