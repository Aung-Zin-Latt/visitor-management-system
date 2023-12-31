<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $table = 'check_ins';
    protected $fillable = [
        'visitor_id',
        'check_in_time',
        'check_out_time',
    ];

    public function saveableFields(): array
    {
        return [
            'visitor_id' => 'string',
            'check_in_time' => 'date',
            'check_out_time' => 'date',
        ];
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
