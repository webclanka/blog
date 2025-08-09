@extends('layouts.app')

@section('title', 'Create New Post - Laravel Blog')

@section('content')
    <div class="page-header">
        <h1>Create New Post</h1>
        <p>Share your thoughts and ideas with the world.</p>
    </div>

    <div class="form-container">
        <form action="{{ route('posts.store') }}" method="POST" class="post-form">
            @csrf

            <div class="form-group">
                <label for="title" class="form-label">Title *</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}" 
                       class="form-input @error('title') error @enderror" 
                       placeholder="Enter your post title"
                       required
                       maxlength="255">
                @error('title')
                    <span class="form-error">{{ $message }}</span>
                @enderror
                <small class="form-help">A compelling title helps readers discover your content.</small>
            </div>

            <div class="form-group">
                <label for="slug" class="form-label">Slug (URL)</label>
                <input type="text" 
                       id="slug" 
                       name="slug" 
                       value="{{ old('slug') }}" 
                       class="form-input @error('slug') error @enderror" 
                       placeholder="auto-generated-from-title"
                       maxlength="255">
                @error('slug')
                    <span class="form-error">{{ $message }}</span>
                @enderror
                <small class="form-help">Leave empty to auto-generate from title. Only lowercase letters, numbers, and hyphens.</small>
            </div>

            <div class="form-group">
                <label for="excerpt" class="form-label">Excerpt</label>
                <textarea id="excerpt" 
                          name="excerpt" 
                          rows="3" 
                          class="form-textarea @error('excerpt') error @enderror" 
                          placeholder="A brief summary of your post (optional)"
                          maxlength="500">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <span class="form-error">{{ $message }}</span>
                @enderror
                <small class="form-help">Optional. If left empty, will be auto-generated from content. Max 500 characters.</small>
            </div>

            <div class="form-group">
                <label for="content" class="form-label">Content *</label>
                <textarea id="content" 
                          name="content" 
                          rows="15" 
                          class="form-textarea @error('content') error @enderror" 
                          placeholder="Write your post content here..."
                          required>{{ old('content') }}</textarea>
                @error('content')
                    <span class="form-error">{{ $message }}</span>
                @enderror
                <small class="form-help">The main content of your post. Supports plain text with line breaks.</small>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="status" class="form-label">Status *</label>
                    <select id="status" name="status" class="form-select @error('status') error @enderror" required>
                        <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="published_at" class="form-label">Publish Date</label>
                    <input type="datetime-local" 
                           id="published_at" 
                           name="published_at" 
                           value="{{ old('published_at') }}" 
                           class="form-input @error('published_at') error @enderror"
                           min="{{ date('Y-m-d\TH:i') }}">
                    @error('published_at')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    <small class="form-help">Leave empty to publish immediately when status is "Published".</small>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Post</button>
                <a href="{{ route('posts.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const statusSelect = document.getElementById('status');
    const publishDateInput = document.getElementById('published_at');
    
    // Auto-generate slug from title
    titleInput.addEventListener('input', function() {
        if (!slugInput.value || slugInput.value === slugInput.getAttribute('data-original')) {
            const slug = titleInput.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
            
            slugInput.value = slug;
            slugInput.setAttribute('data-original', slug);
        }
    });
    
    // Show/hide publish date based on status
    statusSelect.addEventListener('change', function() {
        const publishDateGroup = publishDateInput.closest('.form-group');
        
        if (statusSelect.value === 'published') {
            publishDateGroup.style.display = 'block';
            // Set default publish date to now if empty
            if (!publishDateInput.value) {
                const now = new Date();
                now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
                publishDateInput.value = now.toISOString().slice(0, 16);
            }
        } else {
            publishDateGroup.style.display = 'none';
            publishDateInput.value = '';
        }
    });
    
    // Trigger change event on page load
    statusSelect.dispatchEvent(new Event('change'));
    
    // Character counter for excerpt
    const excerptTextarea = document.getElementById('excerpt');
    const excerptHelp = excerptTextarea.nextElementSibling.nextElementSibling;
    
    function updateExcerptCounter() {
        const remaining = 500 - excerptTextarea.value.length;
        excerptHelp.textContent = `${remaining} characters remaining. Max 500 characters.`;
        
        if (remaining < 50) {
            excerptHelp.classList.add('text-warning');
        } else {
            excerptHelp.classList.remove('text-warning');
        }
    }
    
    excerptTextarea.addEventListener('input', updateExcerptCounter);
    updateExcerptCounter();
});
</script>
@endpush