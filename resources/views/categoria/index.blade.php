@extends('template')

@section('title','categorias')


@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')

@if (session('success'))
<script>

    let message = "{{ session('success') }}";
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })  

    Toast.fire({
        icon: 'success',
        title: message
    })
</script>
@endif

    <div class="container-fluid">
        <h1 class="mt-4"><i class="fa-solid fa-folder-open"></i>Categorias</h1>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 rounded">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}"><i class="fas fa-home"></i> Inicio</a></li>
            <li class="breadcrumb-item active"><i class="fa-solid fa-folder-open"></i> Categorias</li>
        </ol>
    </nav>

    <div class="mb-4">
        <a href="{{route('categorias.create')}}">
            <button type="button" class="btn btn-primary shadow rounded-pill px-2">Añadir nuevo registro</button>
        </a>
    </div>


    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-clipboard-list"></i>
            Lista de Categorias    
        </div>

        <div class="card-body">
                <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre categoria</th>
                        <th>Descripcion</th>
                        <th>Estado</th>               
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{$categoria->caracteristica->nombre}}</td>
                            <td> {{$categoria->caracteristica->descripcion}}</td>
                        
                            <td>
                                <span class="fw-bolder p-1 rounded text-white
                                {{ $categoria->caracteristica->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $categoria->caracteristica->estado == 1 ? 'Activo' : 'Eliminado' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('categorias.edit', ['categoria' => $categoria]) }}"
                                        class="btn btn-primary">
                                        Editar
                                        </a>

                                    <button type="button" class="btn
                                    {{ $categoria->caracteristica->estado == 1 ? 'btn-danger':'btn-success' }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#confirmModal-{{ $categoria->id }}">
                                    {{ $categoria->caracteristica->estado == 1 ? 'Eliminar' : 'Restaurar' }}
                                    </button> 
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="confirmModal-{{$categoria->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmacion</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <i class="fas {{ $categoria->caracteristica->estado == 1 ? 'fa-trash-alt' : 'fa-undo' }} me-2"></i>
                                {{ $categoria->caracteristica->estado == 1
                                    ? '¿Seguro que quieres eliminar la categoría?'
                                    : '¿Quieres restaurar la categoria?'}}
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <form action="{{ route('categorias.destroy',['categoria'=>$categoria->id])}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Confirmar</button>
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


