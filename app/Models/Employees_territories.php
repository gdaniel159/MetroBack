<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees_territories extends Model
{
    use HasFactory;

    protected $table = 'employes_territories';

    protected $fillable = [
        'employees_id',
        'territory_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 
    ];

    protected $primaryKey = 'id';

    public function employees(){
        return $this -> belongsTo(EmployeesModel::class, 'employees_id');
    }
}
