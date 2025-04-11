@extends('layouts.dashboard') 

@section('title', 'My Posts')

@section('content')

<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary">My Posts</h1>
    </div>

    <div class="row justify-content-center">
        @if ($posts->isEmpty())  
            <div class="col-md-8 text-center">
                <div class="alert alert-warning fw-bold fs-4">No posts yet!</div>
            </div>
        @else
            @foreach ($posts as $post)
                <div class="col-md-8 mb-4">
                    <div class="card shadow-lg border-0 rounded-4 p-3">
                        <div class="card-body">
                            <h3 class="fw-bold">
                                <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                                    {{ $post->title }}
                                </a>
                            </h3>

                            <p class="card-text fs-5">
                                {{ Str::limit($post->content, 150, '...') }}
                            </p>

                            @if (auth()->id() === $post->user_id) 
                                <div class="mt-3 d-flex justify-content-end gap-2">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning fw-bold">
                                        Edit
                                    </a>

                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" 
                                        onsubmit="return confirm('Are you sure you want to delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger fw-bold">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@endsection