<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Entities\User;
use App\Models\CargaHoraria;
use App\Models\Logger;

class AlunoController extends Controller
{
    /**
     * Global private declarations.
     */
    private $alunos,$logger;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(User $users)
    {
        $this->alunos = $users;
        $this->logger = new Logger;

        $this->middleware('permission:aluno.index', ['only' => ['index']]);
        $this->middleware('permission:aluno.show', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = $this->alunos->whereHas("roles", function($q){ $q->where("name", "Aluno"); })->get();
        $this->logger->log('info','Editou na listagem de alunos;');
        return view('site.aluno.index',compact('alunos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        $aluno = $this->alunos->find(Crypt::decrypt($id));
        $porcentagem = CargaHoraria::cargaHorariaComplementarCursada($aluno);
        $certificados = $aluno->certificadoRelationship;
        $gestorCargaHoraria = CargaHoraria::comparadorCargaHorariaCurso($aluno->carga_horaria_complementar, $aluno->curso->carga_horaria_complementar);
        $this->logger->log('info','Visualizou o aluno'.$aluno.';');

        return view('site.certificado.index',compact('certificados','aluno','porcentagem','gestorCargaHoraria'));
    }
}
