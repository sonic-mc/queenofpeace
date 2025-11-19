<!-- resources/views/admin/gallery/create.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Upload Images')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h3 class="card-title">Upload New Images</h3>
    </div>

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label">Select Images *</label>
            <input type="file" 
                   name="images[]" 
                   class="form-control" 
                   accept="image/*"
                   multiple
                   required
                   id="imageInput">
            <small style="color: #6b7280;">You can select multiple images. Max 5MB per image.</small>
        </div>

        <!-- Image Preview -->
        <div id="imagePreview" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 15px; margin: 20px 0;"></div>

        <div class="form-group">
            <label for="category" class="form-label">Category *</label>
            <select id="category" name="category" class="form-control" required>
                <option value="">Select Category</option>
                <option value="community">Community</option>
                <option value="programs">Programs</option>
                <option value="events">Events</option>
                <option value="facilities">Facilities</option>
            </select>
        </div>

        <div class="form-group">
            <label for="title" class="form-label">Title (Optional)</label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   class="form-control" 
                   placeholder="Will be applied to all uploaded images">
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Description (Optional)</label>
            <textarea id="description" 
                      name="description" 
                      class="form-control" 
                      rows="3"
                      placeholder="Will be applied to all uploaded images"></textarea>
        </div>

        <div class="form-group">
            <label for="tags" class="form-label">Tags (Optional)</label>
            <input type="text" 
                   id="tags" 
                   name="tags" 
                   class="form-control" 
                   placeholder="tag1, tag2, tag3">
            <small style="color: #6b7280;">Separate tags with commas</small>
        </div>

        <div style="display: flex; gap: 15px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-upload"></i> Upload Images
            </button>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';

        Array.from(e.target.files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.style.cssText = 'position: relative; border-radius: 8px; overflow: hidden;';
                    div.innerHTML = `
                        <img src="${e.target.result}" style="width: 100%; height: 150px; object-fit: cover;">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.7); color: white; padding: 5px; font-size: 0.75rem; text-align: center;">
                            ${file.name}
                        </div>
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush
