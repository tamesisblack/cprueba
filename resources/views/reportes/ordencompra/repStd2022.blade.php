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
	.header__enterprise {
                display: flex;
            }
            .header__enterprise img {
                max-width: 100%;
                min-width: 120px;
                margin-right: 20px;
                object-fit: contain;
                max-height: 120px;
            }
     
	 .header__invoice_number {
                font-size: 1.2rem;
            }
	.header__invoice {
                
                align-self: center;
					
                border: 1px solid black;
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
	.invoice {
                width: 100%;
                border-collapse: collapse;
            }
            .invoice__descripcion--title {
                text-align: left;
            }
            .invoice__cant, .invoice__unid, .invoice__punit, .invoice__descuento {
                text-align: center;
            }
            .invoice__cant, .invoice__modelo, .invoice__descripcion, .invoice__lote, .invoice__serie, .invoice__total, .invoice__unid, .invoice__punit, .invoice__descuento {
                border-bottom: 1px solid black;
            }
            .invoice__total {
                text-align: right;
            }
            .invoice__header {
                background: rgb(236, 236, 236);
                text-transform: uppercase;
                border-top: 2px solid black;
                border-bottom: 2px solid black;
            }
			.total {
                margin-top: 20px;
                margin-left: auto;
                width: max-content;
            }
            .total__item {
                text-transform: uppercase;
                font-weight: bold;               
                margin-top: 8px;
            }
            .total__title {
                width: 200px;
                text-align: right;
                margin-right: 10px;
                display: inline-block;
            }
            .total__parsed_amount {
                text-transform: uppercase;
                margin-bottom: 50px;
            }
			
			 .payment_method {
                font-weight: bold;
            }
			
			/** Definir las reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: -1cm; 
                left: 0cm; 
                right: 0cm;
                height: 3.5cm;
            }
   
</style>
<body>

	 <div class="header">
		<table style="width:100%">
			<tr>
				<td Width=30%> 
					   
								 
					  <img src="{{ $d->sucursal->path_image_logo }}"    width="140px">
				</td>
				<td Width=40%>  
					<div  >
                        <div  >544rtrtrttrt</div>
                        <div  >43434343</div>
                        <div  > </div>
                        <div  > </div>
                        <div  > </div>
                    </div>
				</td>
				<td Width=30%> 
					<div   >
                        <div  ><h4>ORDEN DE COMPRA</h4></div>
                        <div  >Fecha  {{ date('d-m-y H:i:s') }} </div>
                        <div  >Nro OC {{$d->segment1}} </div>
                         <div  > </div>
                        <div  > </div>
                    </div>	
						
					 
				</td>
			</tr>
		</table>
	
	</div>
     
	 
				 
						<table>
							<tr>
								<td colspan="2"  ><strong>  DATOS DE PROVEEDOR</strong></td>
								<td colspan="4" >   </td>
								<td>   </td>
								<td  ><strong>Vehiculo </strong></td>
								<td>  f34</td>
							</tr>
							<tr>	
							
								<td   > Proveedor </td>
								<td>{{ $d->proveedor[0]->vendor_name  }}</td>
								<td colspan="5" >   </td>
								<td  >Marca</td>
                    <td  >
					@if( $d->vehiculo)
						
						@if( $d->vehicule_id > 0)
							{{ $d->vehiculo->marca->nombre }}
						@else
							-
						@endif 
					 
					@endif
							</tr>
							<tr>
								<td>RUC </td>
								<td>{{$d->proveedor[0]->segment1 }}</td>
								<td   colspan="5" >   </td>
								<td  >Modelo</td>
                    <td  >
					@if( $d->vehiculo)
						
						@if( $d->vehicule_id > 0)
							{{ $d->vehiculo->modelo->nombre }}
						@else
							-
						@endif 
					 
					@endif
							</tr>
							<tr>
								<td>Telefono</td>
								<td>ff3ff </td>
								<td colspan="5" >   </td>
								<td >Año</td>
                    <td  >
					@if( $d->vehiculo)
						
						@if( $d->vehicule_id > 0)
							{{ $d->vehiculo->año }}
						@else
							-
						@endif 
					 
					@endif
					</td>
							</tr>
							
						</table>
					 
	
		 
    
	<br>
	<main>
                <table class="invoice">
                    <thead class="invoice__header">
                        <tr class="invoice__row invoice_row--header">
                             
                            <th class="invoice__descripcion--title">
                                Descripción
                            </th>
                            <th>
                                Cant.
                            </th> 
                            <th>
                                P. Unit
                            </th>
                             
                            <th class="invoice__total">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody class="invoice_body">
					<?php $subtotal=0; $igv=0; $total=0; ?>
					<?php { foreach($details as $detail){ ?>
                        <tr class="invoice__row">
							  
                            <td class="invoice__descripcion">
                                {{$detail->item_description}}
                            </td>
							<td class="invoice__cant">
                                {{$detail->quantity}}
                            </td>
                             
                            <td class="invoice__punit">
                                {{$detail->unit_price}}
                            </td>
                             
                            <td class="invoice__total">
                                {{number_format($detail->quantity*$detail->unit_price,2)}}
                            </td>
                        <?php $subtotal  = $subtotal  + $detail->quantity*$detail->unit_price; ?>
						</tr>
						<?php }} ?>
                    </tbody>
                </table>
                 <div align="right" style="float:left;">
            <table align="right">
                <tr>
                    <td class="noborder">SUB TOTAL</td>
                    <td class="border" align="right">{{number_format($subtotal,2)}}</td>
                </tr>
                <tr>
                    <td class="noborder">IGV {{ $codetax }} %</td>
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
                
            </main>
	<br>		
	 
			<p>	
     <br>
	<br>
	<div>
	<table class="invoice">
                    <thead class="invoice__header">
                        <tr class="invoice__row invoice_row--header">
                             
                            <th class="invoice__descripcion--title">
                                Observaciones
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody class="invoice_body">
					 
                        <tr class="invoice__row">
							  
                            <td class="invoice__descripcion">
                               {{$d->comments}}
                            </td>
						</tr>	 
                    </tbody>
                </table>
	</div>		
	<br>
	
	<br>
	 
                 
                <div > 
                    <div class="seller__title">
                        Comprador: Miguel
						<br>
                    </div>
					<br>
                    <img src="{{ $d->comprador->path_image_firm }}"   width="100px"  > 
                </div>
			<br>
			
	<br>
  
<footer id="footer">

	 
</footer>
 
</body>

</html>
