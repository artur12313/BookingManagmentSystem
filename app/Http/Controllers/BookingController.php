<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\Client;
use App\Models\Category;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $categories = Category::whereNull('parent_id')->get();
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
        $room = Room::find($request->room);
        $category = Category::find($request->category);
        $subcategory = Category::find($request->subcategory);

        return response()->json([
            'status' => 200,
            'message' => 'Rooms fetched',
            'room' => $room,
            'category' => $category,
            'subcategory' => $subcategory
        ]);
    }

    public function checkDate(Request $request)
    {
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;
        $room = Room::find($request->room);
        $bookings = Booking::where('room_id', $room->id)->get();
        $booked = false;
        foreach($bookings as $booking)
        {
            if($booking->start_date >= $dateFrom && $booking->end_date <= $dateTo)
            {
                $booked = true;
            }
            
        }
        if($booked)
        {
            return response()->json([
                'status' => 200,
                'message' => 'Pokój nie jest dostępny w tym terminie',
                'booked' => $booked
            ]);
        }
        else
        {
            return response()->json([
                'status' => 200,
                'message' => 'Pokój jest dostępny w tym terminie',
                'booked' => $booked
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'phone' => 'required',
            'name' => 'required',
            'lastName' => 'required',
            'city' => 'required',
            'postalCode' => 'required',
            'room' => 'required',
            'dateFrom' => 'required',
            'dateTo' => 'required',
            'status' => 'required',
        ]);

        $user = User::find(auth()->user()->id);

        $client = new Client;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->name = $request->name;
        $client->lastName = $request->lastName;
        $client->city = $request->city;
        $client->postal_code = $request->postalCode;
        $client->typeOfClient = $request->typeOfClient;
        // $client->save();

        $booking = new Booking;
        // $booking->client_id = $client->id;
        $booking->client_id = 1;
        $booking->room_id = $request->room;
        $booking->user_id = 1;
        $booking->start_date = $request->dateFrom;
        $booking->end_date = $request->dateTo;
        $booking->status = $request->status;
        $booking->numberOfPeople = $request->numberOfPeople;
        $booking->price = $request->price;
        $booking->comments = $request->comments;
        // $booking->save();

        return response()->json([
            'status' => 200,
            'message' => 'New booking created',
            'booking' => $booking,
            'client' => $client,
            'user' => $user
        ]);

        // return redirect()->route('booking.index')->withSuccess(__('Rezerwacja dodana pomyślnie.'));
    }
}
