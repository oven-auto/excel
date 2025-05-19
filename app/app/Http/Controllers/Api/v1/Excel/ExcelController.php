<?php

namespace App\Http\Controllers\Api\v1\Excel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Excel\ExcelRequest;
use App\Imports\ClientImport;
use App\Models\Client;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function index(ExcelRequest $request)
    {
        Client::truncate();
        
        $file = $request->validated()['file'];

        Excel::import(new ClientImport, $file);
    }



    public function list()
    {
        return response()->json([
            'data' => Client::get(),
        ]);
    }
}
