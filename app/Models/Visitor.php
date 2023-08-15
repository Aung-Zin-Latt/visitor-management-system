<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $table = 'visitors';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'vehicle_type',
        'purpose_of_visit',
        'check_in_time',
        'check_out_time',
        'status'
    ];

    public function saveableFields(): array
    {
        return [
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'string',
            'phone' => 'string',
            'vehicle_type' => 'string',
            'purpose_of_visit' => 'string',
            'check_in_time' => 'date',
            'check_out_time' => 'date',
        ];
    }

    public function checkIns()
    {
        return $this->hasMany(CheckIn::class);
    }
}
