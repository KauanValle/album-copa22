<?php


namespace App\Http\Resource;


use Carbon\Carbon;

class UserResource extends Resource
{

    public function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');
    }

    public function toResource($data, $code)
    {

        $dataT = [];
        $indice = 0;
        foreach($data as $user)
        {
            $dataAtual = date('Y-m-d H:i:s');
            $dataT[$indice] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'timestamps' => [
                    'created_at' => $dataAtual,
                    'updated_at' => $dataAtual
                ]
            ];
            $indice++;
        }

        return parent::dataResponse($dataT, $code);
    }

}
