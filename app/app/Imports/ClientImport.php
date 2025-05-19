<?php

namespace App\Imports;

use App\Models\Client;
use App\Services\LogImport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Row;

class ClientImport implements OnEachRow, ShouldQueue, WithChunkReading
{
    private static $errors = [];

    private const RULES = [
        'id' => 'required|numeric|unique:clients,id|min:0|max:18446744073709551615',
        'name' => 'required|string|regex:"^[A-Za-z ]+$"',
        'date' => 'required|date_format:d.m.Y'
    ];



    private function prepare(array $arr) : array
    {
        return [
            'id'    => $arr[0],
            'name'  => $arr[1],
            'date'  => $arr[2]
        ];
    }



    public function batchSize(): int
    {
        return 1000;
    }



    public function chunkSize(): int
    {
        return 1000;
    }



    private function getRowCount(Row $row)
    {
        return $row->getDelegate()->getWorksheet()->getHighestRow();
    }



    public function onRow(Row $row)
    {           
        Cache::increment('excel_row', 1);

        $validator = Validator::make($this->prepare($row->toArray()), self::RULES);

        if(!$validator->fails())
            Client::create($validator->validated()); 
        
        $this->saveErrors($validator->messages()->all());  

        if($this->getRowCount($row) == Cache::get('excel_row'))
            $this->saveFile();
                    
    }



    private function saveFile()
    {
        LogImport::write(self::$errors);
    }
    
    

    public function saveErrors(array $messages)
    {
        if(count($messages))
            self::$errors[] = join([
                Cache::get('excel_row'),
                '-',
                join(',', $messages)
            ]);
    }
}
