<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

Class LogImport
{
    public static function write(array $messages)
    {
        File::disk('local')->put('result.txt', join(PHP_EOL, $messages));
    }
}