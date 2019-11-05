<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Satuan;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    public function api(Request $request)
    {
        $search = $request->get('search');

        $data = Satuan::select(DB::raw('nama as name, id'));

        if (!empty($search)) {
            $data = $data->where('nama', 'like', "%$search%");
        }

        $data = $data->get();

        return response()->json($data);
    }
}
