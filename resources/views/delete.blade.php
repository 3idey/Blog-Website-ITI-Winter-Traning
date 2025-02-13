@extends('layout.app')

@section('title', 'Delete Blog Post')

@section('content')
    <h1>Delete Blog Post</h1>
    <p>Are you sure you want to delete the post titled "{{ $post->title }}"?</p>
    <form action="{{ route('blogs.destroy', $post->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
