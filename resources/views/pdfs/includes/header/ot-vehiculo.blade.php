<table style="border: none;font-size:10;" class="" id="boleta" width="100%" cellspacing="0" >
			<tr>
				<td Width=30%> 
					    
					  <img src="{{ $rSite->path_image_logo }}"     >
				</td>
				<td Width=40%>  
					<div align="center" >
                        <div  >{{$rSite->bill_to_name }}</div>
                        <div  >RUC {{$rSite->num_1099 }}</div>
                        <div  > </div>
                        <div  > </div>
                        <div  > </div>
                    </div>
				</td>
				<td Width=30%> 
					<div   >
                        <div  ><h4>RELACION DE ORDENES DE TRABAJO REALIZADOS</h4></div>
                        <div  >Fecha  {{ date('d-m-y H:i:s') }} </div>
                        <div  >Placa Vehiculo: <b>{{ $d->placa }}</b></div>
                         <div  > </div>
                        <div  > </div>
                    </div>	
						
					 
				</td>
			</tr>
		</table>