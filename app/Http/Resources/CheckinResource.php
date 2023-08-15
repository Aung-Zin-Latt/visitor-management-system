<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckinResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'visitor_id' => $this->visitor_id,
            'check_in_time' => $this->check_in_time,
            'check_out_time' => $this->check_out_time,
        ];
    }

    public function with(Request $request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/check_ins'),
            'message' => 'Your action is successfull'
        ];
    }
}
