<?php

namespace App\Jobs;

use App\Imports\ClientImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private string $path
    )
    {
        
    }

    
    
    public function handle(): void
    {
        Cache::set('excel_row', 0);

        Excel::import(new ClientImport, $this->path, 'public');
    }
}
