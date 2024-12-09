<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    // En App\Models\Venta.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
