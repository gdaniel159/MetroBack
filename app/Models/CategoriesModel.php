<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesModel extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'nombre_categoria',
        'descripcion',
        'foto'
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function products(){
        return $this -> hasMany(ProductsModel::class);
    }
}
