<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applybid extends Model
{
    use HasFactory;
    protected $fillable = [
        'userbids_id', 'provider_id','price','description',
        'additional_information'

    ];
}
