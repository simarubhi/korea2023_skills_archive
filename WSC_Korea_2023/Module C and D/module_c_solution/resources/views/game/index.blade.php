@extends('layouts.admin')
@section('title', 'Games')
@section('main')
<table class="table table-striped">
    <thead>
        <tr>
            <th></th>
            <th>Title</th>
            <th>Author</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($games as $game)
            <tr>
                <td>
                    @if($game->latestVersion && $game->latestVersion->hasThumbnail())
                        <img src="{{ url('/game/'.$game->slug.'/thumbnail.png') }}" alt="{{ $game->title }} Logo" style="height: 30px">
                    @endif
                </td>
                <td>
                    <a href="{{ url('/game/'.$game->slug) }}">
                        {{ $game->title }}
                    </a>
                    @if($game->trashed())
                        <span class="badge bg-danger">deleted</span>
                    @endif
                </td>
                <td>{{ $game->gameAuthor->username }}</td>
                <td>
                    @if(!$game->trashed())
                        <form method="POST" action="{{ url('/game/'.$game->slug) }}">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
