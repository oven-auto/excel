<?php

namespace App\Http\Controllers\Api\v1\Excel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Excel\ExcelRequest;

class ExcelController extends Controller
{
    public function index(ExcelRequest $request)
    {
        $file = $request->validated()['file'];

        dd($file);
    }
}
