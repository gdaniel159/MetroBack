<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_CustomerModel extends Model
{
    use HasFactory;

    protected $table = 'customer_customer_demo';

    protected $fillable = [
        'customer_typer_id',
        'customer_id'
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at', 'updated_at' 
    ];

    public function customer_demographics(){
        return $this -> belongsTo(Customer_demographicsModel::class, 'customer_type_id');
    }
    public function customers(){
        return $this -> belongsTo(CustomersModel::class, 'customer_id');
    }
}
