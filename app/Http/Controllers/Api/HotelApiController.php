<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HotelApiController extends Controller
{
    public function index()
    {
        $hotels = Hotel::latest()->paginate(10);
        return response()->json(['status' => 'success', 'data' => $hotels], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['is_featured'] = $request->boolean('is_featured');

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

        $hotel = Hotel::create($data);
        return response()->json(['status' => 'success', 'data' => $hotel], 201);
    }

    public function show($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) return response()->json(['status' => 'error', 'message' => 'Not found'], 404);
        return response()->json(['status' => 'success', 'data' => $hotel], 200);
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) return response()->json(['status' => 'error', 'message' => 'Not found'], 404);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'image' => 'nullable|image',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if ($request->has('is_featured')) {
            $data['is_featured'] = $request->boolean('is_featured');
        }

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
        return response()->json(['status' => 'success', 'data' => $hotel], 200);
    }

    public function destroy($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) return response()->json(['status' => 'error', 'message' => 'Not found'], 404);
        $hotel->delete();
        return response()->json(['status' => 'success', 'message' => 'Deleted'], 200);
    }
}
