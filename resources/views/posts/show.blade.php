@extends('layouts.app')

@section('title', $post->title . ' - Laravel Blog')

@push('meta')
    <meta name="description" content="{{ $post->excerpt }}">
    <meta name="author" content="Laravel Blog">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->excerpt }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($post->published_at)
        <meta property="article:published_time" content="{{ $post->published_at->toISOString() }}">
    @endif
    <meta property="article:modified_time" content="{{ $post->updated_at->toISOString() }}">
@endpush

@section('content')
    <article class="post-article">
        <header class="post-article-header">
            <div class="post-breadcrumb">
                <a href="{{ route('posts.index') }}">← Back to Posts</a>
            </div>

            <h1 class="post-article-title">{{ $post->title }}</h1>
            
            <div class="post-article-meta">
                <div class="post-meta-row">
                    <span class="post-status status-{{ $post->status }}">
                        {{ ucfirst($post->status) }}
                    </span>
                    
                    @if($post->published_at)
                        <span class="post-date">Published {{ $post->formatted_published_date }}</span>
                    @endif
                    
                    @if($post->created_at != $post->updated_at)
                        <span class="post-date">Updated {{ $post->updated_at->format('M d, Y') }}</span>
                    @endif
                </div>
                
                <div class="post-meta-row">
                    <span class="post-views">{{ number_format($post->view_count) }} views</span>
                    <span class="post-reading-time">{{ $post->reading_time }}</span>
                </div>
            </div>

            <!-- Admin Actions -->
            <div class="post-admin-actions">
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline">Edit Post</a>
                
                @if($post->status === 'draft')
                    <form action="{{ route('posts.publish', $post) }}" method="POST" class="inline-form">
                        @csrf
                        <button type="submit" class="btn btn-success">Publish</button>
                    </form>
                @else
                    <form action="{{ route('posts.unpublish', $post) }}" method="POST" class="inline-form">
                        @csrf
                        <button type="submit" class="btn btn-warning">Unpublish</button>
                    </form>
                @endif
                
                <form action="{{ route('posts.duplicate', $post) }}" method="POST" class="inline-form">
                    @csrf
                    <button type="submit" class="btn btn-outline">Duplicate</button>
                </form>
                
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-form" 
                      onsubmit="return confirm('Are you sure you want to delete this post?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </header>

        <div class="post-article-content">
            {!! nl2br(e($post->content)) !!}
        </div>

        <footer class="post-article-footer">
            <div class="post-article-tags">
                <span class="post-slug">Slug: <code>{{ $post->slug }}</code></span>
            </div>
            
            <div class="post-navigation">
                @php
                    $previousPost = App\Models\Post::where('id', '<', $post->id)
                        ->published()
                        ->orderBy('id', 'desc')
                        ->first();
                    $nextPost = App\Models\Post::where('id', '>', $post->id)
                        ->published()
                        ->orderBy('id', 'asc')
                        ->first();
                @endphp

                @if($previousPost)
                    <a href="{{ route('posts.show', $previousPost) }}" class="nav-link nav-prev">
                        <span class="nav-label">← Previous Post</span>
                        <span class="nav-title">{{ $previousPost->title }}</span>
                    </a>
                @endif

                @if($nextPost)
                    <a href="{{ route('posts.show', $nextPost) }}" class="nav-link nav-next">
                        <span class="nav-label">Next Post →</span>
                        <span class="nav-title">{{ $nextPost->title }}</span>
                    </a>
                @endif
            </div>
        </footer>
    </article>

    <!-- Related Posts -->
    @php
        $relatedPosts = App\Models\Post::where('id', '!=', $post->id)
            ->published()
            ->inRandomOrder()
            ->limit(3)
            ->get();
    @endphp

    @if($relatedPosts->count() > 0)
        <section class="related-posts">
            <h2>You Might Also Like</h2>
            <div class="related-posts-grid">
                @foreach($relatedPosts as $relatedPost)
                    <article class="related-post-card">
                        <h3 class="related-post-title">
                            <a href="{{ route('posts.show', $relatedPost) }}">{{ $relatedPost->title }}</a>
                        </h3>
                        <p class="related-post-excerpt">{{ $relatedPost->excerpt }}</p>
                        <div class="related-post-meta">
                            <span class="post-date">{{ $relatedPost->formatted_published_date }}</span>
                            <span class="post-reading-time">{{ $relatedPost->reading_time }}</span>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
@endsection

@push('scripts')
<script>
// Print functionality
document.addEventListener('DOMContentLoaded', function() {
    // Add print styles when printing
    window.addEventListener('beforeprint', function() {
        document.body.classList.add('printing');
    });
    
    window.addEventListener('afterprint', function() {
        document.body.classList.remove('printing');
    });
});
</script>
@endpush