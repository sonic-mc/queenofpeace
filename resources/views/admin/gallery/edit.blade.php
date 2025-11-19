<!-- resources/views/admin/gallery/edit.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Edit Image')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h3 class="card-title">Edit Image Details</h3>
    </div>

    <form action="{{ route('admin.gallery.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Current Image -->
        <div style="margin-bottom: 25px;">
            <label class="form-label">Current Image</label>
            <div>
                <img src="{{ asset('storage/' . $image->image_path) }}" 
                     alt="{{ $image->title }}"
                     style="max-width: 400px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            </div>
        </div>

        <div class="form-group">
            <label for="image" class="form-label">Replace Image</label>
            <input type="file" 
                   id="image" 
                   name="image" 
                   class="form-control" 
                   accept="image/*">
            <small style="color: #6b7280;">Leave empty to keep current image</small>
        </div>

        <div class="form-group">
            <label for="title" class="form-label">Title</label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   class="form-control" 
                   value="{{ old('title', $image->title) }}"
                   placeholder="Image title">
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" 
                      name="description" 
                      class="form-control" 
                      rows="4">{{ old('description', $image->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="category" class="form-label">Category *</label>
            <select id="category" name="category" class="form-control" required>
                <option value="community" {{ old('category', $image->category) === 'community' ? 'selected' : '' }}>Community</option>
                <option value="programs" {{ old('category', $image->category) === 'programs' ? 'selected' : '' }}>Programs</option>
                <option value="events" {{ old('category', $image->category) === 'events' ? 'selected' : '' }}>Events</option>
                <option value="facilities" {{ old('category', $image->category) === 'facilities' ? 'selected' : '' }}>Facilities</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" 
                   id="tags" 
                   name="tags" 
                   class="form-control" 
                   value="{{ old('tags', is_array($image->tags) ? implode(', ', $image->tags) : '') }}"
                   placeholder="tag1, tag2, tag3">
        </div>

        <div style="display: flex; gap: 15px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Image
            </button>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection
