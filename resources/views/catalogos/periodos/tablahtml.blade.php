<style>
    .custom-title {
        color: #343a40; 
        font-weight: bold; 
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); 
    }
</style>

<div class="container text-center mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="custom-title">Motor de búsqueda de periodos</h1>

    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('periodos.index') }}">
        <input
            class="form-control me-sm-2"
            type="text"
            name="txtBuscar"  
            placeholder="Buscar periodo..."
            value="{{ request('txtBuscar') }}" 
        />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Buscar
        </button>
    </form>

    <h1 class="custom-title">¡Bienvenido a la página de periodos!</h1>
</div>

<div class="table-responsive-md text-center">
    <a href="{{ route('periodos.create') }}"> <img src="{{ asset('img/icono-nuevo.png') }}" width="50px"> </a>
    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Periodo</th>
                <th scope="col">Periodo</th>
                <th scope="col">Descripción Corta</th>
                <th scope="col">Fecha Inicio</th>
                <th scope="col">Fecha Fin</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($periodos as $periodo)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $periodo->idPeriodo }}</td>
                    <td>{{ $periodo->periodo }}</td>
                    <td>{{ $periodo->desCorta }}</td>
                    <td>{{ $periodo->fechaIni }}</td>
                    <td>{{ $periodo->fechaFin }}</td>
                    <td><a href="{{ route('periodos.show', $periodo->id) }}"> <img src="{{ asset('img/icono-ver.png') }}" width="50px"> </a></td>
                    <td><a href="{{ route('periodos.eliminar', $periodo->id) }}"> <img src="{{ asset('img/icono-delete.png') }}" width="50px"> </a></td>
                    <td><a href="{{ route('periodos.edit', $periodo->id) }}"> <img src="{{ asset('img/icono-editar.png') }}" width="50px"> </a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No se encontraron periodos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $periodos->links() }}
</div>