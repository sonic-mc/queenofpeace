<!-- resources/views/admin/blog/edit.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Edit Blog Post')

@section('content')
<div class="content-card">
    <form action="{{ route('admin.blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title" class="form-label">Post Title *</label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   class="form-control" 
                   value="{{ old('title', $post->title) }}"
                   required>
        </div>

        <div class="form-group">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" 
                   id="slug" 
                   name="slug" 
                   class="form-control" 
                   value="{{ old('slug', $post->slug) }}">
        </div>

        <div class="form-group">
            <label for="excerpt" class="form-label">Excerpt</label>
            <textarea id="excerpt" 
                      name="excerpt" 
                      class="form-control" 
                      rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>

        <div class="form-group">
            <label for="content" class="form-label">Content *</label>
            <textarea id="content" 
                      name="content" 
                      class="form-control" 
                      rows="15"
                      required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="form-group">
            <label for="featured_image" class="form-label">Featured Image</label>
            @if($post->featured_image)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Current" style="max-width: 300px; border-radius: 12px;">
                </div>
            @endif
            <input type="file" 
                   id="featured_image" 
                   name="featured_image" 
                   class="form-control" 
                   accept="image/*">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="category" class="form-label">Category *</label>
                <select id="category" name="category" class="form-control" required>
                    <option value="mental-health" {{ old('category', $post->category) === 'mental-health' ? 'selected' : '' }}>Mental Health</option>
                    <option value="campaigns" {{ old('category', $post->category) === 'campaigns' ? 'selected' : '' }}>Campaigns</option>
                    <option value="updates" {{ old('category', $post->category) === 'updates' ? 'selected' : '' }}>Updates</option>
                    <option value="stories" {{ old('category', $post->category) === 'stories' ? 'selected' : '' }}>Success Stories</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status *</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="scheduled" {{ old('status', $post->status) === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" 
                   id="tags" 
                   name="tags" 
                   class="form-control" 
                   value="{{ old('tags', is_array($post->tags) ? implode(', ', $post->tags) : $post->tags) }}">
        </div>

        <div class="form-group">
            <label for="published_at" class="form-label">Publish Date</label>
            <input type="datetime-local" 
                   id="published_at" 
                   name="published_at" 
                   class="form-control" 
                   value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
        </div>

        <div style="display: flex; gap: 15px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Post
            </button>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content',
        height: 500,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | removeformat | help',
        content_style: 'body { font-family: Inter, sans-serif; font-size: 14px }'
    });
</script>
@endpush