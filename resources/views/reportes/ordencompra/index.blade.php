<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Compra</title>
</head>
 
<style>
    .header{
        width: 100%;
        display:inline;
        position: fixed;
        top: 0px;

    }
    .header .logo {
        width:300px;
        outline:1px solid red;
    }
    .resumen{
        outline:1px solid magenta;
        width: 100%;
        display:inline;
        padding-top:100px;
    }
    .number{
        align:left;
    }
    div div table tr td.border{
        width:100px;
        border:1px solid black;
    }
    table{
        border-collapse:collapse;
    }

    .details table{
        width: 100%;
        border-collapse:collapse;
    }
    .details table tr th{
        border: 1px solid black;
        align:left;
        font-size:12px;
    }
    .details table tr td{
        border: 1px solid black;
        font-size:10px;
    }
	
	.vendor table tr td{
        border: 1px solid black;
        font-size:10px;
    }

    .description{
        padding-left:8px;
    }
	.espacioTD{
        padding-left:4px;
    }
    body {
        margin-top: 4.5cm;
        margin-left: 0cm;
        margin-right: 0cm;
        margin-bottom: 1cm;
    }
</style>
<body>
    <div class="header">
        <div style="float:left;">
            <h2>{{  $d->sucursal->name  }}</h2>
			<img src="{{ $d->sucursal->path_image_logo }}"  alt="Logo" class="img-responsive center-block" width="100px">

        </div>
        <div align="right">
            <h2>ORDEN DE COMPRA</h2>
            <table align="right">
                <tr>
                    <td class="noborder">Fecha</td>
                    <td class="border" align="right"> {{ date('d-m-y H:i:s') }}
                    </td>
                </tr>
                <tr>
                    <td class="noborder">Nro OC</td>
                    <td class="border" align="right">{{$d->segment1}}</td>
                </tr>
                <tr>
                    <td class="noborder">Vehiculo</td>
                    <td class="border" align="right">
					@if( $d->vehiculo)
						{{ $d->vehiculo->placa }}
					 
					@endif
					</td>
                </tr>
				<tr>
                    <td class="noborder">Marca</td>
                    <td class="border" align="right">
					@if( $d->vehiculo)
						{{ $d->vehiculo->marca->nombre }}
					 
					@endif
					</td>
                </tr>
				<tr>
                    <td class="noborder">Modelo</td>
                    <td class="border" align="right">
					@if( $d->vehiculo)
						{{ $d->vehiculo->modelo->nombre }}
					 
					@endif
					</td>
                </tr>
				<tr>
                    <td class="noborder">Año</td>
                    <td class="border" align="right">
					@if( $d->vehiculo)
						{{ $d->vehiculo->año }}
					 
					@endif
					</td>
                </tr>
            </table>
        </div>
    </div>
	<br><br>
	<table style="width:100%" border=0  >
		<tr>
			<td Width=70%>
				<div class="client" >
					<div class="seller" style="font-size:12px;">
						<table>
							<tr>
								<td colspan="2" style="background:#E74827; height:30px; width:100%; padding:5px; border-radius:5px;">DATOS DE PROVEEDOR</td>
							</tr>
							<tr>	
							
								<td> Proveedor </td>
								<td>{{ $d->proveedor[0]->vendor_name  }}</td>
							</tr>
							<tr>
								<td>RUC </td>
								<td>{{$d->proveedor[0]->segment1 }}</td>
							</tr>
							<tr>
								<td>Telefono</td>
								 <td>{{$d->proveedor[0]->telef1 ? $d->proveedor[0]->telef1.'-':'' }}{{$d->proveedor[0]->telef2 ? $d->proveedor[0]->telef2:''}} </td>

							</tr>
							
						</table>
					</div>
				</div>
	
			</td>
			 
			  
			<td   Width=40%>
				<div class="client">
					<div class="seller"  style="font-size:12px;">
						<table>
							<tr>
								<td style="background:#E74827; height:30px; width:100%; padding:5px; border-radius:5px;">DATOS DE FACTURACION</td>
							</tr>
							<tr>	
							
								<td>Facturar A: {{$d->sucursal->bill_to_name }} </td>
								 
							 
							</tr>
							<tr>
								<td>RUC: {{$d->sucursal->num_1099 }}</td>
								 <td></td>
							</tr>
						 
							<tr>
								<td> </td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
	
			</td>
		</tr>
	</table>
	
		
		
	<br>
    <div class="details">
        <table>
            <tr style="background:#E74827;">
                <th style="border-top-right-radius:5px; height:30px;">COD</th>
                <th align="left" class="description">Descripcion</th>
                <th align="right">Cantidad</th>
                <th align="right">Precio Unit.</th>
                <th align="right">Total</th>
            </tr>
            <?php $subtotal=0; $igv=0; $total=0; ?>
            <?php { foreach($details as $detail){ ?>
			
            <tr>
                <td align="left" Width=10%>{{$detail->item_id}}</td>
                <td class="description" >{{$detail->item_description}}</td>
                <td align="right" Width=10%>{{$detail->quantity}}</td>
                <td align="right" Width=10%>{{$detail->unit_price}}</td>
                <td align="right" Width=10%>{{number_format($detail->quantity*$detail->unit_price,2)}}</td>
                <?php $subtotal  = $subtotal  + $detail->quantity*$detail->unit_price; ?>
            </tr>
            <?php }} ?>
        </table>
    </div>
	<br>
	
    <div class="resumen">
        <div >
            <div style="background:#E74827; border-top-left-radius:5px; border-top-right-radius:5px; padding-left:15px;">OBSERVACIONES</div>
            <p>{{$d->comments}}</p>
        </div>
        <div align="right" style="float:left;">
            <table align="right">
                <tr>
                    <td class="noborder">SUB TOTAL</td>
                    <td class="border" align="right">{{number_format($subtotal,2)}}</td>
                </tr>
                <tr>
                    <td class="noborder">{{ $label_tax_code }} {{ $codetax }} %</td>
                    <td class="border" align="right"> 
					  {{ number_format( $porctax * $subtotal ,2) }} 
					</td>
                </tr>
                <tr>
                    <td class="noborder">TOTAL  {{$d->currency_code}} </td>
                    <td class="border" align="right">  {{ number_format( $valtax * $subtotal ,2) }} </td>
                </tr>
            </table>
        </div>
    </div>
	<br>
	<br><br><br>
	<div style="float:left;">
		<img src="{{ $d->sucursal->path_image_footer }}"  alt="Logo" class="img-responsive center-block" width="150px">

	</div>
    <script type="text/php">
        if (isset($pdf)) {
            $x = 250;
            $y = $pdf->get_height()-35;
            $text = "Página {PAGE_NUM} de {PAGE_COUNT}";
            $font = null;
            $size = 10;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>

</html>
