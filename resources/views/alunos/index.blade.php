<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main')
<!-- Preenche o conteúdo da seção "titulo" -->
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

<div class="row">
    <div class="col">

        <!-- Utiliza o componente "datalist" criado -->
        <x-datalistAlunos :header="['NOME', 'EIXO','STATUS', 'AÇÕES']" 
        :hide="[ false, true, true,false]" />

    </div>

</div>
@endsection