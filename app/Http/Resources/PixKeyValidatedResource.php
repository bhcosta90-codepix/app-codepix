<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PixKeyValidatedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->account->uuid,
            'name' => $this->account->name,
            'number' => $this->account->number,
            'bank' => [
                'id' => $this->account->bank->uuid,
                'code' => $this->account->bank->code,
                'name' => $this->account->bank->name,
            ],
        ];
    }
}
