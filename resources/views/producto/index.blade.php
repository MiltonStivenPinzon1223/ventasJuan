@extends('template')

@section('title','Productos')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: "{{ session('success') }}",
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
    });
</script>
@endif

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Productos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Productos</li>
    </ol>

    <div class="mb-4">
        <a href="{{ route('productos.create') }}" class="btn btn-primary">Añadir nuevo registro</a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Tabla productos
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Marca</th>
                        <th>Categorías</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $item)
                    <tr>
                        <td>{{ $item->codigo }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->marca->caracteristica->nombre }}</td>
                        <td>
                            @foreach ($item->categorias as $category)
                            <span class="badge bg-secondary">{{ $category->caracteristica->nombre }}</span>
                            @endforeach
                        </td>
                        <td>
                            <span class="fw-bold badge {{ $item->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $item->estado == 1 ? 'ACTIVO' : 'ELIMINADO' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('productos.edit', ['producto' => $item]) }}" class="btn btn-primary">Editar</a>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#verModal-{{ $item->id }}">Ver</button>
                                <button type="button" class="btn {{ $item->estado == 1 ? 'btn-danger' : 'btn-primary' }}" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}">
                                    {{ $item->estado == 1 ? 'Eliminar' : 'Restaurar' }}
                                </button>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="verModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detalles del producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Descripción:</strong> {{ $item->descripcion }}</p>
                                    <p><strong>Fecha de vencimiento:</strong> {{ $item->fecha_vencimiento ?? 'No tiene' }}</p>
                                    <p><strong>Stock:</strong> {{ $item->stock }}</p>
                                    <p><strong>Imagen:</strong></p>
                                    @if ($item->img_path)
                                    <img src="{{ Storage::url('public/productos/' . $item->img_path) }}" class="img-fluid img-thumbnail" alt="{{ $item->nombre }}">
                                    @else
                                    <p>No hay imagen disponible</p>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Mensaje de confirmación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $item->estado == 1 ? '¿Seguro que quieres eliminar el producto?' : '¿Seguro que quieres restaurar el producto?' }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('productos.destroy', ['producto' => $item->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn {{ $item->estado == 1 ? 'btn-danger' : 'btn-primary' }}">Confirmar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush