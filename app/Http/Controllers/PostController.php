<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index(Request $request): View
    {
        $query = Post::query();
        
        // Handle search
        if ($request->filled('search')) {
            $query->search($request->search);
        }
        
        // Handle status filter
        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->published();
            } elseif ($request->status === 'draft') {
                $query->draft();
            }
        }
        
        // Handle sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortDir = $request->get('direction', 'desc');
        
        if (in_array($sortBy, ['title', 'created_at', 'published_at', 'view_count'])) {
            $query->orderBy($sortBy, $sortDir);
        }
        
        // Get paginated results
        $perPage = $request->get('per_page', 10);
        $posts = $query->paginate($perPage)->withQueryString();
        
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        $post = Post::create($validated);
        
        return redirect()->route('posts.show', $post)
                        ->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post): View
    {
        // Increment view count
        $post->incrementViewCount();
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post): View
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $validated = $request->validated();
        
        $post->update($validated);
        
        return redirect()->route('posts.show', $post)
                        ->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        
        return redirect()->route('posts.index')
                        ->with('success', 'Post deleted successfully!');
    }

    /**
     * Publish a post.
     */
    public function publish(Post $post): RedirectResponse
    {
        $post->publish();
        
        return redirect()->back()
                        ->with('success', 'Post published successfully!');
    }

    /**
     * Unpublish a post.
     */
    public function unpublish(Post $post): RedirectResponse
    {
        $post->unpublish();
        
        return redirect()->back()
                        ->with('success', 'Post unpublished successfully!');
    }

    /**
     * Duplicate a post.
     */
    public function duplicate(Post $post): RedirectResponse
    {
        $newPost = $post->replicate();
        $newPost->title = $post->title . ' (Copy)';
        $newPost->slug = Post::generateUniqueSlug($newPost->title);
        $newPost->status = 'draft';
        $newPost->published_at = null;
        $newPost->view_count = 0;
        $newPost->save();
        
        return redirect()->route('posts.edit', $newPost)
                        ->with('success', 'Post duplicated successfully!');
    }
}
