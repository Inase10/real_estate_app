<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    public $load_offer=8;
    protected $fillable = [
        'seller_id',
        'approved_by',
        'property_id',
        'approve_date',
        'offer_type',
        'status',

    ];

}
