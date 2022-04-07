<?php

namespace App\Http\Controllers;

use App\Category;
use App\Produit;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class ProduitController extends Controller
{

    public function viewAll(Request $request)
    {
        $sort = $request->has('sort') ? $request->input('sort') : "id";
        $produits = Produit::orderBy($sort, 'desc')->simplePaginate(10);
        return view('backend.produits', ['produits' => $produits, 'sort' => $sort]);
    }

    public function viewAdd(Request $request)
    {
        return view('backend.ajouter-produit', ["categories" => Category::all()]);
    }

    public function viewEdit(Request $request, $id)
    {
        return view('backend.modifier-produit', ["prod" => Produit::findOrFail($id), "categories" => Category::all()]);
    }

    public function addProduct(Request $request)
    {
        $prod = new Produit();
        $prod->name = $request->input('name');
        $prod->description = $request->input('description');
        $prod->price = $request->input('price');
        $prod->category_id = $request->input('category_id');
        $prod->user_id = Auth::user()->id;

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->input('name')) . '_' . time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();

            $file = $image->storeAs($folder, $name . '.' . $image->getClientOriginalExtension(), "public");

            $prod->image = $filePath;
        }
        $prod->save();

        return redirect('/admin/produits');
    }

    public function editProduct(Request $request, $id)
    {
        $prod = Produit::findOrFail($id);
        $prod->name = $request->input('name');
        $prod->description = $request->input('description');
        $prod->price = $request->input('price');
        $prod->category_id = $request->input('category_id');

        $prod->save();

        return redirect('/admin/produits');
    }

    public function deleteProduct(Request $request, $id)
    {
        Produit::destroy($id);
        return redirect('/admin/produits');
    }
}
