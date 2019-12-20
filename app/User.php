<?php

namespace Ecotickets;

use Eco\Datos\Modelos\Rol;
use Eco\Datos\Modelos\Sede;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','last_name','username', 'email', 'password','Sede_id','CodigoConfirmacion','CorreoConfirmado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public  $keyCacheRoles = "roles";

    public function eventos(){
        return $this->hasMany('Ecotickets\Datos\Modelos\Evento');
    }

    public function productos(){
        return $this->hasMany('Ecotickets\Datos\Modelos\Producto','user_id','id');
    }
    /** public function roles()
    {
    return $this
    ->belongsToMany('Ecotickets\Role')
    ->withTimestamps();
    }*/

    public function roles()
    {
        return $this
            ->belongsToMany(Rol::class,'Tbl_Roles_Por_Usuarios','user_id','Rol_id')
            ->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    /** public function hasRole($role)
    {
    if ($this->roles()->where('name', $role)->first()) {
    return true;
    }
    return false;
    }*/

    public function hasRole($role)
    {
        if ($this->roles()->where('Nombre', $role)->first()) {
            return true;
        }
        return false;
    }

    public  function AutorizarUrlRecurso($urlrecurso)
    {
        /*$roles = Cache::rememberForever($this->keyCacheRoles,function (){
            return $this->roles()->get();
        });*/
        $roles = $this->roles()->get();
        foreach ($roles as $rol)
        {
            if ($rol->recursos()->where('UrlRecurso', $urlrecurso)->first()) {
                return true;
            }
        }
        abort(401, 'Esta acción no está autorizada.');
    }


    /* public function sede()
     {
         return $this->belongsTo('Eco\Datos\Modelos\Sede');
     }*/

    public function Sede()
    {
        return $this->belongsTo(Sede::class,'Sede_id');
    }


    public  function buscarRecurso($recurso)
    {

        //$keyCacheRecursos = "recursos";
        /* $roles = Cache::rememberForever($this->keyCacheRoles,function (){
             return $this->roles()->get();
         });*/

        /*$recursos = Cache::rememberForever($keyCacheRecursos,function (){
            return $this->roles()->get();;
        });*/

        $roles = $this->roles()->get();
        foreach ($roles as $rol)
        {
            if ($rol->recursos()->where('Nombre', $recurso)->first()) {
                return true;
            }
        }
        return false;
    }

    public  function ListaRecursos()
    {
        /**$roles = Cache::rememberForever($this->keyCacheRoles,function (){
        return $this->roles()->get();
        });*/
        $roles =$this->roles()->get();
        $recursosRol = array();
        foreach ($roles as $rol)
        {
            $recursos = $rol->recursos()->get();
            foreach ($recursos as $recurso){
                $existe = true;
                foreach ($recursosRol as $recursoRol){
                    if($recursoRol->id == $recurso->id){
                        $existe = false;
                        break;
                    }
                }
                if($existe){
                    $recursosRol[]=$recurso;
                }
            }
        }
        return $recursosRol;
    }

}
