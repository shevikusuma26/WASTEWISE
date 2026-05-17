<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pickup;
use Illuminate\Support\Facades\Validator;
use App\Events\PickupStatusUpdated;

class PickupController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $pickups = Pickup::with('user')->latest()->get();
        } else {
            $pickups = Pickup::where('user_id', $user->id)->latest()->get();
        }
        return response()->json($pickups);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'waste_type' => 'required|string',
            'address' => 'required|string',
            'pickup_date' => 'required|date',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pickup = Pickup::create(array_merge(
            $validator->validated(),
            ['user_id' => auth()->id(), 'status' => 'pending']
        ));

        return response()->json([
            'message' => 'Pickup request created successfully',
            'pickup' => $pickup
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,accepted,on_process,completed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pickup = Pickup::findOrFail($id);
        $pickup->status = $request->status;
        $pickup->save();

        if ($request->status === 'completed') {
            $pickupUser = $pickup->user;
            $pickupUser->eco_points += 50;
            $pickupUser->save();
        }

        // Broadcast the update
        event(new PickupStatusUpdated($pickup));

        return response()->json([
            'message' => 'Pickup status updated',
            'pickup' => $pickup
        ]);
    }
}
