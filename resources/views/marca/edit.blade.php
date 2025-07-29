@extends('template')

@section('title', 'Editar marca')

@push('css')
    <style>
        #descripcion {
            resize: none;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4 text-center">Editar Marca</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}"><i class="fas fa-home"></i> Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('marcas.index') }}"><i class="fa-solid fa-tag"></i> Marca</a>
                </li>
                <li class="breadcrumb-item active"><i class="fas fa-edit"></i> Editar Marca</li>
            </ol>
        </nav>

        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{ route('marcas.update', ['marca' => $marca]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="row g-3">

                    <div class="col-md-6 mb-2">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control rounded pill"
                            placeholder="Ingrese el nombre" value="{{ old('nombre', $marca->caracteristica->nombre) }}">
                        @error('nombre')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-10 mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" rows="3" class="form-control shadow-sm rounded-3"
                            placeholder="Ej. Productos electrónicos, accesorios, etc.">{{ old('descripcion', $marca->caracteristica->descripcion) }}</textarea>
                        @error('descripcion')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn btn-primary shadow rounded-pill px-2">Actualizar</button>
                        <button type="reset" class="btn btn-secondary shadow rounded-pill px-2">Reiniciar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
@endpush
