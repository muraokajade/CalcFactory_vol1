<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredients;

class SelectController extends Controller
{
    public function index(Request $request)
    {
        $query = Ingredients::query();

        if ($request->filled('q')) {
            $keywords = explode(' ', trim(mb_convert_kana($request->q, 's')));

            foreach ($keywords as $keyword) {
                $query->where('name', 'LIKE', '%'. $keyword .'%');
            }
        }

        $per_page = 10;
        return $query->paginate($per_page);
    }
}
