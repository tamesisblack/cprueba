<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Constancia de pago N° {{ $d->nrocotizac }} - PDF</title>
   
	<style>
		td {
			padding: 5px;
			border-top: 0px;
			border-right: 0px;
			border-bottom: 1px solid black;
			border-left: 0px;
		}
	
		#watermark {
			position: fixed;
 
			bottom:   7cm;
			left:     2cm;

			/** Change image dimensions**/
			width:    15cm;
			height:   15cm;

			/** Your watermark should be behind every content**/
			z-index:  -1000;
		}
		
		
		@page { margin: 140px 50px; }        
        #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height:120px; }
         
		 body{
        font-family: Arial, Helvetica;
        font-size: 12px;
    }

     @page { margin: 140px 50px; }
        #header { position: fixed; left: 0px; top: -110px; right: 0px; height: 1300px;  text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 120px; }
        #footer .page:after { }
    
    .container{
        margin: 0 auto;
        position: relative;
        margin-bottom: 15px;
    }

    table{
        border-collapse: collapse;
    }



    table, td, th, tr {
        border: 1px solid black;
    }
    th{
        text-align: left;
    }
    .full-table{
        width: 100%;
    }
 
	.full-table-total{
        width: 100%;
		 border:none;
    }
	
    .left, .right{
            width: 48%;
     }
     .left{
        float: left;
     }

     .right{
        float: right;
     }
     .t-float{
        height: 90px;
     }
     .left>table, .right>table{
        width: 100%;
     }
     .row{
        margin-bottom: 15px;
     }
    tbody:before, tbody:after{ 
        display: none; 
    }
    .total{
        text-align: right;
        margin-right: 4px;
    }
    .border-none{
        border: none;
    } 
    .border-left{
        width: 50%;
        text-align: center;
        border-left: solid 8px red; 
    }
	</style>
	
</head>
<body>
         
    <div id="watermark">
		 
	</div>
	<header id="header">
		 
    </header>
    
	<br>
	<div class="row">
		<table class="full-table" border="0">
			<tbody>
				<tr>
					<th width="13%" style="font-size:10px;">DNI </th>
					<td style="font-size:10px;">222</td>

					<th width="13%" style="font-size:10px;">NRO DE RECIBO</th>
					<td style="font-size:10px;"> {{ $d->receipt_num }} </td>
				</tr>

				<tr>
					<th width="13%" style="font-size:10px;">DE CLIENTE</th>
					<td style="font-size:10px;">@if ($d->cliente) {{ $d->cliente->full_name }} @else N/D @endif </td>
					
					<th style="font-size:10px;" width="13%">FECHA PAGO</th>
					<td style="font-size:10px;" > {{ $d->receipt_date }}</td>
				</tr>
				
				<tr>
					<th style="font-size:10px;" width="13%">DIRECCION</th>
					<td style="font-size:10px;" >dddf</td>
					
					<th style="font-size:10px;" width="13%"> </th>
					<td style="font-size:10px;">  </td>
				</tr>
				
				<tr>
					<th style="font-size:10px;" width="13%">CORREO</th>
					<td style="font-size:10px;" >dddd@gmail.com</td>

					<th style="font-size:10px;" width="13%"> </th>
					<td style="font-size:10px;" >   </td>
				</tr>
				
				<tr>
					<th style="font-size:10px;" width="13%">TELEFONO</th>
					<td style="font-size:10px;" >222222</td>

					<th style="font-size:10px;" width="13%">   </th>
					<td style="font-size:10px;">    </td>
				</tr>
			</tbody>
		</table>
	</div>


        <div class="row">
            <table WIDTH=100% >
                <tr>
					<?php $row = 0  ; $sumatot = 0 ?>
                    <th  colspan="3">Detalle Pago </th>
                </tr>
                <tr>
					<td width=10%>Cantidad</td>   
					<td width=80%>Descripcion</td>
                    <td width=10%>Importe Pagado</td>
                    
                </tr>
           
                <tr>
					<td align="left">1</td>
                    
                    <td align="left">Pago por credito de venta</td>
                    <td align="right">{{ $d->amount }}</td>
                    
                </tr>
                
            </table>
        </div>
		
		  
	  
	<br>
	  
	
    <br>
	<div class="row">
		<table>
			
		</table>
	</div>

 


<footer id="footer">
    <table class="border-none" width="100%">
        <tr class="border-none">
            <td class="border-none border-left" width="100%">
                RUC : 345678990785 <br>
              
                     
            </td>
            <td class="border-none">
                Visto Bueno _______________________
				<br>
				
				 
            </td>
        </tr>
    </table>
</footer>

</body>
</html>