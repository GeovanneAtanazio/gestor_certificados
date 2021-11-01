<?php

namespace App\Models\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'carga_horaria_obrigatoria',
        'carga_horaria_optativa',
        'carga_horaria_complementar',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'curso_id',
        'created_at',
        'updated_at',
        'cursoRelationship',
        'rolesRelationship',
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'curso',
        'roles',
    ];

    /**
     * Get the user's curso.
     *
     * @return string
     */
    public function getCursoAttribute()
    {
        return $this->cursoRelationship;
    }

    /**
     * Get the user's role.
     *
     * @return array
     */
    public function getRolesAttribute()
    {
        return $this->rolesRelationship;
    }

    /**
     * Set the user's curso.
     *
     * @param  int  $value
     * @return void
     */
    public function setCursoAttribute($value)
    {
        if(isset($value)){
            $this->attributes['curso_id'] = Curso::where('id', $value)->first()->id;
        }
    }

    /**
     * Set the user's role.
     *
     * @param  array  $value
     * @return void
     */
    public function setRolesAttribute($value) {
        if(isset($this->roles)){
            foreach($this->roles as $role){
                $this->removeRole($role->name);
                break;
            }
        }
        $role = NewRole::where('id', $value)->get()->first();
        $this->assignRole($role->name);
    }

    /**
     * Get the curso that owns the user.
     *
     * @return Curso
     */
    public function cursoRelationship()
    {
        return $this->belongsTo(Curso::class,'curso_id');
    }

    /**
     * The roles that belong to the user.
     *
     * @return Role
     */
    public function rolesRelationship()
    {
        return $this->belongsToMany(NewRole::class, 'model_has_roles','model_id','role_id');
    }

    public function certificadoRelationship()
    {
        return $this->hasMany(Certificado::class,'user_id','id');
    }

}
