<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Territories extends Model
{
    use HasFactory;

    // nombre de tabla
    protected $table = 'territories';

    // campos a utilizar
    protected $fillable = [
        'descripcion',
        'region_id'
    ];

    // campos ocultos 
    protected $hidden = [
        'created_at', 'updated_at', 
    ];

    // definir id
    protected $primaryKey = 'id';


    // muchos a unos
    public function region(){
        return $this -> belongsTo(RegionModel::class,'region_id');
    }
}

