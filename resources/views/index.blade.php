@extends('layout.app')

@section('title', 'Posts')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Posts</h2>
            <div>
                <span class="me-3"> {{ Auth::user()->name }}</span>
                <a class="btn btn-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <a href="{{ route('blogs.create') }}" class="btn btn-success mb-3">Create Post</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Posted By</th>
                    <th>Created At</th>
                    <th>Creator</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post['id'] }}</td>
                        <td>{{ $post['title'] }}</td>
                        <td>{{ $post['slug'] }}</td>
                        <td>{{ $post['posted_by'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($post['created_at'])->format('d-m-Y') }}</td>
                        <td>{{ $post->user ? $post->user->name : 'N/A' }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('blogs.show', $post['id']) }}" class="btn btn-info me-2">View</a>
                                <a href="{{ route('blogs.edit', $post['id']) }}" class="btn btn-primary me-2">Edit</a>
                                <form action="{{ route('blogs.destroy', $post['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @if (Session::has('new_post'))
                    @php $new_post = Session::get('new_post'); @endphp
                    <tr>
                        <td>{{ $new_post['id'] }}</td>
                        <td>{{ $new_post['title'] }}</td>
                        <td>{{ $new_post['slug'] }}</td>
                        <td>{{ $new_post['posted_by'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($new_post['created_at'])->format('d-m-Y') }}</td>
                        <td>{{ $new_post->user ? $new_post->user->name : 'N/A' }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('blogs.show', $new_post['id']) }}" class="btn btn-info me-2">View</a>
                                <a href="{{ route('blogs.edit', $new_post['id']) }}" class="btn btn-primary me-2">Edit</a>
                                <form action="{{ route('blogs.destroy', $new_post['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>

        <h2>Deleted Posts</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Posted By</th>
                    <th>Created At</th>
                    <th>Creator</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deletedPosts as $post)
                    <tr>
                        <td>{{ $post['id'] }}</td>
                        <td>{{ $post['title'] }}</td>
                        <td>{{ $post['slug'] }}</td>
                        <td>{{ $post['posted_by'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($post['created_at'])->format('d-m-Y') }}</td>
                        <td>{{ $post->user ? $post->user->name : 'N/A' }}</td>
                        <td>
                            <div class="d-flex">
                                <form action="{{ route('blogs.restore', $post['id']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning me-2">Restore</button>
                                </form>
                                <form action="{{ route('blogs.forceDelete', $post['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to permanently delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete Permanently</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $deletedPosts->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
