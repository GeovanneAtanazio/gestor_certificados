<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Entities\User;

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
        $porcentagem = ((int)(($aluno->carga_horaria_complementar/$aluno->curso->carga_horaria_complementar)*100));
        $certificados = $aluno->certificadoRelationship;
        return view('site.certificado.index',compact('certificados','aluno','porcentagem'));
    }
}
