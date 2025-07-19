<table>
    <thead>
    <tr>
        <th>PLACA</th>
        <th>MARCA</th>
        <th>MODELO</th>
        <th>AÑO</th>
        <th>TIPO  DE COMBUSTION</th>
        <th>NUMERO DE MOTOR</th>
        <th>KILOMETRAJE</th>
        <th>PROXIMA VISITA</th>
        <th>NO ATENDER</th>
        <th>CLIENTE</th>
        <th>MOTIVO DE NO ATENCION</th>
    </tr>
    </thead>
    <tbody>
    @foreach($vehiculos as $vehiculo)
        <tbody>
        <tr>
            <td>
                {{ $vehiculo->placa }}
            </td>
            <td>{{ $vehiculo->marca->nombre }}</td>
            <td>{{ $vehiculo->modelo->nombre }}</td>
            <td>{{ $vehiculo->AÑO }}</td>
            <td>
                @foreach($vehiculo->manyCombustions as $combustion)
                    {{ $combustion->nombre }}
                @endforeach
            </td>
            <td>{{ $vehiculo->num_motor }}</td>
            <td>{{ $vehiculo->km }}</td>
            <td>{{ $vehiculo->proxima_visita }}</td>
            <td>
                @if($vehiculo->no_atender != 0)
                    No Atender
                @else
                    Atendido
                @endif
            </td>
            <td>{{ $vehiculo->cliente->full_name }}</td>
            <td>{{ $vehiculo->motivo_no_atencion }}</td>
        </tr>
        </tbody>
        @endforeach
        </tbody>
</table>