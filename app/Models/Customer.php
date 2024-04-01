<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'type',
        'email',
        'address',
        'city',
        'postal_code',
        'state'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
