@extends('layouts.app')
@section('title')View Post @endsection

@section('content')



<div class="container mt-5"> <!-- ✅ تم إضافة mt-5 لترك مسافة تحت النافبار -->
    <!-- ✅ كارد البوست -->
    <div class="card shadow-lg border-0 rounded-3 p-3">
        <div class="card-body">
            <h2 class="card-title fw-bold">{{ $post->title }}</h2>
            <p class="text-muted">by: {{ optional($post->user)->name ?? 'مستخدم مجهول' }} • {{ $post->created_at->diffForHumans() }}</p>
            <hr>
            <p class="card-text fs-5">{!! convertHashtagsToLinks($post->content) !!}</p>
        </div>
    </div>


    <div class="mt-4">
        <h4 class="fw-bold">💬 commetns</h4>

    </div>
       
@if($comments->isNotEmpty())
    <ul class="list-group">
        @foreach($comments as $comment)
            <li class="list-group-item border-0 shadow-sm mb-3 rounded">
                <strong class="d-block">{{ $comment->user->name ?? 'مستخدم مجهول' }}</strong>
                <p class="mb-1">{{ $comment->comment }}</p>
                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
            </li>
        @endforeach
    </ul>
@else
    <p class="text-muted">no comments </p>
@endif

    </ul>

    </div>
</div>

@endsection
