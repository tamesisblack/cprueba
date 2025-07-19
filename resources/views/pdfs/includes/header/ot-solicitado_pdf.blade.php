<table style="border: none;font-size:10;" class="" id="boleta" width="100%" cellspacing="0" >
			<tr>
				<td Width=30%> 
					    
					  <img src="{{ $d->sucursal->path_image_logo }}"    width="100px">
				</td>
				<td Width=40%>  
					<div align="center" >
                        <div  >{{$d->sucursal->bill_to_name }}</div>
                        <div  >RUC {{$d->sucursal->num_1099 }}</div>
                        <div  > </div>
                        <div  > </div>
                        <div  > </div>
                    </div>
				</td>
				<td Width=30%> 
					<div   >
                        <div  ><h4>ORDEN DE TRABAJO: {{ $d->wip_entity_name }}</h4></div>
                        <div  >Fecha  {{ date('d-m-y H:i:s') }} </div>
                        <div  >Nro Cotizacion: <b> @if ($d->cotizacion) 
													 {{ $d->cotizacion->nrocotizac  }} 
												   @else
												     -
												   @endif	
												</b></div>
												
						<div  >Orden Recepcion: <b>@if ($d->ordenrecepcion) 
													 {{ $d->ordenrecepcion->numrec   }} 
												   @else
												     -
												   @endif	
												</b></div>
                        <div  > </div>
                    </div>	
						
					 
				</td>
			</tr>
		</table>