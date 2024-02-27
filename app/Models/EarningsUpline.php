<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EarningsUpline extends Model
{
    use HasFactory;
    protected $table = "earnings_upline";
    protected $primaryKey = "id";
    
    protected $fillable = [
        'booking_id',
        'upline_comm',
        'upline_id',
        'sp_id'
    ];
    // protected $casts = [
    //     'country_id'    => 'integer',
    // ];
    public function getAll(){
        return $this->attributes['booking_id'];
    }
    
}
