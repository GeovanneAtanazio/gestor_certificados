<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'certificados';

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
        'status_certificado_id',
        'tipo_certificado_id',
        'created_at',
        'updated_at',

        'alunoRelationship',
        'statusCertificadoRelationship',
        'tipoCertificadoRelationship',
     ];

     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'statusCertificado',
        'tipoCertificado',
        'aluno',
    ];

    /**
     * Get the certificado's aluno.
     *
     * @return string
     */
    public function getAlunoAttribute()
    {
        return $this->alunoRelationship;
    }

    /**
     * Get the certificado's statusCertificado.
     *
     * @return string
     */
    public function getStatusCertificadoAttribute()
    {
        return $this->statusCertificadoRelationship;
    }

    /**
     * Get the certificado's tipoCertificado.
     *
     * @return string
     */
    public function getTipoCertificadoAttribute()
    {
        return $this->tipoCertificadoRelationship;
    }

    /**
     * Set the certificado's aluno.
     *
     * @param  int  $value
     * @return void
     */
    public function setAlunoAttribute($value)
    {
        if(isset($value)){
            $this->attributes['user_id'] = User::where('id', $value)->first()->id;
        }
    }

    /**
     * Set the certificado's statusCertificado.
     *
     * @param  int  $value
     * @return void
     */
    public function setStatusCertificadoAttribute($value)
    {
        if(isset($value)){
            $this->attributes['status_certificado_id'] = StatusCertificado::where('id', $value)->first()->id;
        }
    }

    /**
     * Set the certificado's tipoCertificado.
     *
     * @param  int  $value
     * @return void
     */
    public function setTipoCertificadoAttribute($value)
    {
        if(isset($value)){
            $this->attributes['tipo_certificado_id'] = TipoCertificado::where('id', $value)->first()->id;
        }
    }

    /**
     * Get the aluno that owns the certificado.
     *
     * @return User
     */
    public function alunoRelationship()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Get the statusCertificado that owns the certificado.
     *
     * @return StatusCertificado
     */
    public function statusCertificadoRelationship()
    {
        return $this->belongsTo(StatusCertificado::class,'status_certificado_id');
    }

    /**
     * Get the tipoCertificado that owns the certificado.
     *
     * @return TipoCertificado
     */
    public function tipoCertificadoRelationship()
    {
        return $this->belongsTo(TipoCertificado::class,'tipo_certificado_id');
    }

    /**
     * Get the comentario that owns the certificado.
     *
     * @return Comentario
     */
    public function comentarioRelationship()
    {
        return $this->hasMany(Comentario::class,'certificado_id','id');
    }
}
