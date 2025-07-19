<?php

namespace sisVentas\Http\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use sisVentas\AsCotizacion;
use sisVentas\AsCotizaManMo;
use sisVentas\EamResource;
use sisVentas\AsCotizaMo;
use sisVentas\EamMaterial;
use sisVentas\Cliente;
use sisVentas\Vehiculo;

class WorkOrderReporHelper
{
    public static function getFiltros(): Collection
    {
        $clientes = Cliente::select('full_name', 'idcliente')->orderBy('full_name', 'ASC')->get();

        $vehiculos = Vehiculo::select('placa', 'id')->orderBy('placa', 'ASC')->where('no_atender', 0)->get();

        $collect = collect();

        $collect->put('clientes', $clientes);
        $collect->put('vehiculos', $vehiculos);

        return $collect;
    }

    public static function applyFilters($clienteId, $vehiculoPlaca, $fechaInicio, $fechaFin)
    {

        $query = DB::Table('eam_work_orders')
            ->leftJoin('inv_sites', 'eam_work_orders.site_id', '=', 'inv_sites.id')
			->leftJoin('vehiculo', 'eam_work_orders.object_id', '=', 'vehiculo.id')
			
            ->leftJoin('cliente', 'eam_work_orders.owner_id', '=', 'cliente.idcliente')
            ->leftJoin('hr_per_people_inf', 'eam_work_orders.assignment_id', '=', 'hr_per_people_inf.PERSON_ID')
            ->select(
                'eam_work_orders.wip_entity_id as cotizacionId',
                'eam_work_orders.wip_entity_name AS nroCotizacion',
				 
                'inv_sites.name AS empresaName',
                'cliente.full_name AS clienteName',
                'vehiculo.placa AS placa',
                'hr_per_people_inf.FULL_NAME AS asesorName',
                'eam_work_orders.created_at AS createdAt'
            )
            ->when((isset($clienteId) && $clienteId != ''), function ($query) use ($clienteId) {
                return $query->where('eam_work_orders.owner_id', $clienteId);
            })
            ->when((isset($vehiculoPlaca) && $vehiculoPlaca != ''), function ($query) use ($vehiculoPlaca) {
                return $query->where('vehiculo.placa', $vehiculoPlaca);
            })
            ->when((isset($fechaInicio) && $fechaInicio != '' && isset($fechaFin) && $fechaFin != ''), function ($query) use ($fechaInicio, $fechaFin) {
                return $query->whereBetween('eam_work_orders.created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59']);
            });

        $data = $query->get();

        $result = collect();

        foreach ($data as $cotizacion) {
			//$listaRepuestos = EamMaterial::where('wip_entity_id', $cotizacion->cotizacionId)->with('item')->get();
            //$listaManoObra = EamResource::where('wip_entity_id', $cotizacion->cotizacionId)->get();

			$listaRepuestos = EamMaterial::where('wip_entity_id', $cotizacion->cotizacionId)->where('enabled','=',1)->with('item')->get();
            $listaManoObra = EamResource::where('wip_entity_id', $cotizacion->cotizacionId)->where('enabled','=',1)->get();
			
            $listaRepuestos = $listaRepuestos->map(function ($item) use ($cotizacion) {
                $toArray = collect($cotizacion)->toArray();
                return array_merge([
                    'tipo' => 'Repuesto',
					'manual' => $item->is_manual == 0 ? 'No' : 'Si',
                    'nombre' => $item->is_manual == 0 ? $item->item->nombre : $item->item_descripcion,
                    'cantidad' => $item->quantity,
                    'precio' => $item->unit_price
                ], $toArray);
            });

            $listaManoObra = $listaManoObra->map(function ($item) use ($cotizacion) {
                $toArray = collect($cotizacion)->toArray();
                return array_merge([
                    'tipo' => 'Servicio',
                    'manual' => $item->is_manual == 0 ? 'No' : 'Si',
					'nombre' => $item->is_manual == 0 ? $item->laborResource->nombrelabor : $item->resource_name,
                    'cantidad' => 1.00,
                    'precio' => $item->price
                ], $toArray);
            });

            $result->push($listaRepuestos);
            $result->push($listaManoObra);
        }

        return $result->collapse()->toArray();
    }
}
