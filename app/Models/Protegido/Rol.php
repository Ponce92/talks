<?php

namespace App\Models\Protegido;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='tlk_roles';
    protected $primaryKey='rol_id';
    public $timestamps=false;
}
