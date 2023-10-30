<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionModel extends Model
{
    use HasFactory;

    protected $table = 'region';

    protected $fillable = array(
        'descripcion'
    );

    protected $hidden = [
        'created_at','updated_at'
    ];

    protected $primaryKey = 'id';

    public function territories(){
        return $this ->hasMany(TerriroriesModel::class);
    }
}
