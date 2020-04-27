<?php


namespace App\Models\Payroll;


use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $primaryKey='id';
    protected $table='contacts';
    public $timestamps=false;

    public function getId()
    {
     return $this->id;
    }

    public function getNumber()
    {
        return $this->cn_number;
    }
    public function setNumber($num)
    {
        $this->cn_number=$num;
    }

    public function isCorporate()
    {
        return $this->cb_corporate;
    }
    public function setCorporate($bol)
    {
        $this->cb_corporate=$bol;
    }

    public function getPerson()
    {
        return $this->belongsTo('Models\Payroll\Person');

    }
    public function setPerson(Person $person)
    {
        $this->person_id=$person->getId();
    }
}
