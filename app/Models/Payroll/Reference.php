<?php


namespace App\Models\Payroll;


use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $primaryKey='id';
    protected $table='references';
    public $timestamps=false;

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->cs_name;
    }
    public function setName($name){
        $this->cs_name=$name;
    }

    public function getNumber()
    {
        return $this->cn_number;
    }
    public function setNumber($number)
    {
        $this->cn_number=$number;
    }
    public function isEmergency()
    {
        return $this->cb_emergency;
    }
    public function setEmergency($eme)
    {
        $this->cb_emergency=$eme;
    }

    public function getRelationshipType()
    {
        return $this->belongsTo('Models\Payroll\Reference');
    }

    public function setRelationshipType(RelationshipType $rel)
    {
        $this->relationship_type_id=$rel->getId();
    }

    public function setPerson(Person $person)
    {
    $this->person_id=$person->getId();
    }
}
