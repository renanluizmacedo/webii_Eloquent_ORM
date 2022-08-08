<div class="row">
    <div class="col">
        <h3 class="display-7 text-secondary d-none d-md-block"><b>Alunos</b></h3>
    </div>
    <div class="col d-flex justify-content-end">
        <a href="{{ route('professores.create') }}" class="btn btn-dark btn-create">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
            </svg>
        </a>
        
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table align-middle caption-top  table-dark table-striped">
            <caption>Tabela de <b>Alunos</b></caption>
            <thead>
                <tr class="header-table">
                    @php $cont=0; @endphp
                    @foreach ($header as $item)

                        @if($hide[$cont])
                            <th scope="col" class="d-none d-md-table-cell">{{ $item }}</th>
                        @else
                            <th scope="col">{{ $item }}</th>
                        @endif
                        @php $cont++; @endphp

                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>


                </tr>
            </tbody>
        </table>
    </div>
</div>