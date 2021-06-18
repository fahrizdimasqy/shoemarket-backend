<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shoe;
use App\Helpers\ResponseFormatter;
class ShoeController extends Controller
{
    //
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $types = $request->input('types');

        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        $rate_from = $request->input('rate_from');
        $rate_to = $request->input('rate_to');

        if($id)
        {
            $shoe = Shoe::find($id);

            if($shoe)
                return ResponseFormatter::success(
                    $shoe,
                    'Data produk berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
        }

        $shoe = Shoe::query();

        if($name)
            $shoe->where('name', 'like', '%' . $name . '%');

        if($types)
            $shoe->where('types', 'like', '%' . $types . '%');

        if($price_from)
            $shoe->where('price', '>=', $price_from);

        if($price_to)
            $shoe->where('price', '<=', $price_to);

        if($rate_from)
            $shoe->where('rate', '>=', $rate_from);

        if($rate_to)
            $shoe->where('rate', '<=', $rate_to);

        return ResponseFormatter::success(
            $shoe->paginate($limit),
            'Data list produk berhasil diambil'
        );
    }
}
