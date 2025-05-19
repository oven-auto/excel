<?php

namespace App\Repositories\Client;

use App\Jobs\ImportExcelJob;
use App\Models\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

Class ImportClientRepository
{
    public function import(UploadedFile $file)
    {
        Client::truncate();

        $file = Storage::disk('public')->put('files/', $file);
        
        ImportExcelJob::dispatch($file);
    }



    public function getAll()
    {
        return Client::get()->groupBy('date');
    }
}