<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use Illuminate\Http\Request;

class IngController extends Controller
{
    public function index()
    {
        $ingredients = Ingredients::all();

        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        //
    }

    

    public function store(Request $request)
    {
        $g_price = round($request->g_price, 2);

        Ingredients::create([
            'name' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
            'g_price' => $g_price,
            'p_date' => $request->p_date,
            'p_camp' => $request->p_camp,
            'status' => 0,
        ]);

        return redirect()->route('ingredients.index')
        ->with(['message' => '材料を追加しました', 'status' => 'info']);
    }

    
    public function updateIngprice(Request $request)
    {
        Ingredients::find($request->id)->update([
            'price' => $request->price,
            'weight'=> $request->weight,
            'g_price' => $request->g_price,
            'status' => $request->status,
            
            ]);
    }
    
    
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
