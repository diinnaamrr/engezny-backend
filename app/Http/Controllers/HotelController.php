<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::latest()->paginate(10);
        return view('adminmodule::admin.hotel.index', compact('hotels'));
    }

    public function create()
    {
        return view('adminmodule::admin.hotel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'whatsapp_number' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hotel', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('hotel/gallery', 'public');
            }
            $data['gallery'] = $gallery;
        }

        Hotel::create($data);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel created successfully');
    }

    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('adminmodule::admin.hotel.edit', compact('hotel'));
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'whatsapp_number' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            if ($hotel->image) {
                Storage::disk('public')->delete($hotel->image);
            }
            $data['image'] = $request->file('image')->store('hotel', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = $hotel->gallery ?? [];
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('hotel/gallery', 'public');
            }
            $data['gallery'] = $gallery;
        }

        $hotel->update($data);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully');
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        if ($hotel->image) {
            Storage::disk('public')->delete($hotel->image);
        }
        $hotel->delete();

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted successfully');
    }

    // For landing page if needed directly
    public function hotelList()
    {
        $hotels = Hotel::latest()->get();
        return view('landing-page.hotels', compact('hotels'));
    }
}
