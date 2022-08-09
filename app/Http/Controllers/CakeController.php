<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\Recipe;
use App\Models\Ingredients;
use Illuminate\Http\Request;

class CakeController extends Controller
{
    public function index()
    {
        $cakes = Cake::all();

        return view('cakes.index', compact('cakes'));
    }


    public function create()
    {
        $ingredients = Ingredients::all();
        return view('cakes.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        //
    }

    public function storePrices(Request $request)
    {
        Cake::find($request->id)->update([
            'sell_price' => $request->sell_price,
            'benefit' => $request->benefit,
            'status' => $request->status,
            ]);
    }

    public function show($id)
    {
        $cake = Cake::findOrFail($id); //レシピモデル
        $recipes = $cake->recipes;//変更　hasManyを使用
        $ingredients = Ingredients::all();


        return view('cakes.show', compact('cake', 'recipes','ingredients'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
