<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    protected $table = "user_wallet";
   protected $fillable = [
        'user_id',
        'amount',
        'is_vendor',
        'is_adamin',
    ];
}
