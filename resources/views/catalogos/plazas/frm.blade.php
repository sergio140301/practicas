@extends('inicio2')

@section('contenido2')
    @include('catalogos.plazas.index')
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
                        action="@if ($accion == 'crear') 
                                    {{ route('plazas.store') }} 
                                @else 
                                    {{ route('plazas.update', $plaza->idplaza) }} 
                                @endif">
                        @csrf
                        @if ($accion == 'eliminar')
                            @method('DELETE')
                        @endif

                        <div class="mb-3">
                            <label for="idplaza" class="form-label">ID Plaza</label>
                            <input type="text" name="idplaza" class="form-control" maxlength="7" id="idplaza"
                                value="{{ old('idplaza', $plaza->idplaza ?? '') }}" {{$desabilitado}}>
                            @error('idplaza')
                                <ul class="list-unstyled text-danger">
                                    <p>error en el ID Plaza {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Escribe el ID de la plaza</div>
                        </div>

                        <div class="mb-3">
                            <label for="nombreplaza" class="form-label">Nombre Plaza</label>
                            <input type="text" name="nombreplaza" class="form-control" id="nombreplaza" maxlength="50"
                                value="{{ old('nombreplaza', $plaza->nombreplaza ?? '') }}" {{$desabilitado}}>
                            @error('nombreplaza')
                                <ul class="list-unstyled text-danger">
                                    <p>error en el nombre de la plaza {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Escribe el nombre de la plaza</div>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
