<?php

namespace App\Models;

use App\Models\Entities\User;
use App\Models\Entities\Certificado;


class CargaHoraria
{
    /**
     * Calcula a porcentagem da carga horaria complementar já cursa pelo aluno.
     *
     * @param  User  $aluno
     * @return bool
     */
    public static function cargaHorariaComplementarCursada(User $aluno)
    {
        return ((($aluno->carga_horaria_complementar/$aluno->curso->carga_horaria_complementar)*100));
    }

    /**
     * Atualiza a carga horaria complementar já cursa pelo aluno.
     *
     * @param  User $aluno
     * @param  array $certificados
     * @return bool
     */
    public static function gerenciaCargaHoraria(User $aluno, $certificados)
    {

         return $aluno->update([
            'carga_horaria_complementar' => CargaHoraria::somatorioCertificados($certificados)
        ]);

    }

    /**
     * Calcula o somatorio dos certificados homologados.
     *
     * @param  array $certificados
     * @return int
     */
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
    /**
     * Compara a carga horária do aluno com a carga horária do curso dele,
     * verificando se a primeira é maior que a segunda.
     *
     * @param  int $cargaHorariaAluno
     * @param  int $cargaHorariaCurso
     * @return bool
     */
    public static function comparadorCargaHorariaCurso($cargaHorariaAluno, $cargaHorariaCurso)
    {
        if(($cargaHorariaAluno)>=($cargaHorariaCurso)){
            return false;
        }else{
            return true;
        }
    }

}
