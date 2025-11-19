<!-- resources/views/admin/blog/create.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Create Blog Post')

@section('content')
<div class="content-card">
    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title" class="form-label">Post Title *</label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   class="form-control" 
                   value="{{ old('title') }}"
                   placeholder="Enter post title"
                   required>
        </div>

        <div class="form-group">
            <label for="slug" class="form-label">Slug (Optional)</label>
            <input type="text" 
                   id="slug" 
                   name="slug" 
                   class="form-control" 
                   value="{{ old('slug') }}"
                   placeholder="auto-generated-from-title">
            <small style="color: #6b7280;">Leave empty to auto-generate from title</small>
        </div>

        <div class="form-group">
            <label for="excerpt" class="form-label">Excerpt</label>
            <textarea id="excerpt" 
                      name="excerpt" 
                      class="form-control" 
                      rows="3"
                      placeholder="Brief description (optional)">{{ old('excerpt') }}</textarea>
        </div>

        <div class="form-group">
            <label for="content" class="form-label">Content *</label>
            <textarea id="content" 
                      name="content" 
                      class="form-control" 
                      rows="15"
                      placeholder="Write your blog post content..."
                      required>{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
            <label for="featured_image" class="form-label">Featured Image</label>
            <input type="file" 
                   id="featured_image" 
                   name="featured_image" 
                   class="form-control" 
                   accept="image/*">
            <small style="color: #6b7280;">Recommended size: 1200x600px</small>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="category" class="form-label">Category *</label>
                <select id="category" name="category" class="form-control" required>
                    <option value="">Select Category</option>
                    <option value="mental-health" {{ old('category') === 'mental-health' ? 'selected' : '' }}>Mental Health</option>
                    <option value="campaigns" {{ old('category') === 'campaigns' ? 'selected' : '' }}>Campaigns</option>
                    <option value="updates" {{ old('category') === 'updates' ? 'selected' : '' }}>Updates</option>
                    <option value="stories" {{ old('category') === 'stories' ? 'selected' : '' }}>Success Stories</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status *</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="scheduled" {{ old('status') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" 
                   id="tags" 
                   name="tags" 
                   class="form-control" 
                   value="{{ old('tags') }}"
                   placeholder="tag1, tag2, tag3">
            <small style="color: #6b7280;">Separate tags with commas</small>
        </div>

        <div class="form-group">
            <label for="published_at" class="form-label">Publish Date</label>
            <input type="datetime-local" 
                   id="published_at" 
                   name="published_at" 
                   class="form-control" 
                   value="{{ old('published_at') }}">
        </div>

        <div style="border-top: 2px solid #f3f4f6; padding-top: 30px; margin-top: 30px;">
            <h4 style="margin-bottom: 20px; color: #1f2937;">SEO Settings</h4>
            
            <div class="form-group">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input type="text" 
                       id="meta_title" 
                       name="meta_title" 
                       class="form-control" 
                       value="{{ old('meta_title') }}"
                       placeholder="SEO title (optional)">
            </div>

            <div class="form-group">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea id="meta_description" 
                          name="meta_description" 
                          class="form-control" 
                          rows="3"
                          placeholder="SEO description (optional)">{{ old('meta_description') }}</textarea>
            </div>
        </div>

        <div style="display: flex; gap: 15px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Create Post
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

    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const slug = this.value
            .toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/--+/g, '-')
            .trim();
        document.getElementById('slug').value = slug;
    });
</script>
@endpush
