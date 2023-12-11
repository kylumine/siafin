<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = ['total','rented_on','return_by','customer_id',];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function RentDetail() {
        return $this->hasMany(RentDetail::class);
    }

    public static function list(){
        $rent = Rent::orderByRaw('id')->get();
        $list = [];
        foreach ($rent as $rent) {
            $list[$rent -> id] = $rent->id;
        }

        return $list;
    }
}
