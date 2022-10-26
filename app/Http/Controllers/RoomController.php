<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $room = new Room;
        $room->name = $request->name;
        $room->category_id = $request->category_id;
        $room->save();

        return redirect()->route('categories.show', $request->category_id)->withSuccess(__('Pokój dodany pomyślnie.'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $room = Room::find($id);
        $room->name = $request->name;
        $room->update();

        return redirect()->route('categories.show', $request->category_id)->withSuccess(__('Pomyślnie zaktualizowano.'));
    }

    public function destroy(Request $request, $id)
    {
        Room::destroy($id);

        return redirect()->route('categories.show', $request->category_id)->withSuccess(__('Pomyślnie usunięto.'));
    }
}
