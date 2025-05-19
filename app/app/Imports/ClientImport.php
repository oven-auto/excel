<?php

namespace App\Imports;

use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientImport implements ToModel
{
    private const RULES = [
        'id' => 'required|numeric|unique:clients,id',
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



    public function model(array $row)
    {
        $validator = Validator::make($this->prepare($row), self::RULES);

        if(!$validator->fails())
            return new Client($validator->validated());
    }
}
