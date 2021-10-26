<?php

namespace App\Models;

use App\Models\Entities\User;
use App\Models\Entities\Certificado;


class CargaHoraria
{
    public static function cargaHorariaComplementarCursada(User $aluno)
    {
        return ((($aluno->carga_horaria_complementar/$aluno->curso->carga_horaria_complementar)*100));
    }

    public static function gerenciaCargaHoraria(User $aluno, $certificados)
    {

        $aluno->update([
            'carga_horaria_complementar' => CargaHoraria::somatorioCertificados($certificados)
        ]);

        return CargaHoraria::comparadorCargaHorariaCurso($aluno->carga_horaria_complementar, $aluno->curso->carga_horaria_complementar);
    }

    public static function somatorioCertificados($certificados)
    {
        $cargaHorariaCertificados = 0;

        foreach($certificados as $certificado){
            if(($certificado->statusCertificado->id)==2){
                $cargaHorariaCertificados += $certificado->carga_horaria;
            }
        }
        return $cargaHorariaCertificados;
    }

    public static function comparadorCargaHorariaCurso($cargaHorariaAluno, $cargaHorariaCurso)
    {
        if(($cargaHorariaAluno)>=($cargaHorariaCurso)){
            return false;
        }else{
            return true;
        }
    }

}
