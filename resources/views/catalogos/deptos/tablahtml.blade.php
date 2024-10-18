<style>
    .custom-title {
        color: #343a40;
        font-weight: bold;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }
</style>
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container text-center mt-5">
        <h1 class="custom-title">Motor de busqueda de departamentos</h1>
    </div>
 {{-- la variable requets va y busca el objeto  --}}
 <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('deptos.index') }}">
    <input
        class="form-control me-sm-2"
        type="text"
        name="txtBuscar"  
        placeholder="Buscar departamento...."
        value="{{ request('txtBuscar') }}" 
    />
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
        Search
    </button>
</form>

    <div class="container text-center mt-5">
        <h1 class="custom-title">¡Bienvenido a la página de departamentos!</h1>
    </div>
    <div class="container mt-12 text-center">
        <a href="{{ route('deptos.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px">
        </a>
           
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ID Depto</th> 
                    <th scope="col">Nombre del Depto</th>
                    <th scope="col">Nombre Mediano</th> 
                    <th scope="col">Nombre Corto</th> 
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departamentos as $departamento)
                    <tr>
                        <td scope="row">{{ $departamento->id }}</td>
                        <td>{{ $departamento->idDepto }}</td> <!-- Nuevo campo -->
                        <td>{{ $departamento->nombreDepto }}</td>
                        <td>{{ $departamento->nombreMediano }}</td> <!-- Nuevo campo -->
                        <td>{{ $departamento->nombreCorto }}</td> <!-- Nuevo campo -->
                        <td><a href="{{ route('deptos.show', $departamento->id) }}"><img src="{{ asset('img/icono-ver.png') }}" width="50px"></a></td>
                        <td><a href="{{ route('deptos.eliminar', $departamento->id) }}"><img src="{{ asset('img/icono-delete.png') }}" width="50px"></a></td>
                        <td><a href="{{ route('deptos.edit', $departamento->id) }}"><img src="{{ asset('img/icono-editar.png') }}" width="50px"></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       
        {{ $departamentos->links() }}
    </div>
</div>
