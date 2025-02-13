@extends('layout.app')

@section('title', 'Edit Blog Post')

@section('content')
    <h1>Edit Blog Post</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('blogs.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" required>{{ old('description', $post->description) }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="posted_by">Posted by:</label>
            <input type="text" id="posted_by" name="posted_by" class="form-control" value="{{ old('posted_by', $post->posted_by) }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" class="form-control">
            @if ($post->image)
                <img src="{{ asset( $post->image) }}" alt="Post Image" class="img-thumbnail mt-2" width="150">
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
