<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProductTransaction extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'status'=> 'string',
        ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function transactionDetails(){
        return $this->hasMany(TransactionDetail::class);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }

}
