@extends('template')

@section('title','Crear proveedor')

@push('css')
<style>
    #box-razon-social {
        display: none;
    
    }
</style>

@endpush
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Proveedor</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('proveedores.index')}}">Proveedor</a></li>
        <li class="breadcrumb-item active">Crear proveedor</li>
    </ol>

    <div class="container border border-3 border-primary rounded p-4 mt-3">
        <form action="{{ route('proveedores.store') }}" method="post">
            @csrf
            <div class="row g-3">

                {{-- Tipo cliente --}}

                <div class="col-md mb-2">
                    <label for="tipo_persona" class="form-label">Tipo de cliente</label>
                    <select class="form-select" name="tipo_persona" id="tipo_persona">
                        <option value="" selected disabled>Seleciones una opcion</option>
                        <option value="natural" {{ old('tipo_persona') == 'natural' ? 'selected' : '' }}>persona natural</option>
                        <option value="juridica" {{ old('tipo_persona') == 'natural' ? 'selected' : '' }}>persona juridica</option>
                </select>
                @error('tipo_persona')
                <small class="text-danger">{{'*' .message}}</small>
                @enderror
                </div>

                {{-- Razon social --}}

                <div class="col-md-12 mb-2" id="box-razon-social">
                    <label id="label-natural" for="razon_social" class="form-label">Nombres y apellido</label>
                    <label id="label-juridica" for="razon_social" class="form-label">Nombre de la empresa</label>

                    <input required type="text" name="razon_social" id="razon_social" class="form-control" value="{{old('razon_social')}}">

                    @error('razon_social')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                {{-- Direccion --}}

                <div class="col-md-8 mb-2">
                    <label for="direccion" class="form-label">Direccion:</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" value="{{old('direccion')}}">
                    @error('direccion')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                {{-- Documento --}}

                <div class="col-md-6 mb-2">
                    <label for="documento_id" class="form-label">Tipo documento:</label>
                    <select class="form-select" name="documento_id" id="documento_id">
                        <option value="" selected disabled>Selecciones una opcion</option>  
                        @foreach ($documentos as $item)
                            <option value="{{$item->id}}" {{ old ('documento_id') == $item->id ? 'selected' : '' }}>{{$item->tipo_documento}}></option>
                        @endforeach
                    </select>
                    @error('documento_id')
                    <small class="text-danger">{{'*'.$message}}</small>                        
                    @enderror
                </div>

                <div class="col-md-8 mb-2">
                    <label for="numero_documento" class="form-label">Numero de documento:</label>
                    <input type="text" name="numero_documento" id="numero_documento" class="form-control" value="{{old('numero_documento')}}">
                    @error('numero_documento')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>    
@endsection

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tipoPersona = document.getElementById("tipo_persona");
        const labelNatural = document.getElementById("label-natural");
        const labelJuridica = document.getElementById("label-juridica");
        const boxRazonSocial = document.getElementById("box-razon-social");

        tipoPersona.addEventListener("change", function(){
            let selectvalue = this.value;

            if (selectvalue === "natural") {
                labelJuridica.style.display = "none";
                labelNatural.style.display = "block";
            } else {
                labelNatural.style.display = "none";
                labelJuridica.style.display = "block";
            }

            boxRazonSocial.style.display = "block"
        });
    });
</script>
@endpush