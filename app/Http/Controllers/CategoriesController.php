<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('rooms.index')->with([
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

        return redirect()->route('categories.index')->withSuccess(__('Kategoria dodana pomyślnie.'));
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
        Category::destroy($id);

        return redirect()->route('categories.index')->withSuccess(__('Pomyślnie usunięto.'));
    }
}
