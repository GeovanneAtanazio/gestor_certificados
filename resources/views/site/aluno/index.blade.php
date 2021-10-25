@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')
    <h1>Alunos</h1>
@stop

@section('content')
    <div class="container-fluid">
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Curso</th>
                    <th>Carga Horária Complementar</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $alunos as $aluno )
                    <tr>
                        <td>{{$aluno->name}}</td>
                        <td> {{$aluno->curso->nome}} </td>
                        <td> {{$aluno->carga_horaria_complementar}}/{{$aluno->curso->carga_horaria_complementar}}</td>
                        <td>
                            <a href="{{route('aluno.show', Crypt::encrypt($aluno->id))}}" class="btn btn-info" style="color: white">Visualizar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
