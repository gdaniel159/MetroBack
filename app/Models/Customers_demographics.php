<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers_demographics extends Model
{
    use HasFactory;

    protected $table = 'customers_demographics';

    protected $fillable = [
        'cliente_descripcion'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 
    ];

    protected $primaryKey = 'id';

    public function customer_customer_demo(){
        return $this -> hasMany(Customer_CustomerModel::class,'');
    }
}
