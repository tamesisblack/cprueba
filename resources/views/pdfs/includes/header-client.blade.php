<div class="row">
    <table>
        <tr>
            <td>Cotizacion Num. <b>{{ $d->nrocotizac }}</b></td>
        </tr>
        <tr>
            <td>Fecha: {{ $d->created_at }}</td>
        </tr>
    </table>
</div>
<div class="row">
    <table class="full-table">
        <tbody>
            <tr>
                <th width="13%">DNI / RUC</th>
                <td>{{ $d->cliente->num_documento }}</td>

                <th width="13%">PLACA</th>
                <td>{{ $d->vehiculo->placa }}</td>
            </tr>

            <tr>
                <th width="13%">CLIENTE</th>
                <td>{{ $d->cliente->full_name }}</td>
                
                <th width="13%">MARCA</th>
                <td>{{ $d->vehiculo->marca->nombre }}</td>
            </tr>
            
            <tr>
                <th width="13%">DIRECCION</th>
                <td>{{ $d->cliente->address }}</td>
                
                <th width="13%">MODELO</th>
                <td>{{ $d->vehiculo->modelo->nombre }}</td>
            </tr>
            
            <tr>
                <th width="13%">CORREO</th>
                <td>{{ $d->cliente->email_address }}</td>

                <th width="13%">FABRICACION</th>
                <td>{{ $d->vehiculo->año }}</td>
            </tr>
            
            <tr>
                <th width="13%">TELEFONO</th>
                <td>{{ $d->cliente->telef1 }}</td>

                <th width="13%">COMBUSTION</th>
                <td>DIESEL</td>
            </tr>
        </tbody>
    </table>
</div>