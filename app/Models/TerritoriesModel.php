<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerritoriesModel extends Model
{
    use HasFactory;

    protected $table = 'territories';

    protected $fillable = [
        'descripcion',
        'region_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 
    ];

    protected $primaryKey = 'id';

    public function region(){
        return $this -> belongsTo(RegionModel::class,'region_id');
    }
}

