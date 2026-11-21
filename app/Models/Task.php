<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'deadline',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date:Y-m-d',
        ];
    }
}
