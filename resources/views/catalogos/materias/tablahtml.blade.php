<div class="table-responsive-md text-center">
    <a href="{{ route('materias.create') }}"> 
        <img src="{{ asset('img/icono-nuevo.png') }}" width="50px">  
    </a>
    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Materia</th>
                <th scope="col">Nombre Materia</th>
                <th scope="col">Nivel</th>
                <th scope="col">Nombre Mediano</th>
                <th scope="col">Nombre Corto</th>
                <th scope="col">Modalidad</th>
                <th scope="col">Carrera</th>
                <th scope="col">Creado</th>
                <th scope="col">Actualizado</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materias as $materia)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $materia->idMateria }}</td>
                    <td>{{ $materia->nombreMateria }}</td>
                    <td>{{ $materia->nivel }}</td>
                    <td>{{ $materia->nombreMediano }}</td>
                    <td>{{ $materia->nombreCorto }}</td>
                    <td>{{ $materia->modalidad }}</td>
                    <td>{{ $materia->carrera->nombreCarrera }}</td>
                    <td>{{ $materia->created_at }}</td>
                    <td>{{ $materia->updated_at }}</td>
                    <td><a href="{{ route('materias.show', $materia->id) }}"> <img src="{{ asset('img/icono-ver.png') }}" width="50px">  </a></td>
                    <td><a href="{{ route('materias.eliminar', $materia->id) }}"> <img src="{{ asset('img/icono-delete.png') }}" width="50px">  </a></td>
                    <td><a href="{{ route('materias.edit', $materia->id) }}"> <img src="{{ asset('img/icono-editar.png') }}" width="50px">  </a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $materias->links() }}
</div>
