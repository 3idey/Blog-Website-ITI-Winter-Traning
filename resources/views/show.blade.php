@extends('layout.app')

@section('title', 'View Post')

@section('content')
    <div class="container mt-5">
        <h2>{{ e($post->title) }}</h2>
        <p>{{ e($post->description) }}</p>
        <p>Posted by: {{ e($post->posted_by) }}</p>
        <p>Created at: {{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}</p>
        <p>Creator: {{ $post->user ? e($post->user->name) : 'N/A' }}</p>
        @if ($post->image)
            <img src="{{ asset(  $post->image) }}" alt="Post Image" class="img-thumbnail mt-2" width="300" loading="lazy">
        @endif
        <a href="{{ route('blogs.index') }}" class="btn btn-primary mt-3">Back to Posts</a>
    </div>
@endsection
