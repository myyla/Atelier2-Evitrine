<?php

namespace App\Http\Controllers;

use App\Produit;
use App\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home(Request $request)
    {
        $topProducts = Produit::orderBy("views", 'desc')->limit(4)->get();
        $sort = $request->has('sort') ? $request->input('sort') : "id";
        $type = $request->has('type') ? $request->input('type') : "desc";
        if (
            $request->has('category') &&
            $request->input('category') != 0
        ) {
            $category_id = $request->input('category');
            $produits = Produit::orderBy($sort, $type)->where('category_id', $request->input('category'))->simplePaginate(8);
        } else {
            $category_id = 0;
            $produits = Produit::orderBy($sort, $type)->simplePaginate(8);
        }
        return view('frontend.home', ["produits" => $produits, "popProduits" => $topProducts, "sort" => $sort, "categories" => Category::all(), "category_id" => $category_id]);
    }

    public function produit($id)
    {
        $produit = Produit::findOrFail($id);
        $category = Category::findOrFail($produit->category_id);
        $produit->increment('views', 1);

        return view('frontend.produit', ["produit" => $produit, "category" => $category]);
    }
}
