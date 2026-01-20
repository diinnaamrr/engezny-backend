<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Category;
use Illuminate\Support\Facades\File;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'departure_date' => 'nullable|date',
            'return_date' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/app/public/tour'), $imageName);
            $data['image'] = $imageName;
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $file) {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('storage/app/public/tour/gallery'), $name);
                $gallery[] = $name;
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

    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'departure_date' => 'nullable|date',
            'return_date' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/app/public/tour'), $imageName);
            $data['image'] = $imageName;
        }

        if ($request->hasFile('gallery')) {
            $gallery = $tour->gallery ?? [];
            foreach ($request->file('gallery') as $file) {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('storage/app/public/tour/gallery'), $name);
                $gallery[] = $name;
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
            $imagePath = public_path('storage/app/public/tour/' . $tour->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // Delete gallery images
        if ($tour->gallery && is_array($tour->gallery)) {
            foreach ($tour->gallery as $img) {
                $galleryPath = public_path('storage/app/public/tour/gallery/' . $img);
                if (File::exists($galleryPath)) {
                    File::delete($galleryPath);
                }
            }
        }

        $tour->delete();
        return back()->with('success', 'Tour deleted successfully.');
    }
}
