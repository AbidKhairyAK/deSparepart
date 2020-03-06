<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Test as TestResource;

class TestController extends Controller
{
    public function test()
    {
    	$tbl = DB::table('indocity')->get();

    	return TestResource::collection($tbl);
    }
}
