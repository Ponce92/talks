<?php

namespace App;

use App\Models\Protegido\Group;
use App\Models\Protegido\Rol;
use App\Models\Protegido\Permission;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Date;

class User extends Authenticatable
{
    use Notifiable;
    protected $table='users';
    protected $primaryKey='id';




    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Funciones personalizadas de clase, getters y setters
     *
     *
     *
     */
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
    }

    public  function getName(){
        return $this->cs_name;
    }
    public function setName($name){
        $this->cs_name=$name;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email=$email;
    }

    public function setState($est){
        $this->cb_state=$est;
    }

    public function getState(){

        if($this->cb_state){
            return true;
        }else{
            return false;
        }
    }

    public function setPassword($pass){
        $this->password=$pass;
    }

    public function setRol($id){
        $this->rol_id=$id;
    }


    public function hasPermission($perm){
        $band=false;
        $rol=$this->rol;
        foreach ($rol->permissions as $pivot){

            if($pivot->getName() == $perm){
                return true;
            }
        }
        //permisos a nivel de grupo
        foreach ($this->groups as $gr)
        {
            foreach ($gr->permissions as $pivot)
            {
                if($pivot->getName() == $perm)
                {
                    return true;
                }
            }
        }

        //Permissos a nivel de usuairo
        foreach ($this->permissions as $pivot){
            if($pivot->getName() == $perm){
                return true;
            }
        }

        return false;
    }

    public function permissions(){
        return $this->belongsToMany('App\Models\Protegido\Permission');
    }
    public function groups(){
        return $this->belongsToMany(Group::class);
    }

    public function rol(){
        return $this->belongsTo('App\Models\Protegido\Rol');
    }

}
