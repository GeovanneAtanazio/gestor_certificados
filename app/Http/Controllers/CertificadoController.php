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
use App\Models\CargaHoraria;

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
        $this->middleware('permission:certificado.index', ['only' => ['index']]);
        $this->middleware('permission:certificado.create', ['only' => ['create']]);
        $this->middleware('permission:certificado.store', ['only' => ['store']]);
        $this->middleware('permission:certificado.show', ['only' => ['show']]);
        $this->middleware('permission:certificado.update', ['only' => ['update']]);
        $this->middleware('permission:certificado.destroy', ['only' => ['destroy']]);
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
            return redirect()->route('aluno.show', Crypt::encrypt($aluno->id));
        }else{
            $certificados = $this->certificados->all();
            return view('site.certificado.index',compact('certificados'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(CertificadoRequest $request, $id)
    {

        $certificado = $this->certificados->create([
            'titulo' => $request->titulo,
            'arquivo' => $request->arquivo->store('certificados'),
            'carga_horaria' => $request->carga_horaria,
            'tipoCertificado' => $request->tipoCertificado,
            'statusCertificado' => $request->statusCertificado??1,
            'aluno' => Crypt::decrypt($id),
        ]);
        $check = 'Certificado criado com sucesso!';
        CargaHoraria::gerenciaCargaHoraria($certificado->aluno,$certificado->aluno->certificadoRelationship);
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
        $certificado = $certificado->update([
            'titulo' => $request->titulo,
            'arquivo' => isset($request->arquivo)?$request->arquivo->store('certificados'):$certificado->arquivo,
            'carga_horaria' => $request->carga_horaria,
            'tipoCertificado' => $request->tipoCertificado,
            'statusCertificado' => $request->statusCertificado??$certificado->statusCertificado,
        ]);
        $certificado = $this->certificados->find(Crypt::decrypt($id));
        CargaHoraria::gerenciaCargaHoraria($certificado->aluno,$certificado->aluno->certificadoRelationship);
        $check = 'Certificado atualizado com sucesso!';
        return redirect()->route('aluno.show', Crypt::encrypt($this->certificados->find(Crypt::decrypt($id))->aluno->id))->with('check', $check);

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
        $aluno = $certificado->aluno->id;
        $certificado->delete();
        $check = 'Certificado excluído com sucesso!';
        return redirect()->route('aluno.show', Crypt::encrypt($aluno))->with('check', $check);
    }
}
