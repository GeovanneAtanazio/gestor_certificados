<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Entities\User;
use App\Models\CargaHoraria;

class AlunoController extends Controller
{
    /**
     * Global private declarations.
     */
    private $alunos;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(User $users)
    {
        $this->alunos = $users;
    }

    public function index()
    {
        $alunos = $this->alunos->whereHas("roles", function($q){ $q->where("name", "Aluno"); })->get();
        return view('site.aluno.index',compact('alunos'));
    }

     public function show($id)
    {
        $aluno = $this->alunos->find(Crypt::decrypt($id));
        $porcentagem = CargaHoraria::cargaHorariaComplementarCursada($aluno);
        $certificados = $aluno->certificadoRelationship;
        $gestorCargaHoraria = CargaHoraria::gerenciaCargaHoraria($aluno,$certificados);
        return view('site.certificado.index',compact('certificados','aluno','porcentagem','gestorCargaHoraria'));
    }
}
