<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredients;
use App\Models\Cake;
use App\Models\Recipe;
use App\Http\Requests\RecipeRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class RecipeController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $cakes = Cake::all();
        // dd($cakes);
        return view('recipes.index', compact('cakes'));
    }

    public function create()
    {
        $cakes = Cake::all();
        $ingredients = Ingredients::all();
        // dd($ingredients);
        return view('recipes.create', compact('ingredients', 'cakes'));
    }


    //記述の説明
    public function store(RecipeRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $cake = Cake::create([
                    'name' => $request->name,
                    'raw_price' => 0, //ingから計算する
                    'sell_price'=>0,
                    'benefit' => 0,
                    'status' => 0,
                    'number' => $request->number,
                ]);
            
            
            
                foreach ($request->ing_id as $index=>$ing_id) {
                    //その後でrexipe登録
                    Recipe::create([
                        'cake_id' => $cake->id, //単価のデータ
                        'ingredient_id' => $ing_id,
                        'name' => '',
                        'amount' => $request->amount[$index], //ここでdd($request)に入ってる
                    ]);
                }
                
                
                //ここから、単価のデータを引っ張る
                $recipes = Recipe::Where('cake_id', $cake->id)->get();
                $ing_ids = $recipes->pluck('ingredient_id');
                $ingredients = Ingredients::Where('id', $ing_id)->get();
                
                
                $total_sum = 0;
                $count = (int)$cake->number;

                foreach ($recipes as $recipe){
                    $ingredient = Ingredients::find($recipe->ingredient_id);
                    $total_sum += $recipe->amount * $ingredient->g_price;
                }

        
                $raw_price = $total_sum / $count;


                $cake->update([
                    'raw_price' => $raw_price,
                ]);
            }, 2); //ここら辺
            
            
        } catch (\Throwable $e) {
            Log::error($e);
            throw $e;
        }
        return redirect()->route('cakes.index')
            ->with(['message' => 'レシピ作成しました', 'status' => 'info']);
    }

    public function show($id)
    {
        //
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
