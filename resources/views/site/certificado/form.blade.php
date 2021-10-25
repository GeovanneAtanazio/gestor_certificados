@extends('adminlte::page')

@section('title', 'Certificados')

@section('content_header')
    <h1>Certificado</h1>
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
    @if (isset($certificado))
        {!! Form::open(['route' => array('certificado.update', Crypt::encrypt($certificado->id)), 'method' => 'PUT', 'name' => 'form'])!!}
    @else
        {!! Form::open(['route' => array('certificado.store', Crypt::encrypt($aluno->id)), 'method' => 'POST', 'name' => 'form']) !!}
    @endif
    <div class="container-fluid">
        {!!Form::label('titulo', 'Título:', ['class' => 'form-check-label'])!!}
        {!!Form::text('titulo',  isset($certificado) ? $certificado->titulo : null , ['class' => $errors->has('titulo') ? 'form-control is-invalid' : 'form-control', isset($form) ? $form : null])!!}

        {!!Form::label('aluno', 'Aluno:', ['class' => 'form-check-label'])!!}
        {!!Form::text('aluno',  isset($certificado) ? $certificado->aluno->name : $aluno->name , ['class' => $errors->has('aluno') ? 'form-control is-invalid' : 'form-control', 'disabled'])!!}

        {!! Form::label('carga_horaria','Carga Horária:', ['class' => 'form-check-label']) !!}
        {!!Form::number('carga_horaria', isset($certificado) ? $certificado->carga_horaria : null , ['class' => $errors->has('carga_horaria') ? 'form-control is-invalid' : 'form-control',  'placeholder' => 'Somente Números', 'maxlength' =>  "5", 'pattern' => '([0-9]{1-5})', isset($form) ? $form : null])!!}

        {!!Form::label('tipoCertificado', 'Tipo Certificado:', ['class' => 'form-check-label'])!!}
        {!!Form::select('tipoCertificado', $tiposCertificados, isset($certificado) ? $certificado->tipoCertificado->id : null, ['class' => 'form-control', isset($form) ? $form : null,'id'=> 'tipoCertificado'])!!}

        @if ((isset($certificado))||(Auth::user()->roles->first()->id==1))
             {!!Form::label('statusCertificado', 'Situação:', ['class' => 'form-check-label'])!!}
            {!!Form::select('statusCertificado', $statusCertificados, isset($certificado) ? $certificado->statusCertificado->id : null, ['class' => 'form-control', Auth::user()->roles->first()->id==1 ? null : 'disabled','id'=> 'tipoCertificado'])!!}
        @endif

        <button id='salvar' type="button" class="btn btn-warning" data-toggle="modal" data-target="#confirmacaoModal" {{isset($form) ? $form : null}} style="margin: 8px 4px">
            Salvar
        </button>
        <!-- Modal -->
        <div class="modal fade" id="confirmacaoModal" tabindex="-1" role="dialog" aria-labelledby="confirmacaoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        {{isset($familia) ? 'Você deseja salvar as alterações feitas?' : 'Você deseja cadastrar um novo certificado?'}}
                        <hr/>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                        {!! Form::submit('Sim', ['class' => 'btn btn-success']); !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@stop

@section('js')
    <script>

    </script>
@stop
