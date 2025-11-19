<?php
// app/Http/Controllers/Admin/GalleryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GallerysController extends Controller
{
    public function index()
    {
        $images = Gallery::latest()->paginate(24);
        return view('admin.gallery.index', compact('images'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|max:5120',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'tags' => 'nullable|string',
        ]);

        $uploadedImages = [];

        foreach ($request->file('images') as $image) {
            $path = $image->store('gallery', 'public');

            $uploadedImages[] = Gallery::create([
                'image_path' => $path,
                'title' => $validated['title'] ?? null,
                'description' => $validated['description'] ?? null,
                'category' => $validated['category'],
                'tags' => !empty($validated['tags']) ? array_map('trim', explode(',', $validated['tags'])) : null,
                'uploaded_by' => auth()->id(),
            ]);
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', count($uploadedImages) . ' images uploaded successfully');
    }

    public function edit($id)
    {
        $image = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $image = Gallery::findOrFail($id);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'tags' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($image->image_path);
            $validated['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        $image->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Image updated successfully');
    }

    public function destroy($id)
    {
        $image = Gallery::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Image deleted successfully');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        $images = Gallery::whereIn('id', $ids)->get();

        foreach ($images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        return back()->with('success', count($images) . ' images deleted');
    }
}
