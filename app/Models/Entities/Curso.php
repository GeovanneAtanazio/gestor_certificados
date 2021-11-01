<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cursos';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot',
        'nivel_curso_id',
        'created_at',
        'updated_at',
        'nivelCursoRelationship',
     ];

     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'nivelCurso',
    ];

    /**
     * Get the curso's nivelCurso.
     *
     * @return string
     */
    public function getNivelCursoAttribute()
    {
        return $this->nivelCursoRelationship->nome;
    }

    /**
     * Set the curso's nivelCurso.
     *
     * @param  int  $value
     * @return void
     */
    public function setNivelCursoAttribute($value)
    {
        if(isset($value)){
            $this->attributes['nivel_curso_id'] = NivelCurso::where('id', $value)->first()->id;
        }
    }

    /**
     * Get the nivelCurso that owns the curso.
     *
     * @return NivelCurso
     */
    public function nivelCursoRelationship()
    {
        return $this->belongsTo(NivelCurso::class,'nivel_curso_id');
    }

}
