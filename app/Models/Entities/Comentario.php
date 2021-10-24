<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comentarios';

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
        'user_id',
        'certificado_id',
        'created_at',
        'updated_at',
        'certificadoRelationship',
        'usuarioRelationship',
     ];

     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'certificado',
        'usuario',
    ];

    /**
     * Get the comentario's certificado.
     *
     * @return string
     */
    public function getCertificadoAttribute()
    {
        return $this->certificadoRelationship->id;
    }

    /**
     * Get the comentario's certificado.
     *
     * @return string
     */
    public function getUsuarioAttribute()
    {
        return $this->usuarioRelationship->id;
    }

    /**
     * Set the curso's aluno.
     *
     * @param  int  $value
     * @return void
     */
    public function setCertificadoAttribute($value)
    {
        if(isset($value)){
            $this->attributes['certificado_id'] = Certificado::where('id', $value)->first()->id;
        }
    }

    /**
     * Set the curso's aluno.
     *
     * @param  int  $value
     * @return void
     */
    public function setUsuarioAttribute($value)
    {
        if(isset($value)){
            $this->attributes['user_id'] = User::where('id', $value)->first()->id;
        }
    }

    /**
     * Get the statusCertificado that owns the certificado.
     *
     * @return Certificado
     */
    public function certificadoRelationship()
    {
        return $this->belongsTo(Certificado::class,'certificado_id');
    }

    /**
     * Get the statusCertificado that owns the certificado.
     *
     * @return User
     */
    public function usuarioRelationship()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
