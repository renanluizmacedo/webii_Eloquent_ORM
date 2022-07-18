@extends('templates/main')

@section('conteudo')
<div class="row">
    <div class="col">
        <h3 class="display-7 text-secondary d-none d-md-block"><b>Professor/Disciplinas</b></h3>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table align-middle caption-top  table-dark table-striped">
            <caption>Tabela de <b>Disciplinas</b></caption>
            <thead>
                <tr class="header-table">
                    <th scope="col" class="d-none d-md-table-cell">Disciplina</th>
                    <th scope="col" class="d-none d-md-table-cell">Curso</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doc as $item)
                <tr>
                    <td>{{$item->disciplina->nome}}</td>
                    <td>{{$item->disciplina->curso->nome}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection