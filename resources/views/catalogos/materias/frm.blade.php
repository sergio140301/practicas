@extends('inicio2')

@section('contenido1')
    @include('catalogos.materias.tablahtml') 
@endsection

@section('contenido4000')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        @if ($accion == 'crear')
                            Insertando datos nuevos
                        @elseif ($accion == 'actualizar')
                            Actualizando datos
                        @elseif ($accion == 'ver')
                            Ver datos
                        @endif
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" 
                    action="{{ $accion == 'crear' ? route('materias.store') : route('materias.update', $materia->id) }}">
                        @csrf
                        @if ($accion == 'actualizar')
                            @method('PUT')
                        @endif
                        @if ($accion == 'eliminar')
                            @method('DELETE')
                        @endif

                        <div class="mb-3">
                            <label for="idMateria" class="form-label">ID Materia</label>
                            <input type="text" name="idMateria" class="form-control" maxlength="15" id="idMateria"
                                   value="{{ old('idMateria', $materia->id ?? '') }}" {{$desabilitado}}>
                            @error('idMateria')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en el ID Materia: {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Escribe el ID de la materia</div>
                        </div>

                        <div class="mb-3">
                            <label for="nombreMateria" class="form-label">Nombre de Materia</label>
                            <input type="text" name="nombreMateria" class="form-control" id="nombreMateria"
                                   value="{{ old('nombreMateria', $materia->nombreMateria ?? '') }}" {{$desabilitado}}>
                            @error('nombreMateria')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en el nombre de la materia: {{ $message }}</p>
                                </ul>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nivel" class="form-label">Nivel</label>
                            <select name="nivel" class="form-control" id="nivel" {{$desabilitado}}>
                                <option value="" disabled selected>Selecciona un nivel</option>
                                <option value="S" {{ old('nivel', $materia->nivel ?? '') == 'S' ? 'selected' : '' }}>S</option>
                                <option value="L" {{ old('nivel', $materia->nivel ?? '') == 'L' ? 'selected' : '' }}>L</option>
                                <option value="F" {{ old('nivel', $materia->nivel ?? '') == 'F' ? 'selected' : '' }}>F</option>
                            </select>
                            @error('nivel')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en el nivel: {{ $message }}</p>
                                </ul>
                            @enderror
                        </div>
                        

                        <div class="mb-3">
                            <label for="carrera_id" class="form-label">Carrera</label>
                            <select name="carrera_id" class="form-control" id="carrera_id" {{$desabilitado}}>
                                <option value="" disabled selected>Selecciona una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}" {{ old('carrera_id', $materia->carrera_id ?? '') == $carrera->id ? 'selected' : '' }}>
                                        {{ $carrera->nombreCarrera }}
                                    </option>
                                @endforeach
                            </select>
                            @error('carrera_id')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en la carrera: {{ $message }}</p>
                                </ul>
                            @enderror
                        </div>

                        @if ($accion != 'ver')
                            <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                        @endif
                    </form>

                    @if ($accion == 'ver')
                        <a href="{{ route('materias.index') }}" class="btn btn-primary">Regresar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
