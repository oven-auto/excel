<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

Class LogImport
{
    public static function write(array $messages)
    {
        Storage::disk('local')->put('result.txt', join(PHP_EOL, $messages));
    }
}