<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;


    protected $fillable = [
        'table_id',
        'user_id',
        'start_time',
        'end_time',
    ];

    public function userName()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function tableName()
    {
        return $this->belongsTo(Table::class,'table_id');
    }

}
