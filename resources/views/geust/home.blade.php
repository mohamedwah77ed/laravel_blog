@extends('layouts.home') 

@section('title', 'Home')

@section('content')
    
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary"></h1>
    </div>

    <div class="row justify-content-center">
        @foreach ($posts as $post)
            <div class="col-md-8 mb-4">
                <div class="card shadow-lg border-0 rounded-4 p-3">
                    <div class="card-body">
                        <h3 class="fw-bold">
                            <a href="{{ route('geustposts.show', $post->id) }}" class="text-decoration-none text-dark">
                                {{ $post->title }}
                            </a>
                        </h3>
                        
                        <p class="text-muted">
                            ✍️ 
                            @if ($post->user)
                                <a href="{{ route('users.show', $post->user->id) }}" class="text-decoration-none">
                                    {{ $post->user->name }}
                                </a>
                            @else
                                Unknown User
                            @endif
                            • 🗓 {{ optional($post->created_at)->format('Y-m-d') ?? 'N/A' }}
                        </p>
                        
                        <p class="card-text fs-5">
                            {{ Str::limit($post->content, 150, '...') }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection