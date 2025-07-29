<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COMPROBANTE DE VENTA</title>
</head>
<body>
    <div><strong>{{strtoupper($venta->comprobante->nombre)}} DE VENTA ELECTRONICA</strong></div>
    <div><strong>{{$venta->numero_comprobante}}</div>

    {{-- <h1>{{$empresa->nombre}}</h1>
    <div>RUC N°: {{$empresa->ruc}}</div>
    <div>{{strtoupper($empresa->direccion)}} - {{strtoupper($empresa->ubicacion)}}</div>
    <div>CEL : {{$empresa->telefono ?? ''}}</div>
    <div>Correo : {{$empresa->correo ?? ''}}</div> --}}

    <h1>AMEGLO</h1>
    <div>RUC N°: </div>
    <div></div>
    <div>CEL : </div>
    <div>Correo : </div>

    <div><strong>Nombre/Razón Social:</strong> 
        {{strtoupper($venta->cliente->persona->razon_social)}}
    </div>
    <div><strong>Dirección:</strong> 
        {{strtoupper($venta->cliente->persona->direccion)}}
    </div>

    <div><strong>{{strtoupper($venta->cliente->persona->documento->nombre)}}:</strong>
        {{$venta->cliente->persona->numero_documento}}
    </div>
    
    <div><strong>Fecha:<strong>
        {{date("d/m/Y", strtotime($venta->fecha_hora))}}
    </div>
    <div><strong>Hora:<strong>
        {{date("H:i", strtotime($venta->fecha_hora))}}
    </div>


    <table class="tabla">
        <thead>
            <tr>
                <th>Cant.</th>
                <th>Unidad</th>
                <th>Descripcion</th>
                <th>Neto</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venta->productos as $detalle)
            <tr>
                <td>{{$detalle->pivot->cantidad}}</td>
                {{-- <td>{{$detalle->presentacione->sigla}}</td> --}}
                <td>{{$detalle->nombre}}</td>
                <td>{{$detalle->pivot->precio_venta}}</td>
                <td>{{$detalle->pivot->cantidad * $detalle->pivot->precio_venta }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div><strong>Subtotal:</strong>
        {{$venta->subtotal}} {{$empresa->moneda->simbolo}}
    </div> --}}

    {{-- <div><strong>{{$empresa->abreviatura_impuesto}}</strong>
        {{$venta->impuesto}} {{$empresa->moneda->simbolo}}
    </div> --}}

    {{-- <div><strong>Total:</strong>
        {{$venta->total}} {{$empresa->moneda->simbolo}}
    </div> --}}  

    <div><strong>Modalidad de pago:</strong>
        {{$venta->metodo_pago}}
    </div>

    <div><strong>Cajero:</strong>
        {{$venta->user->empleado->razon_social ?? $venta->user->name}}
    </div>

</body>

</html>


