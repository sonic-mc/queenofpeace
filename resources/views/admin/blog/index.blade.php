<!-- resources/views/admin/blog/index.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Blog Posts')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h3 class="card-title">All Blog Posts</h3>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Post
        </a>
    </div>

    <div style="overflow-x: auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>
                            <strong>{{ $post->title }}</strong>
                            @if($post->featured_image)
                                <br><img src="{{ asset('storage/' . $post->featured_image) }}" alt="" style="width: 60px; height: 40px; object-fit: cover; border-radius: 6px; margin-top: 5px;">
                            @endif
                        </td>
                        <td>{{ $post->author->name }}</td>
                        <td><span class="badge badge-info">{{ $post->category }}</span></td>
                        <td>
                            @if($post->status === 'published')
                                <span class="badge badge-success">Published</span>
                            @elseif($post->status === 'draft')
                                <span class="badge badge-warning">Draft</span>
                            @else
                                <span class="badge badge-info">Scheduled</span>
                            @endif
                        </td>
                        <td>{{ $post->published_at ? $post->published_at->format('M d, Y') : '-' }}</td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('admin.blog.edit', $post->id) }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #6b7280;">
                            No blog posts yet. <a href="{{ route('admin.blog.create') }}" style="color: #10b981;">Create your first post</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 30px;">
        {{ $posts->links() }}
    </div>
</div>
@endsection
