@extends('layouts.app')

@section('title', 'Blog Posts - Laravel Blog')

@push('meta')
    <meta name="description" content="Browse all blog posts on our Laravel blog. Discover articles about web development, PHP, Laravel, and more.">
@endpush

@section('content')
    <div class="page-header">
        <h1>Blog Posts</h1>
        <p>Discover articles about web development, programming, and technology.</p>
    </div>

    <!-- Search and Filter Bar -->
    <div class="search-filter-bar">
        <form method="GET" action="{{ route('posts.index') }}" class="search-form">
            <div class="search-input-group">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Search posts by title or content..." 
                       class="search-input">
                <button type="submit" class="search-btn">Search</button>
            </div>

            <div class="filter-group">
                <select name="status" class="filter-select">
                    <option value="">All Posts</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Drafts</option>
                </select>

                <select name="sort" class="filter-select">
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Newest First</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title A-Z</option>
                    <option value="view_count" {{ request('sort') == 'view_count' ? 'selected' : '' }}>Most Popular</option>
                    <option value="published_at" {{ request('sort') == 'published_at' ? 'selected' : '' }}>Recently Published</option>
                </select>

                <select name="direction" class="filter-select">
                    <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                </select>

                <select name="per_page" class="filter-select">
                    <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10 per page</option>
                    <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25 per page</option>
                    <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50 per page</option>
                </select>
            </div>

            @if(request()->hasAny(['search', 'status', 'sort', 'direction', 'per_page']))
                <a href="{{ route('posts.index') }}" class="clear-filters-btn">Clear Filters</a>
            @endif
        </form>
    </div>

    <!-- Posts Grid -->
    @if($posts->count() > 0)
        <div class="posts-grid">
            @foreach($posts as $post)
                <article class="post-card">
                    <div class="post-header">
                        <h2 class="post-title">
                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                        </h2>
                        
                        <div class="post-meta">
                            <span class="post-status status-{{ $post->status }}">
                                {{ ucfirst($post->status) }}
                            </span>
                            
                            @if($post->published_at)
                                <span class="post-date">{{ $post->formatted_published_date }}</span>
                            @else
                                <span class="post-date">{{ $post->created_at->format('M d, Y') }}</span>
                            @endif
                            
                            <span class="post-views">{{ number_format($post->view_count) }} views</span>
                            <span class="post-reading-time">{{ $post->reading_time }}</span>
                        </div>
                    </div>

                    <div class="post-excerpt">
                        <p>{{ $post->excerpt }}</p>
                    </div>

                    <div class="post-actions">
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More</a>
                        
                        <div class="post-admin-actions">
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline">Edit</a>
                            
                            @if($post->status === 'draft')
                                <form action="{{ route('posts.publish', $post) }}" method="POST" class="inline-form">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Publish</button>
                                </form>
                            @else
                                <form action="{{ route('posts.unpublish', $post) }}" method="POST" class="inline-form">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning">Unpublish</button>
                                </form>
                            @endif
                            
                            <form action="{{ route('posts.duplicate', $post) }}" method="POST" class="inline-form">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline">Duplicate</button>
                            </form>
                            
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-form" 
                                  onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $posts->links() }}
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📝</div>
            <h3>No posts found</h3>
            @if(request('search'))
                <p>No posts match your search criteria. Try adjusting your filters or <a href="{{ route('posts.index') }}">view all posts</a>.</p>
            @else
                <p>Get started by creating your first blog post.</p>
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Your First Post</a>
            @endif
        </div>
    @endif
@endsection

@push('scripts')
<script>
// Auto-submit form when filters change
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.search-form');
    const selects = form.querySelectorAll('.filter-select');
    
    selects.forEach(select => {
        select.addEventListener('change', function() {
            form.submit();
        });
    });
});
</script>
@endpush