<?php

namespace App\Http\Resource;

class BadRequestResource extends Resource
{
    public function toResource($data, $code)
    {
        $dataT = [
            'error' => $data
        ];

        return parent::dataResponse($dataT, $code);
    }
}
