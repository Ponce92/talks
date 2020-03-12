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
                $band=true;
            }
        }
        return $band;
    }

    public function permission(){
        return $this->belongsToMany(Permission::class);
    }

    public function rol(){
        return $this->belongsTo('App\Models\Protegido\Rol');
    }

}
