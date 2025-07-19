<div class="col-md-6">
    <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" name="name" value="{{ $reason ? $reason->name : old('name') }}">
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="col-md-12">
    <div class="checkbox">
        <label>
            <input type="checkbox" name="status" {{ $reason->status == 1 ? 'checked' : '' }}>Activo
        </label>
    </div>
</div>

<div class="col-md-12">
<div class="radio">
    <label>
      <input type="radio" name="reason_selected" value="ingresos" {{ $reason->tipo_movimiento == 'ingresos' ? 'checked' : '' }}>
      INGRESOS
    </label>
  </div>
  <div class="radio">
    <label>
      <input type="radio" name="reason_selected" value="egresos" {{ $reason->tipo_movimiento == 'egresos' ? 'checked' : '' }}>
      EGRESOS
    </label>
  </div>
</div>
