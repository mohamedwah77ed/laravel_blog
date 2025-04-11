@extends('layouts.app')

@section('title', 'BLOG')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary">📢 آخر المقالات</h1>
    </div>

    <div class="row justify-content-center">
        @foreach ($posts as $post)
            <div class="col-md-8 mb-4">
                <div class="card shadow-lg border-0 rounded-4 p-3">
                    <div class="card-body">
                        <!-- ✅ عنوان البوست -->
                        <h3 class="fw-bold">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <!-- ✅ معلومات الكاتب -->
                        <p class="text-muted">
                            ✍️ {{ optional($post->user)->name ?? 'مستخدم مجهول' }} • 🗓 {{ optional($post->created_at)->format('Y-m-d') ?? 'N/A' }}
                        </p>
                        
                        <!-- ✅ محتوى البوست (مقتطف مختصر) -->
                        <p class="card-text fs-5">
                            {{ Str::limit($post->content, 150, '...') }}
                        </p>

                        <!-- ✅ عرض الهاشتاجات -->
                        @if ($post->hashtags->isNotEmpty())
                            <div class="mt-3">
                                @foreach ($post->hashtags as $hashtag)
                                    <a href="{{ route('posts.search', ['tag' => $hashtag->name]) }}" 
                                       class="badge bg-primary text-decoration-none fs-6">
                                        #{{ $hashtag->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ✅ تنبيه في حالة عدم وجود بوستات -->
    @if ($posts->isEmpty())
        <div class="alert alert-warning text-center mt-4">
            🚀 لا يوجد منشورات حتى الآن، كن أول من يكتب!
        </div>
    @endif
</div>
@endsection
