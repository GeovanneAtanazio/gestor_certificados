<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Entities\Certificado;
use App\Models\Entities\User;
use App\Models\Entities\TipoCertificado;
use App\Models\Entities\StatusCertificado;
use App\Models\Converters;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CertificadoRequest;

class CertificadoController extends Controller
{
    /**
     * Global private declarations.
     */
    private $certificados, $tiposCertificados, $statusCertificados, $aluno;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Certificado $certificados)
    {
        $this->certificados = $certificados;
        $this->tiposCertificados = Converters::convert_object_to_array(TipoCertificado::all(),'id','nome');
        $this->statusCertificados = Converters::convert_object_to_array(StatusCertificado::all(),'id','nome');
        $this->aluno = new User;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->roles->first()->id==2){
            $aluno = Auth::user();
            $certificados = $aluno->certificadoRelationship;
            $porcentagem = ((int)(($aluno->carga_horaria_complementar/$aluno->curso->carga_horaria_complementar)*100));
            return view('site.certificado.index',compact('certificados','aluno','porcentagem'));
        }else{
            $certificados = $this->certificados->all();
            return view('site.certificado.index',compact('certificados'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $aluno = $this->aluno->find(Crypt::decrypt($id));
        $tiposCertificados = $this->tiposCertificados;
        $statusCertificados = $this->statusCertificados;
        return view('site.certificado.form',compact('tiposCertificados','statusCertificados','aluno'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CertificadoRequest $request, $id)
    {
        $certificado = $this->certificados->create([
            'titulo' => $request->titulo,
            'carga_horaria' => $request->carga_horaria,
            'tipoCertificado' => $request->tipoCertificado,
            'statusCertificado' => $request->statusCertificado??1,
            'aluno' => Crypt::decrypt($id),
        ]);
        $check = 'Certificado criado com sucesso!';
        return redirect()->route('aluno.show', $id)->with('check', $check);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $certificado = $this->certificados->find(Crypt::decrypt($id));
        $tiposCertificados = $this->tiposCertificados;
        $statusCertificados = $this->statusCertificados;
        $form = 'disabled';
        return view('site.certificado.form',compact('certificado','tiposCertificados','statusCertificados','form'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CertificadoRequest $request, $id)
    {
        $certificado = $this->certificados->find(Crypt::decrypt($id));
        $certificado = $certificado->update($request->all());
        $check = 'Certificado atualizado com sucesso!';
        return redirect()->route('certificado.show', $id)->with('check', $check);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $certificado = $this->certificados->find(Crypt::decrypt($id));
        $certificado->delete();
        return redirect()->route('aluno.show', Crypt::encrypt($certificado->aluno->id));
    }
}
