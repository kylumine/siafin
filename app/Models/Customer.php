<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name','connum','address', 'email'];

    public function rent() {
        return $this->hasMany(Rents::class);
    }

    public static function list(){
        $customer = Customer::orderByRaw('name')->get();
        $list = [];
        foreach ($customer as $customer) {
            $list[$customer -> id] = $customer->name;
        }

        return $list;
    }
}
