@extends('layouts.dashboard')

@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create a New Post</h5>
            
            <form action="{{route('posts.store')}}" method="POST">
                @csrf
                <!-- Title Input -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" type="text" class="form-control" value="{{old('title')}}">
                                </div>

                <!-- Content Input -->
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" class="form-control"  rows="3">{{old('content')}}</textarea>
                </div>
               


                <!-- Author Info Input -->
                <div class="mb-3">
                        <label  class="form-label">author </label>
                        <select name="author" class="form-control">
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
