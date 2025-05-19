<?php

namespace App\Http\Controllers\Api\v1\Excel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Excel\ExcelRequest;
use App\Imports\ClientImport;
use App\Models\Client;
use App\Repositories\Client\ImportClientRepository;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function __construct(
        private ImportClientRepository $repo
    )
    {
        
    }



    public function index(ExcelRequest $request)
    {
        // Cache::set('excel_row', 0);
        
        // Excel::import(new ClientImport, $request->validated()['file'], 'public');
        
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
