<?php

namespace App;

use App\Models\Protegido\Rol;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Date;

class User extends Authenticatable
{
    use Notifiable;
    protected $table='tlk_users';
    protected $primaryKey='pk_id';




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
        return $this->tt_name;
    }
    public function setName($name){
        $this->tt_name=$name;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email=$email;
    }

    public function isActive(){
        return $this->cl_active;
    }
    public function setActive($active){
        $this->cl_active=$active;
    }

    public function setState($est){
        $this->cb_estado=$est;
    }

    public function setPassword($pass){
        $this->password=$pass;
    }

    public function setRol($id){
        $this->fk_rol_id=$id;
    }

    public function getRol(){
        return Rol::find($this->fk_rol_id);
    }

    public function hasPermission($perm){
        $band=false;
        $rol=$this->getRol();
        foreach ($rol->permissions as $pivot){

            if($pivot->getName() == $perm){
                $band=true;
            }
        }
        return $band;
    }

}
