@extends('layouts.home')

@section('content')
    <div class="container">
        <h2>Name: {{ $user->name }}</h2>
        <p>Email: {{ $user->email }}</p>

        <hr>

        <h3>Posts</h3>
        @if ($posts->count() > 0)
            @foreach ($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <h4><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h4>
                        <p>{{ Str::limit($post->content, 100) }}</p>
                        <small>🗓 {{ $post->created_at->format('Y-m-d') }}</small>
                    </div>
                </div>
            @endforeach

            <!-- ✅ روابط التنقل بين الصفحات -->
            {{ $posts->links() }}
        @else
            <p class="text-muted">No posts found.</p>
        @endif
    </div>
@endsection
