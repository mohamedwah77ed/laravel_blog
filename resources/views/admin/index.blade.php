@extends('layouts.admin')

@section('title', 'Post Management')

@section('content')
<div class="container">
    <h1 class="mt-4">Post Management</h1>
    <p>List of all posts in the system.</p>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">Post Title</th>
                <th scope="col">Author</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name ?? 'Unknown' }}</td>
                    <td>
                        <a href="" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('admin.post.delete', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @if($posts->isEmpty())
                <tr>
                    <td colspan="3" class="text-center">No posts available currently</td>
                </tr>
            @endif
        </tbody>
    </table>

</div>
@endsection