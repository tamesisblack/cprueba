<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<style>
    @page {
        margin: 3px !important;
        /*padding: 0px 0px 0px 0px !important;*/
        font-family: Roboto, 'Segoe UI', Tahoma, sans-serif
    }

    .logo-imagen{
        width: 130px;
        height: 100px;
        float: left;
    }
    .parrafo-no-margen{
        margin-top: 0!important;
        margin-bottom: 0!important;
    }

    .div-derecha-top{
        margin-top: -110px;
        float: right
    }

    .parrafo-documento{
        border-top: 1px solid;
        border-bottom: 1px solid;
        font-size: 18px;
    }
    .div-fecha{
        border: 1px solid;
        border-radius: 10px;
    }

    .div-proveedor{
        float: left;
        margin-top: 40px;
    }

    .div-tabla{
        width: 100%;
        margin-top: 30px;
        display: inline-block;
    }

    .productos-tabla{
        width: 100%!important;
        border-collapse: collapse;
        border-spacing: 0;

    }


    .productos-tabla thead tr th{
        font-size: 13px;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }

    .productos-tabla tbody tr td{
        font-size: 14px;
    }

    .productos-tabla tbody tr:not(:last-child) {
        border-bottom: 1px solid black;
    }


    .div-monto-texto{
        border: 1px solid black;
        padding: 3px;
        border-radius: 10px;
        width: 60%;
        margin-top: 30px;
        float: left;
    }


    .div-totales{
        border-top: 1px solid black;
        text-align: right;
    }





</style>
<body>
<div style="text-align: center">
    {{--<img style="width: 160px;height: 120px;" src="{{asset('storage/imagenes/empresa/'.$empresa->logo)}}">--}}
    <p class="parrafo-no-margen" >DYM SIS CONSULTING E.I.R.L.</p>
    <p class="parrafo-no-margen">RUC: 20550277493</p>
    <p class="parrafo-no-margen">Dirección:  LIMA , LIMA - LIMA</p>
    <p class="parrafo-no-margen">Email:  dym@gmail.com</p>
</div>

<div >
    <p style="text-align: center" class="parrafo-documento">TICKET DE VENTA</p>
</div>


<div>
    <p class="parrafo-no-margen">Fecha Emisión: {{\Carbon\Carbon::now()->parse($venta->created_at)->format('d/m/Y')}}</p>
    <p class="parrafo-no-margen">Hora Emisión: {{\Carbon\Carbon::now()->parse($venta->created_at)->format('h:i A')}}</p>
    @if(!empty($venta->idcliente))
        <p class="parrafo-no-margen">Cliente: {{$venta->razonSocialCliente}}</p>
        @if (!empty($venta->direccionCliente))
            <p class="parrafo-no-margen">Domicilio: {{$venta->direccionCliente}}</p>
        @endif
    @endif
</div>


<div class="div-tabla">
    <table align="center" class="productos-tabla">
        <thead>
        <tr>
            <th>CANT.</th>
            <th>U.M</th>
            <th>DESCRIPCIÓN</th>
            <th>P.UNIT</th>
            <th>TOTAL</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($detalleVenta as $det)
            <tr>
                <td align="center">{{$det->quantity_ordered}}</td>
                <td align="center">NIU</td>
                <td style="font-size: 14px;text-transform: lowercase" width="30%">{{$det->description}}</td>
                <td align="center">{{$det->unit_selling_price}}</td>
                <td align="center">{{$det->quantity_ordered * $det->unit_selling_price}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="div-totales">
    <p style="font-weight: bold;margin-top: 10px">TOTAL: <span >S/ 1000</span></p>
</div>





</body>
</html>
