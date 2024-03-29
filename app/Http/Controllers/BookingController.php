<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function show()
    {
        $bookings = Booking::where('end_date', '>=', date('Y-m-d'))->get();

        return view('booking.show')->with(['bookings' => $bookings]);
    }

    public function edit($id)
    {
        $booking = Booking::find($id);
        $selectedCategory = Category::find($booking->room->category->parent_id);
        $client = Client::find($booking->client_id);
        $room = Room::find($booking->room_id);
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

        return view('booking.edit')->with(['booking' => $booking, 'client' => $client, 'categoriesWithRooms' => $categoriesWithRooms, 'room' => $room, 'selectedCategory' => $selectedCategory]);
    }

    public function details($id)
    {
        $booking = Booking::find($id);
        $category = Category::find($booking->room->category->parent_id);
        $client = Client::find($booking->client_id);
        $sectionName = $booking->room->category->name;

        return view('booking.details')->with(['booking' => $booking, 'client' => $client, 'category' => $category, 'sectionName' => $sectionName]);
    }

    public function destroy($id)
    {
        $booking = Booking::find($id);
        $client = Client::find($booking->client_id);
        $booking->delete();
        $client-> delete();

        return redirect()->route('booking.show')->with('success', 'Pomyślnie usunięto rezerwację');
    }

    public function getCalendar(Request $request) 
    {

        $bookings = Booking::all();
        $rooms = Room::all();
        $clients = Client::all();
        $categories = Category::whereNull('parent_id')->get();
        $subcategories = Category::whereNotNull('parent_id')->get();

        return response()->json([
            'status' => 200,
            'message' => 'Data downloaded successfully',
            'bookings' => $bookings,
            'rooms' => $rooms,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'clients' => $clients
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
            'name' => 'required',
            'lastName' => 'required',
            'room' => 'required',
            'dateFrom' => 'required',
            'dateTo' => 'required',
            'status' => 'required',
        ]);

        $client = new Client;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->name = $request->name;
        $client->lastName = $request->lastName;
        $client->city = $request->city;
        $client->postalCode = $request->postalCode;
        $client->typeOfClient = $request->typeOfClient;
        $client->save();

        $booking = new Booking;
        $booking->client_id = $client->id;
        $booking->room_id = $request->room;
        $booking->user_id = $request->user_id;
        $booking->start_date = $request->dateFrom;
        $booking->end_date = $request->dateTo;
        $booking->status = $request->status;
        $booking->numberOfPeople = $request->numberOfPeople;
        $booking->adults = $request->adults;
        $booking->numberOfChildren = $request->numberOfChildren;
        $exploded = explode(',', $request->price);
        if(count($exploded) > 1) {
            $booking->price = $exploded[0] . '.' . $exploded[1];
        } else {
            $booking->price = $request->price;;
        }
        $booking->comments = $request->comments;
        $booking->save();

        return response()->json([
            'status' => 200,
            'message' => 'Pomyślnie zarezerwowano pokój',
            'booking' => $booking,
        ]);

    }

    public function update(Request $request, $id)
    {

        $booking = Booking::find($id);
        $client = Client::find($booking->client_id);
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->name = $request->name;
        $client->lastName = $request->lastName;
        $client->city = $request->city;
        $client->postalCode = $request->postalCode;
        $client->typeOfClient = $request->typeOfClient;
        $client->update();

        $booking->room_id = $request->room;
        $booking->start_date = $request->dateFrom;
        $booking->end_date = $request->dateTo;
        $booking->status = $request->status;
        $booking->numberOfPeople = $request->numberOfPeople;
        $booking->adults = $request->adults;
        $booking->numberOfChildren = $request->numberOfChildren;
        $exploded = explode(',', $request->price);
        if(count($exploded) > 1) {
            $booking->price = $exploded[0] . '.' . $exploded[1];
        } else {
            $booking->price = $request->price;;
        }
        $booking->comments = $request->comments;
        $booking->update();

        return response()->json([
            'status' => 200,
            'message' => 'Pomyślnie zaktualizowano rezerwację',
        ]);
    }
}
