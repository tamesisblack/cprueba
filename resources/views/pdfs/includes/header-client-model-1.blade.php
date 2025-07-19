<table style="border: none;font-size:10;" class="" id="boleta" width="100%" cellspacing="0" >
			<tr>
				<td Width=30%> 
					    
					  <img src="{{ $d->sucursal->path_image_logo }}"    width="100px">
				</td>
				<td Width=40%>  
					<div align="center" >
                        <div  >{{$d->sucursal->bill_to_name }}</div>
                        <div  >{{$d->sucursal->label_num_1099 }}  {{$d->sucursal->num_1099 }}</div>
                        <div  > </div>
                        <div  > </div>
                        <div  > </div>
                    </div>
				</td>
				<td Width=30%> 
					<div   >
                        <div  ><h4>COTIZACION - CLIENTE</h4></div>
                        <div  >Fecha  {{ date('d-m-y H:i:s') }} </div>
                        <div  >Nro Cotizacion: <b>{{ $d->nrocotizac }}</b></div>
                         <div  > </div>
                        <div  > </div>
                    </div>	
						
					 
				</td>
			</tr>
		</table>