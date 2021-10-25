@extends('adminlte::page')

@section('content')

    @foreach ( $niveis_cursos as $nivel_curso)
        {{$nivel_curso}}<br/>
    @endforeach

    @foreach ( $cursos as $curso)
        {{$curso}}<br/>
    @endforeach

    @foreach ( $tiposCertificados as $tipoCertificado)
        {{$tipoCertificado}}<br/>
    @endforeach

    @foreach ( $statusCertificados as $statusCertificado)
        {{$statusCertificado}}<br/>
    @endforeach

    @foreach ( $certificados as $certificado)
        {{$certificado}}<br/>
    @endforeach

    @foreach ( $comentarios as $comentario)
        {{$comentario}}<br/>
    @endforeach
@endsection
