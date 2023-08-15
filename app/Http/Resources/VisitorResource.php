<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'vehicle_type' => $this->vehicle_type,
            'purpose_of_visit' => $this->purpose_of_visit,
            'check_in_time' => $this->check_in_time,
            'check_out_time' => $this->check_out_time,
        ];
    }

    public function with($request)
    {
        return[
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/visitors'),
            'message' => 'Your action is successfull'
        ];
    }
}
