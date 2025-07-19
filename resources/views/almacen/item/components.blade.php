@extends('layouts.admin')

@section('title', 'Listado de Componentes')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('contenido')
    <div class="box">
        @include('util.success')

        <div class="box-header with-border">
            <h3 class="box-title">
                Detalle del Producto
            </h3>
        </div>

        <div class="box-body">

            <div class="row">
                <div class="col-xs-12">
                    <form action="{{ route('items.components.store') }}" class="form-horizontal" method="POST">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="header_id" value="{{ $item->inv_item_id }}">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre Producto</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $item->nombre }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Compuesto</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="item_id">
                                    <option value="0">-- Seleccione --</option>
                                    @foreach ($components as $component)
                                        <option value="{{$component->inv_item_id}}">{{ $component->codigo }} - {{ $component->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cantidad Producto</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" step="1" name="quantity">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary pull-right mt-1">Guardar</button>
						<a class="btn btn-danger" href="{{ route('almacen.item.index')}}">Cancelar</a>
                    </form>

                </div>                
            </div>

            <hr>

            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive mt-xs-4">
                        <table class="table table-hover display table-condensed">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
									<th>Unidad Medida</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $item->components as $component )
                                    <tr>
                                        <td>{{ $component->item->nombre }}</td>
                                        <td>{{ $component->quantity }}</td>
										<td>{{ $component->item->primary_uom_code }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-xs" onclick="deleteConfirm({{ $component->id }})">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<h6 style="font-size:0.15cm; ">ARITCM1</h6>
@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    'use strict';

    @if ( session('success') )
        toastr.success( "{{ session('success') }}" );
    @endif

    @if ( session('info') )
        toastr.info( "{{ session('info') }}" );
    @endif

    @if ( session('error') )
        toastr.error( "{{ session('error') }}" );
    @endif

    const deleteConfirm = (id) => {

        console.log(id);

        Swal.fire({
            title: "¿Desea eliminar el registro?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Si, eliminar!"
        }).then((result) => {
            if (result.isConfirmed) {
                
                window.location.href = `/items/${id}/destroy`;
            }
        });
    }
</script>

@endsection