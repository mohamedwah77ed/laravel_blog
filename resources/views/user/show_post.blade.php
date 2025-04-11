@extends('layouts.app')
@section('title') View Post @endsection

@section('content')

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-3 p-3">
        <div class="card-body">
            <h2 class="card-title fw-bold">{{ $post->title }}</h2>
            <p class="text-muted">by: {{ optional($post->user)->name ?? 'Unknown User' }} • {{ $post->created_at->diffForHumans() }}</p>
            <hr>
            <p class="card-text fs-5">{!! convertHashtagsToLinks($post->content) !!}</p>
        </div>
    </div>

    <div class="mt-4">
        <h4 class="fw-bold">Comments</h4>

        @auth
            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-4">
                @csrf
                <div class="form-floating">
                    <textarea class="form-control" name="comment" placeholder="Write a comment" id="floatingTextarea2" style="height: 100px" required></textarea>
                    <label for="floatingTextarea2">Write a comment...</label>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Add Comment</button>
            </form>
        @endauth

        @if($comments->isNotEmpty())
            <ul class="list-group">
                @foreach($comments as $comment)
                    <li class="list-group-item border-0 shadow-sm mb-3 rounded">
                        <strong class="d-block">{{ $comment->user->name ?? 'Unknown User' }}</strong>
                        <p class="mb-1">{{ $comment->comment }}</p>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>

                        @if(auth()->id() === $comment->user_id)
                            <div class="mt-2">
                                <a href="{{ route('comments.update', $comment->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">No comments yet.</p>
        @endif
    </div>
</div>

@endsection