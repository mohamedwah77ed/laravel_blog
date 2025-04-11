@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>All Tags</h2>
        <div class="d-flex flex-wrap">
            @foreach($tags as $tag)
            <!--<a href="/search?tag=Laravel" class="badge bg-primary m-1">#Laravel</a>!-->
                <a href="{{ route('posts.search', ['tag' => $tag->name]) }}" class="badge bg-primary m-1">
                    #{{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>
@endsection
