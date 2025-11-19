<!-- resources/views/admin/gallery/index.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Gallery Management')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h3 class="card-title">Gallery Images</h3>
        <div style="display: flex; gap: 10px;">
            <button onclick="toggleBulkSelect()" class="btn btn-secondary btn-sm" id="bulkSelectBtn">
                <i class="fas fa-check-square"></i> Bulk Select
            </button>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
                <i class="fas fa-upload"></i> Upload Images
            </a>
        </div>
    </div>

    <!-- Bulk Actions Bar (Hidden by default) -->
    <div id="bulkActionsBar" style="display: none; background: #f9fafb; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <span id="selectedCount">0</span> images selected
            </div>
            <div style="display: flex; gap: 10px;">
                <button onclick="deselectAll()" class="btn btn-sm btn-secondary">
                    <i class="fas fa-times"></i> Deselect All
                </button>
                <form action="{{ route('admin.gallery.bulk-delete') }}" method="POST" id="bulkDeleteForm" onsubmit="return confirm('Are you sure you want to delete selected images?')">
                    @csrf
                    <input type="hidden" name="ids" id="selectedIds">
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i> Delete Selected
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div style="margin-bottom: 25px; padding: 20px; background: #f9fafb; border-radius: 12px;">
        <form action="{{ route('admin.gallery.index') }}" method="GET" style="display: flex; gap: 15px; align-items: end; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 200px;">
                <label class="form-label">Category</label>
                <select name="category" class="form-control">
                    <option value="">All Categories</option>
                    <option value="community" {{ request('category') === 'community' ? 'selected' : '' }}>Community</option>
                    <option value="programs" {{ request('category') === 'programs' ? 'selected' : '' }}>Programs</option>
                    <option value="events" {{ request('category') === 'events' ? 'selected' : '' }}>Events</option>
                    <option value="facilities" {{ request('category') === 'facilities' ? 'selected' : '' }}>Facilities</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Gallery Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
        @forelse($images as $image)
            <div class="gallery-card" data-id="{{ $image->id }}">
                <div style="position: relative;">
                    <input type="checkbox" class="bulk-checkbox" style="display: none; position: absolute; top: 10px; left: 10px; width: 24px; height: 24px; cursor: pointer; z-index: 10;">
                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                         alt="{{ $image->title }}"
                         style="width: 100%; height: 200px; object-fit: cover; border-radius: 12px 12px 0 0;">
                </div>
                <div style="padding: 15px;">
                    <h4 style="font-size: 0.95rem; font-weight: 700; color: #1f2937; margin-bottom: 5px;">
                        {{ $image->title ?? 'Untitled' }}
                    </h4>
                    <p style="font-size: 0.85rem; color: #6b7280; margin-bottom: 10px;">
                        {{ Str::limit($image->description, 60) }}
                    </p>
                    <div style="display: flex; gap: 8px; margin-bottom: 10px;">
                        <span class="badge badge-info">{{ ucfirst($image->category) }}</span>
                        @if($image->tags)
                            <span class="badge badge-secondary">{{ count($image->tags) }} tags</span>
                        @endif
                    </div>
                    <div style="display: flex; gap: 8px; justify-content: space-between;">
                        <a href="{{ route('admin.gallery.edit', $image->id) }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.gallery.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 60px; color: #6b7280;">
                <i class="fas fa-images" style="font-size: 3rem; margin-bottom: 15px; opacity: 0.3;"></i>
                <p>No images in gallery yet.</p>
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary" style="margin-top: 15px;">
                    <i class="fas fa-upload"></i> Upload Your First Image
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div style="margin-top: 30px;">
        {{ $images->links() }}
    </div>
</div>
@endsection

@push('styles')
<style>
    .gallery-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .gallery-card.selected {
        border: 3px solid #10b981;
    }
</style>
@endpush

@push('scripts')
<script>
    let bulkSelectMode = false;
    let selectedImages = new Set();

    function toggleBulkSelect() {
        bulkSelectMode = !bulkSelectMode;
        const checkboxes = document.querySelectorAll('.bulk-checkbox');
        const bulkActionsBar = document.getElementById('bulkActionsBar');
        const bulkSelectBtn = document.getElementById('bulkSelectBtn');

        if (bulkSelectMode) {
            checkboxes.forEach(cb => cb.style.display = 'block');
            bulkActionsBar.style.display = 'block';
            bulkSelectBtn.innerHTML = '<i class="fas fa-times"></i> Cancel';
        } else {
            checkboxes.forEach(cb => {
                cb.style.display = 'none';
                cb.checked = false;
            });
            bulkActionsBar.style.display = 'none';
            bulkSelectBtn.innerHTML = '<i class="fas fa-check-square"></i> Bulk Select';
            selectedImages.clear();
            updateSelectedCount();
            document.querySelectorAll('.gallery-card').forEach(card => card.classList.remove('selected'));
        }
    }

    document.querySelectorAll('.bulk-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const card = this.closest('.gallery-card');
            const imageId = card.dataset.id;

            if (this.checked) {
                selectedImages.add(imageId);
                card.classList.add('selected');
            } else {
                selectedImages.delete(imageId);
                card.classList.remove('selected');
            }

            updateSelectedCount();
        });
    });

    function updateSelectedCount() {
        document.getElementById('selectedCount').textContent = selectedImages.size;
        document.getElementById('selectedIds').value = Array.from(selectedImages).join(',');
    }

    function deselectAll() {
        document.querySelectorAll('.bulk-checkbox').forEach(cb => {
            cb.checked = false;
        });
        document.querySelectorAll('.gallery-card').forEach(card => {
            card.classList.remove('selected');
        });
        selectedImages.clear();
        updateSelectedCount();
    }
</script>
@endpush
