<?php

namespace App\Http\Controllers\Api\v1\Excel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Excel\ExcelRequest;
use App\Repositories\Client\ImportClientRepository;

class ExcelController extends Controller
{
    public function __construct(
        private ImportClientRepository $repo
    )
    {
        
    }



    public function index(ExcelRequest $request)
    {
        $this->repo->import($request->validated()['file']);
        
    }



    public function list()
    {
        $result = $this->repo->getAll();

        return response()->json([
            'data' => $result,
        ]);
    }
}
