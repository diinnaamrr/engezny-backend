<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with('category')->latest()->paginate(20);
        return view('adminmodule::admin.tour.index', compact('tours'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('adminmodule::admin.tour.create', compact('categories'));
    }

    public function store(StoreTourRequest $request)
    {
        $data = $request->validated();
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('tour', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('tour/gallery', 'public');
            }
            $data['gallery'] = $gallery;
        }

        Tour::create($data);

        return redirect()->route('admin.tours.index')->with('success', 'Tour created successfully.');
    }

    public function show($id)
    {
        $tour = Tour::with('category')->findOrFail($id);
        return view('adminmodule::admin.tour.show', compact('tour'));
    }

    public function edit($id)
    {
        $tour = Tour::findOrFail($id);
        $categories = Category::all();
        return view('adminmodule::admin.tour.edit', compact('tour', 'categories'));
    }

    public function update(UpdateTourRequest $request, $id)
    {
        $tour = Tour::findOrFail($id);

        $data = $request->validated();
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($tour->image) {
                Storage::disk('public')->delete($tour->image);
            }
            $data['image'] = $request->file('image')->store('tour', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = $tour->gallery ?? [];
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('tour/gallery', 'public');
            }
            $data['gallery'] = $gallery;
        }

        $tour->update($data);

        return redirect()->route('admin.tours.index')->with('success', 'Tour updated successfully.');
    }

    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        
        // Delete main image
        if ($tour->image) {
            Storage::disk('public')->delete($tour->image);
        }

        // Delete gallery images
        if ($tour->gallery && is_array($tour->gallery)) {
            Storage::disk('public')->delete($tour->gallery);
        }

        $tour->delete();
        return back()->with('success', 'Tour deleted successfully.');
    }
}
