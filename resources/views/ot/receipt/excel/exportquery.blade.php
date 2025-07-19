<table>
    <thead>
    <tr>
        <th>LABOR</th>
		<th>DURACION</th>
		<th>MARCA</th>
		<th>MODELO</th>
		 
         
    </tr>
    </thead>
    <tbody>
    @foreach($labores as $labor)
                                
		<tr>
			<td>{{ $labor->nombrelabor }}</td>
			<td> {{ $labor->duration }} </td>
			<td> {{ $labor->marca }}</td>
			<td>{{ $labor->modelo }}</td>
			 
		</tr>
		
	@endforeach
            </tbody>
</table>
 