<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>imoresin de factura - PDF</title>
    @include('reportes.receivables.invoice.includes.style')
 </head>
<body>


	<header id="header">
		<div  class="row">
			<table WIDTH=100% >
				<tr>
					<td class="tg-yw4l" width="50%" align="center">
						<img src="{{ $d->sucursal->path_image_logo }}"  alt="Logo" class="img-responsive center-block" width="200px">
					</td>

					<td  class="tg-yw4l" width="100%"  align="center" border=0>
						 {{ $d->sucursal->name }}     <br>
						 {{ $d->sucursal->label_num_1099 }}: {{ $d->sucursal->num_1099 }} <br>
						 {{ $d->sucursal->address }} <br>
						 {{ $d->sucursal->telef }}  <br>
						 {{ $d->sucursal->email }}
					</td>

					<td class="tg-yw4l" width="50%" align="center" style="border: 1.2px solid;">
						<h4>FACTURA </h4>
						<h4>{{ $d->trx_serial }}  - {{$d->trx_number }} </h4>
					</td>
				</tr>
			</table>
		</div>
    </header>
    <br>
	<div class="row">
		<table class="full-table" border=0>
			<tbody>
				<tr>
					<td width="20%">FECHA EMISION</td>
					<td>{{ $d->trx_date }}</td>
				</tr>

				<tr>
					<td width="20%">FECHA VENCIMIENTO</td>
					<td>{{ $d->term_due_date }}</td>
				</tr>

				<tr>
					<th width="20%">CLIENTE</th>
					<td>{{ $d->cliente->full_name }}</td>

				</tr>

				<tr>
					<th width="20%">DOCUMENTO</th>
					<td>{{ $d->cliente->tipo_doc->code_value  }}
					{{ $d->cliente->num_documento   }}
					</td>

				</tr>

				<tr>
					<th width="13%">DIRECCION</th>
					<td>{{ $d->cliente->address }}</td>

				</tr>

			</tbody>
		</table>
	</div>



	<div class="row">
		<table WIDTH=100% >
			<tr >
				<th  colspan="5">Detalle de facturacion</th>
			</tr>
			<tr >
				<td width=5%  align="left"  class="bordes">CANT</td>

 				<td width=65% class="bordes">DESCRIPCION</td>

				<td width=5% align="center" class="bordes">UND</td>

				<td width=10%  align="center" class="bordes">P.UNIT</td>
				<td width=10%  align="center" class="bordes">TOTAL</td>
			</tr>

			@foreach($details as $repuesto)
 				<tr class="bordes2px">
					<td align="left" class="bordes2px">{{ $repuesto->quantity_invoiced }}</td>
					<td align="left" class="bordes2px">{{ $repuesto->description }}</td>
					<td align="center" class="bordes2px">{{ $repuesto->uom_code }}</td>
					<td align="right" class="bordes2px">{{ $repuesto->unit_selling_price}}</td>
					<td align="right" class="bordes2px">{{ $repuesto->unit_selling_price * $repuesto->quantity_invoiced   }}</td>
				</tr>

 			@endforeach

		</table>
		<br>
		<table WIDTH=100%>

			<tr>
				<td width=10%  align="left" > </td>

 				<td width=40%> </td>

				<td width=10% align="center"> </td>

				<td width=10%  align="right"> OP. GRAVADAS</td>
				<td width=10%  align="right">{{ $d->opgravadas }}</td>
			</tr>
			<tr class="sinbordes">
				<td width=10%  align="left"> </td>

 				<td width=40%> </td>

				<td width=10% align="center"> </td>

				<td width=10%  align="right"> DESCUENTO</td>
				<td width=10%  align="right"> @if($d->Descuento)
									{{ $d->Descuento }}
									@else 
										0.00
									@endif
								</td>		
 			</tr>
						<tr class="sinbordes">
				<td width=10%  align="left"> </td>

 				<td width=40%> </td>

				<td width=10% align="center"> </td>
				 
				<td width=10%  align="right"> {{ $d->sucursal->label_tax_code }} {{ $d->sucursal->value_tax_percentage }} %</td>
				<td width=10%  align="right"> 
					{{ round( ( $d->opgravadas  - $d->Descuento )  * $d->tax_value ,2) }}
				  </td>
			</tr>
						<tr class="sinbordes">
				<td width=10%  align="left"> </td>

 				<td width=40%> </td>

				<td width=10% align="center"> </td>

				<td width=10%  align="right"> TOTAL</td>
				<td width=10%  align="right"> {{ round( ( $d->opgravadas  - $d->Descuento ) + 
													( ( $d->opgravadas  - $d->Descuento )  * $d->tax_value )
													,2) 
											  }} 
				</td>
			</tr>
	 

			<tr class="sinbordes">
			  <td width=4% > <strong>Son: </strong> </td>

			  <td width=40%> {{ $numlet }}   </td>

			  <td width=10% align="center"> </td>
 
			</tr>
		</table>
 
	</div>

 

<div class="text_footer">
   
</div>
</body>
</html>
