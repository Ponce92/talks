<?php


namespace App\Models\Payroll;


use Illuminate\Database\Eloquent\Model;

class RelationshipType extends Model
{
    protected $table='relationship_types';
    protected $primaryKey='id';
    public $timestamps=false;

    public function getid()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->cs_name;
    }
    public function setName($name)
    {
        $this->cs_name=$name;
    }
}
