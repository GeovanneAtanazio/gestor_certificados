<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entities\NivelCurso;
use App\Models\Entities\Curso;
use App\Models\Entities\TipoCertificado;
use App\Models\Entities\StatusCertificado;
use App\Models\Entities\Certificado;
use App\Models\Entities\Comentario;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function teste()
    {
        $niveis_cursos = NivelCurso::all();
        $cursos = Curso::all();
        $tiposCertificados = TipoCertificado::all();
        $statusCertificados = StatusCertificado::all();
        $certificados = Certificado::all();
        $comentarios = Comentario::all();
        return view('home', compact('niveis_cursos','cursos','tiposCertificados','statusCertificados','certificados','comentarios'));
    }
}
