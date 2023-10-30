<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionModel extends Model
{
    use HasFactory;

    // nombre de tabla
    protected $table = 'region';

    // campos a utilizar
    protected $fillable = array(
        'descripcion'
    );

    // campos ocultos
    protected $hidden = [
        'created_at','updated_at'
    ];

    // definicion de id
    protected $primaryKey = 'id';

    // uno a muchoss
    public function territories(){
        return $this ->hasMany(TerriroriesModel::class);
    }
}
