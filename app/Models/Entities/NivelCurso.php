<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class NivelCurso extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'niveis_cursos';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at',
     ];
}
