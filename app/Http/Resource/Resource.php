<?php


namespace App\Http\Resource;


class Resource
{
    public function dataResponse($data, $code)
    {
        return [
            'data' => $data,
            'code' => $code
        ];
    }
}
