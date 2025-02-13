<?php 
namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogControl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Add authentication middleware
    }

    public function index()
    {
        $posts = Post::with('user')->paginate(10); // Load user relationship
        $deletedPosts = Post::onlyTrashed()->paginate(10); // Load soft deleted posts
        return view('index', compact('posts', 'deletedPosts'));
    }

    public function create()
    {    
        $users = User::all(); 
        return view('create', ['users' => $users]);
    }

    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        unset($data['slug']); // Ensure slug is not filled by users

        $data['user_id'] = Auth::id(); // Associate the post with the authenticated user

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $path = $request->image->storeAs('images', $imageName, 'public');
            $data['image'] = $path;
        } else {
            $data['image'] = null;
        }

        $data['slug'] = Str::slug($data['title']) . '-' . time(); // Generate slug

        Post::create($data);
        return redirect()->route('blogs.index');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Restrict editing to the user who created the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('blogs.index')->with('error', 'You are not authorized to edit this post.');
        }

        return view('edit', compact('post'));
    }

    public function update(StoreBlogRequest $request, $id)
    {
        $data = $request->validated();
        unset($data['slug']); // Ensure slug is not filled by users

        $post = Post::findOrFail($id);

        // Restrict updating to the user who created the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('blogs.index')->with('error', 'You are not authorized to update this post.');
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            // Store new image
            $imageName = time() . '.' . $request->image->extension();
            $path = $request->image->storeAs('images', $imageName, 'public');
            $data['image'] = $path;
        } else {
            $data['image'] = $post->image; 
        }

        $data['slug'] = Str::slug($data['title']) . '-' . time(); // Update slug

        $post->update($data);

        // Ensure the slug is updated
        $post->slug = $data['slug'];
        $post->save();

        return redirect()->route('blogs.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Restrict deleting to the user who created the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('blogs.index')->with('error', 'You are not authorized to delete this post.');
        }

        // Delete image
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('blogs.index');
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        // Restrict restoring to the user who created the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('blogs.index')->with('error', 'You are not authorized to restore this post.');
        }

        $post->restore();
        return redirect()->route('blogs.index')->with('success', 'Post restored successfully.');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        // Restrict force deleting to the user who created the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('blogs.index')->with('error', 'You are not authorized to permanently delete this post.');
        }

        // Delete image
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->forceDelete();
        return redirect()->route('blogs.index')->with('success', 'Post permanently deleted successfully.');
    }
}