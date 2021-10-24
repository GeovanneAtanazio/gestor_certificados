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
    ];

    /**
     * Get the curso's nivelCurso.
     *
     * @return string
     */
    public function getCursoAttribute()
    {
        return $this->cursoRelationship;
    }

    /**
     * Set the curso's nivelCurso.
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
     * Get the familia that owns the cidadao.
     *
     * @return Curso
     */
    public function cursoRelationship()
    {
        return $this->belongsTo(Curso::class,'curso_id');
    }

}
