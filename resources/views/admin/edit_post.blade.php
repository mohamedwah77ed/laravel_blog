<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>

    <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Post by admin</h5>

                <!-- ✅ تأكد من تمرير معرف المنشور الصحيح -->
                <form action="{{ route('admin.post.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- ✅ Title Input -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input name="title" type="text" value="{{ $post->title }}" class="form-control" required>
                    </div>

                    <!-- ✅ Content Input -->
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="4" required>{{ $post->content }}</textarea>
                    </div>

                    <!-- ✅ Submit Button -->
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <!-- ✅ Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
