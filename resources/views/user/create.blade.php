<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create a New Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">
            <h5 class="card-title text-primary fw-bold">Create a New Post</h5>
            
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Title</label>
                    <input name="title" type="text" class="form-control" value="{{ old('title') }}" placeholder="Write the post title">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label fw-bold">Content</label>
                    <textarea name="content" class="form-control" rows="5" placeholder="Write the post content">{{ old('content') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary fw-bold">Publish Post</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>