<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EarningsNeo extends Model
{
    use HasFactory;
    protected $table = "earnings_neo";
    protected $primaryKey = "id";
    
    protected $fillable = [
        'booking_id',
        'neo_comm',
        'neo_id'
    ];
    // protected $casts = [
    //     'country_id'    => 'integer',
    // ];
    public function getAll(){
        return $this->attributes['booking_id'];
    }
    
}
