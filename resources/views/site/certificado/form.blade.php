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
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @if (isset($certificado))
        {!! Form::open(['route' => array('certificado.update', Crypt::encrypt($certificado->id)), 'method' => 'PUT', 'name' => 'form', 'files' => true])!!}
    @else
        {!! Form::open(['route' => array('certificado.store', Crypt::encrypt($aluno->id)), 'method' => 'POST', 'name' => 'form', 'files' => true]) !!}
    @endif
    <div class="container-fluid">
        {!!Form::label('titulo', 'Título:', ['class' => 'form-check-label'])!!}
        {!!Form::text('titulo',  isset($certificado) ? $certificado->titulo : null , ['class' => $errors->has('titulo') ? 'form-control is-invalid' : 'form-control', $form??null])!!}

        {!!Form::label('aluno', 'Aluno:', ['class' => 'form-check-label'])!!}
        {!!Form::text('aluno',  isset($certificado) ? $certificado->aluno->name : $aluno->name , ['class' => $errors->has('aluno') ? 'form-control is-invalid' : 'form-control', 'disabled'])!!}

        {!! Form::label('carga_horaria','Carga Horária:', ['class' => 'form-check-label']) !!}
        {!!Form::text('carga_horaria', isset($certificado) ? $certificado->carga_horaria : null , ['class' => $errors->has('carga_horaria') ? 'form-control is-invalid' : 'form-control',  'placeholder' => 'Somente Números', 'maxlength' =>  "5", 'pattern' => '([0-9]{1-5})', $form??null])!!}

        {!!Form::label('tipoCertificado', 'Tipo Certificado:', ['class' => 'form-check-label'])!!}
        {!!Form::select('tipoCertificado', $tiposCertificados, isset($certificado) ? $certificado->tipoCertificado->id : null, ['class' => 'form-control', isset($form) ? $form : null,'id'=> 'tipoCertificado', $form??null])!!}

        @if ((isset($certificado))||(Auth::user()->roles->first()->id==1))
            {!!Form::label('statusCertificado', 'Situação:', ['class' => 'form-check-label'])!!}
            {!!Form::select('statusCertificado', $statusCertificados, isset($certificado) ? $certificado->statusCertificado->id : null, ['class' => 'form-control', Auth::user()->roles->first()->id==1 ? null : 'disabled','id'=> 'statusCertificado', $form??null])!!}
        @endif
        <div>
            {!!Form::label('arquivo', 'Arquivo:', ['class' => 'form-check-label'])!!}
            {!!Form::file('arquivo', ['class' => $errors->has('titulo') ? 'form-control is-invalid' : 'form-control', 'accept'=>"image/*", $form??null])!!}
            <img id="certificado_img" src="{{isset($certificado)?url("storage/{$certificado->arquivo}"):'#'}}" alt="Seu Certificado" style="max-height: 100px; margin-top: 8px"/>
        </div>
        @if(isset($certificado))
            <button id="edit" type="button" class="btn btn-info" onclick="abilitarEdicao($(this))">
                {{isset($form)?'Modificar':'Preservar'}}
            </button>
        @endif

        <button id='salvar' type="button" class="btn btn-warning" data-toggle="modal" data-target="#confirmacaoModal" {{isset($form) ? $form : null}}>
            Salvar
        </button>

        @if ((isset($certificado))&&($certificado->statusCertificado->id!=2))
            <button id='excluir' type="button" class="btn btn-danger" data-toggle="modal" data-target="#exclusaoModal" {{isset($form) ? $form : null}}>
                Excluir
            </button>
        @endif
        <!-- Modal -->
        <div class="modal fade" id="confirmacaoModal" tabindex="-1" role="dialog" aria-labelledby="confirmacaoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        {{isset($certificado) ? 'Você deseja salvar as alterações feitas?' : 'Você deseja cadastrar um novo certificado?'}}
                        <hr/>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                        {!! Form::submit('Sim', ['class' => 'btn btn-success']); !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
    @if ((isset($certificado))&&($certificado->statusCertificado->id!=2))
            <!-- Modal -->
            <div class="modal fade" id="exclusaoModal" tabindex="-1" role="dialog" aria-labelledby="exclusaoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            Você deseja excluir este certificado?
                            <hr/>
                            <button type="button" class="btn btn btn-success" data-dismiss="modal">Não</button>
                            {!! Form::open(['route' => array('certificado.destroy', Crypt::encrypt($certificado->id)), 'method' => 'DELETE', 'name' => 'form'])!!}
                                {!! Form::submit('Sim', ['class' => 'btn btn-danger']); !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

        @endif
@stop

@section('js')
    <script>
         $(document).ready(function() {
            $("#carga_horaria").keyup(function() {
                $("#carga_horaria").val(this.value.match(/[0-9]*/));
            });
        });
        arquivo.onchange = evt => {
            const [file] = arquivo.files
            if (file) {
                certificado_img.src = URL.createObjectURL(file)
            }
        }
    </script>
    @if(isset($certificado))
        <script>
            function desabilitarEdicao(botao) {
                //Bloqueia Formulario
                $("#titulo").prop('disabled', true);
                $("#carga_horaria").prop('disabled', true);
                $("#tipoCertificado").prop('disabled', true);
                $("#statusCertificado").prop('disabled', true);
                $("#salvar").prop('disabled', true);
                $("#excluir").prop('disabled', true);
                $("#arquivo").prop('disabled', true);
                //Modifica Texto do Botao
                $(botao).html('Modificar');
                //Modifica função do Botao
                botao.attr('onclick', 'abilitarEdicao($(this));');

                //Reseta formulário
                $("#titulo").val("{{$certificado->titulo}}");
                $("#carga_horaria").val("{{$certificado->carga_horaria}}");
                $("#tipoCertificado").val("{{$certificado->tipoCertificado->id}}");
                $("#statusCertificado").val("{{$certificado->statusCertificado->id}}");
                $("#arquivo").val("");
                certificado_img.setAttribute('src', "{{url("storage/{$certificado->arquivo}")}}");


            }
            function abilitarEdicao(botao) {
                $("#titulo").prop('disabled', false);
                $("#carga_horaria").prop('disabled', false);
                $("#tipoCertificado").prop('disabled', false);
                $("#statusCertificado").prop('disabled', false);
                $("#salvar").prop('disabled', false);
                $("#excluir").prop('disabled', false);
                $("#arquivo").prop('disabled', false);

                $(botao).html('Preservar');
                botao.attr('onclick', 'desabilitarEdicao($(this));');
            }
        </script>
    @endif
@stop
