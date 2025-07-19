<option></option>
@if(!empty($modelos))
    @foreach($modelos as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif