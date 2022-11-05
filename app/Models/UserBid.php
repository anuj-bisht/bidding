<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBid extends Model
{
    use HasFactory;
    protected $table='userbids';
    protected $fillable = [
        'user_id',
        'category_id',
        'source',
        'destination',
        'title',
        'description',
        'bid_end_date',
        'service_start_date'
    ];
}
