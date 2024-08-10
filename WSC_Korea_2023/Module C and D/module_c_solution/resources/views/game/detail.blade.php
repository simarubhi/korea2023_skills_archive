@extends('layouts.admin')
@section('title', 'Game - '.$game->title)
@section('main')
<div class="row">
    <div class="col">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>Title</th>
                    <td>
                        {{ $game->title }}
                        @if($game->trashed())
                            <span class="badge bg-danger">deleted</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $game->description }}</td>
                </tr>
                <tr>
                    <th>Author</th>
                    <td>{{ $game->gameAuthor->username }}</td>
                </tr>
                <tr>
                    <th>Versions</th>
                    <td>
                        <ul class="mb-0">
                            @foreach($game->versions as $version)
                                <li>{{ $version->version }} - {{ $version->created_at }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @if($game->latestVersion && $game->latestVersion->hasThumbnail())
        <div class="col-2">
            <img src="{{ url('/game/'.$game->slug.'/thumbnail.png') }}" alt="{{ $game->title }} Logo" style="width: 100%">
        </div>
    @endif
</div>

<h2>
    Scores
    <form method="POST" action="{{ url('/score/reset-game/'.$game->slug) }}" class="d-inline">
        @csrf
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-danger btn-sm">Reset</button>
    </form>
</h2>
@foreach($game->versions as $version)
    <h3>Version {{ $version->version }}</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Score</th>
                <th>Player</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($version->scores as $score)
                @if($score->user)
                    <tr>
                        <td>{{ $score->score }}</td>
                        <td>{{ $score->user->username }}</td>
                        <td>
                            <form method="POST" action="{{ url('/score/'.$score->id) }}">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Delete
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button type="submit" class="dropdown-item" name="scope" value="single">This score</a>
                                        </li>
                                        <li>
                                            <button type="submit" class="dropdown-item" name="scope" value="all">All scores of this user</a>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endforeach
@endsection
