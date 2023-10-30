<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippersModel extends Model
{
    use HasFactory;

    protected $table = 'shippers';

    protected $fillable = [
        'compañia_nombre',
        'telefono'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $primaryKey = 'id';

    public function orders()
    {
        return $this->hasMany(OrdersModel::class);
    }
}
