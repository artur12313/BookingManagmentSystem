<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Room;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('rooms.index')->with([
            'categories' => $categories
        ]);
    }

    public function show($id)
    {
        $categories = Category::where('parent_id', $id)->get();
        $category = Category::find($id);
        return view('rooms.show')->with([
            'category' => $category,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.show', $category->id)->withSuccess(__('Kategoria dodana pomyślnie.'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->update();

        return redirect()->route('categories.index')->withSuccess(__('Pomyślnie zaktualizowano.'));
    }

    public function destroy($id)
    {
        $rooms = Room::where('category_id', $id)->get();
        $subcategories = Category::where('parent_id', $id)->get();
        if(count($rooms) > 0)
        {
            foreach($rooms as $room) {
                $room->destroy($room->id);
            }
            foreach($subcategories as $subcategory) {
                $rooms = Room::where('category_id', $subcategory->id)->get();
                if(count($rooms) > 0) {
                    foreach($rooms as $room) {
                        $room->destroy($room->id);
                    }
                    $subcategory->destroy($subcategory->id);
                } else {
                    $subcategory->destroy($subcategory->id);
                }
                
            }
                Category::destroy($id);
        }else if(count($subcategories) > 0 && count($rooms) == 0) 
        {
            foreach($subcategories as $subcategory) {
                $rooms = Room::where('category_id', $subcategory->id)->get();
                if(count($rooms) > 0) {
                    foreach($rooms as $room) {
                        $room->destroy($room->id);
                    }
                    $subcategory->destroy($subcategory->id);
                } else {
                    $subcategory->destroy($subcategory->id);
                }
                
            }
            Category::destroy($id);
        } else
        {
            Category::destroy($id);
        }

        return redirect()->route('categories.index')->withSuccess(__('Pomyślnie usunięto.'));
    }

    public function storeSubcategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);
        $category->children()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.show', $category->id )->withSuccess(__('Pomyślnie dodano podkategorię.'));
    }
}
