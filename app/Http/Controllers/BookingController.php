<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class BookingController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('booking.index')->with(['rooms' => $rooms]);
    }

    public function newClient(Request $request) 
    {

        return response()->json([
            'status' => 200,
            'message' => 'New user created'
        ]);
    }

    public function getRooms(Request $request)
    {
        $rooms = Room::all();

        return response()->json([
            'status' => 200,
            'message' => 'Rooms fetched',
            'rooms' => $rooms,
        ]);
    }
}
