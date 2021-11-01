@extends('adminlte::page')

@section('title', 'Certificados')

@section('content_header')
    <h1>Certificados {{isset($aluno)?'de '.$aluno->name:null}}</h1>
    @if (isset($aluno))
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$porcentagem}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$porcentagem}}%">{{$aluno->carga_horaria_complementar}}/{{$aluno->curso->carga_horaria_complementar}}</div>
        </div>
    @endif
@stop

@section('content')
    @if (Session::has('check'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{Session::get('check')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (isset($gestorCargaHoraria)&&($gestorCargaHoraria==true))
        <div class="container-fluid create-section">
            <a href="{{route('certificado.create', Crypt::encrypt($aluno->id))}}" class="btn btn-outline-primary">+ Criar Novo</a>
        </div>
    @endif

    <div class="container-fluid">
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Aluno</th>
                    <th>Carga Horária</th>
                    <th>Tipo</th>
                    <th>Situação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $certificados as $certificado )
                    <tr>
                        <td>{{$certificado->titulo}}</td>
                        <td>{{$certificado->aluno->name}}</td>
                        <td>{{$certificado->carga_horaria}}</td>
                        <td>{{$certificado->tipoCertificado->nome}}</td>
                        <td>
                            <h5>
                                @if ($certificado->statusCertificado->id==1)
                                    <span class="badge badge-warning">
                                @elseif ($certificado->statusCertificado->id==2)
                                    <span class="badge badge-success">
                                @elseif ($certificado->statusCertificado->id==3)
                                    <span class="badge badge-danger">
                                @endif
                                        {{$certificado->statusCertificado->nome}}
                                    </span>
                            <h5>
                        </td>
                        <td >
                            <a href="{{route('certificado.show', Crypt::encrypt($certificado->id))}}" class="btn btn-info">Visualizar</a>

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
