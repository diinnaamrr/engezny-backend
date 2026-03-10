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
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hotel', 'public');
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

        $hotel->update($request->all());
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
