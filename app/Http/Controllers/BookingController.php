<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Category;

class BookingController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $categories = Category::whereNull('parent_id')->get();
        // categories with subcategories and rooms in one variable
        $categoriesWithRooms = [];
        $subcategories = [];
        foreach($categories as $category)
        {
            $subcategories = Category::where('parent_id', $category->id)->get();
            foreach($subcategories as $subcategory)
            {
                $subcategory->rooms = Room::where('category_id', $subcategory->id)->get();
            }
            $rooms = Room::where('category_id', $category->id)->get();
            $categoriesWithRooms[] = [
                'category' => $category,
                'subcategories' => $subcategories,
                'rooms' => $rooms
            ];
        }
        return view('booking.index')->with(['categoriesWithRooms' => $categoriesWithRooms]);
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

    public function checkDate(Request $request)
    {
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;
        $room = Room::find($request->room);
        // $bookings = $room->bookings;
        // $booked = false;
        // foreach($bookings as $booking)
        // {
        //     if($booking->date == $date)
        //     {
        //         $booked = true;
        //     }
        // }
        return response()->json([
            'status' => 200,
            'message' => 'Date checked successfully',
            'room' => $room->id,
            // 'booked' => $booked,
        ]);
    }
}
