<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function viewAll(Request $request)
    {
        return view('backend.categories', ['categories' => Category::all()]);
    }

    public function addCategory(Request $request)
    {
        $prod = new Category();
        $prod->name = $request->input('name');

        $prod->save();

        return redirect('/admin/categories');
    }

    public function deleteCategory($id)
    {
        Category::destroy($id);
        return redirect('/admin/categories');
    }
}
