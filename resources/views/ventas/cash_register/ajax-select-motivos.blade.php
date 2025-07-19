<option></option>
@if(!empty($motivos))
    @foreach($motivos as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif