<?php

namespace App\Imports;

use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientImport implements ToModel
{
    public function model(array $row)
    {
        $data = [
            'id' => $row[0],
            'name' => $row[1],
            'date' => $row[2]
        ];

        $rules = [
            'id' => 'required|numeric|unique:clients,id',
            'name' => 'required|string|regex:"^[A-Za-z ]+$"',
            'date' => 'required|date_format:d.m.Y'
        ];

        $validator = Validator::make($data, $rules);

        if(!$validator->fails())
            return new Client($validator->validated());
    }
}
