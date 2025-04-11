@extends('layouts.app')

@section('title', 'search page')

@section('content')
<div class="container mt-5 pt-4"> <!-- إضافة مسافة من الأعلى بسبب البار الثابت -->
    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary">🔍 Search Results</h1>
        @if(isset($query))
            <p class="fs-5 text-muted">   "<strong>{{ $query }}</strong>"</p>
        @endif
    </div>

   
    @if($posts->isEmpty())
        <div class="alert alert-warning text-center mt-4">
            😔 "No results found, try searching with different keywords."
        </div>
    @endif

    <div class="row justify-content-center">
        @foreach($posts as $post)
            <div class="col-md-8 mb-4">
                <div class="card shadow-lg border-0 rounded-4 p-3">
                    <div class="card-body">
                       
                        <h3 class="fw-bold">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                                {{ $post->title }}
                            </a>
                        </h3>

                       
                        <p class="text-muted">
                            ✍️ {{ optional($post->user)->name ?? 'مستخدم مجهول' }} • 🗓 {{ optional($post->created_at)->format('Y-m-d') ?? 'N/A' }}
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
