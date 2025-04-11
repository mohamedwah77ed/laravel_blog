@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Post</h5>

            <!-- تأكد من تمرير معرف المنشور الصحيح -->
            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" type="text" value="{{ $post->title }}" class="form-control" required>
                </div>

                <!-- Content Input -->
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="4" required>{{ $post->content }}</textarea>
                </div>

                <!-- Author Info Input -->
                <div class="mb-3">
                    <label for="author_id" class="form-label">Select Author (Optional)</label>
                    <select class="form-control" id="author_id" name="author_id">
                        <option value="">-- No Author --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $post->author_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
