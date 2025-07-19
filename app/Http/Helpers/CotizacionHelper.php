<?php

namespace sisVentas\Http\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use sisVentas\AsCotizacion;
use sisVentas\AsCotizaManMo;
use sisVentas\AsCotizaManRep;
use sisVentas\AsCotizaMo;
use sisVentas\AsCotizaRep;
use sisVentas\Cliente;
use sisVentas\Vehiculo;

class CotizacionHelper
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

        $query = DB::Table('as_cotizacion')
            ->leftJoin('inv_sites', 'as_cotizacion.site_id', '=', 'inv_sites.id')
            ->leftJoin('cliente', 'as_cotizacion.Idcliente', '=', 'cliente.idcliente')
            ->leftJoin('hr_per_people_inf', 'as_cotizacion.idasesor', '=', 'hr_per_people_inf.PERSON_ID')
            ->select(
                'as_cotizacion.Idcotiza as cotizacionId',
                'as_cotizacion.nrocotizac AS nroCotizacion',
                'inv_sites.name AS empresaName',
                'cliente.full_name AS clienteName',
                'as_cotizacion.placa AS placa',
                'hr_per_people_inf.FULL_NAME AS asesorName',
                'as_cotizacion.created_at AS createdAt'
            )
            ->when((isset($clienteId) && $clienteId != ''), function ($query) use ($clienteId) {
                return $query->where('as_cotizacion.Idcliente', $clienteId);
            })
            ->when((isset($vehiculoPlaca) && $vehiculoPlaca != ''), function ($query) use ($vehiculoPlaca) {
                return $query->where('as_cotizacion.placa', $vehiculoPlaca);
            })
            ->when((isset($fechaInicio) && $fechaInicio != '' && isset($fechaFin) && $fechaFin != ''), function ($query) use ($fechaInicio, $fechaFin) {
                return $query->whereBetween('as_cotizacion.created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59']);
            });

        $data = $query->get();

        $result = collect();

        foreach ($data as $cotizacion) {
            $manualRepuestos = AsCotizaManRep::where('idcotiza', $cotizacion->cotizacionId)->get();
            $manualManoObra = AsCotizaManMo::where('idcotiza', $cotizacion->cotizacionId)->get();
            $listaRepuestos = AsCotizaRep::where('idcotiza', $cotizacion->cotizacionId)->with('item')->get();
            $listaManoObra = AsCotizaMo::where('idcotiza', $cotizacion->cotizacionId)->get();

            $manualRepuestos = $manualRepuestos->map(function ($item) use ($cotizacion) {
                $toArray = collect($cotizacion)->toArray();
                return array_merge([
                    'tipo' => 'MANUAL',
                    'nombre' => $item->repuesto,
                    'cantidad' => 1.00,
                    'precio' => $item->costo
                ], $toArray);
            });

            $manualManoObra = $manualManoObra->map(function ($item) use ($cotizacion) {
                $toArray = collect($cotizacion)->toArray();
                return array_merge([
                    'tipo' => 'MANUAL',
                    'nombre' => $item->manoobra,
                    'cantidad' => $item->cantidad,
                    'precio' => $item->costo
                ], $toArray);
            });

            $listaRepuestos = $listaRepuestos->map(function ($item) use ($cotizacion) {
                $toArray = collect($cotizacion)->toArray();
                return array_merge([
                    'tipo' => 'LISTA',
                    'nombre' => $item->item->nombre,
                    'cantidad' => $item->cantidad,
                    'precio' => $item->precio
                ], $toArray);
            });

            $listaManoObra = $listaManoObra->map(function ($item) use ($cotizacion) {
                $toArray = collect($cotizacion)->toArray();
                return array_merge([
                    'tipo' => 'LISTA',
                    'nombre' => $item->labor->nombrelabor,
                    'cantidad' => 1.00,
                    'precio' => $item->costolabor
                ], $toArray);
            });

            $result->push($manualRepuestos);
            $result->push($manualManoObra);
            $result->push($listaRepuestos);
            $result->push($listaManoObra);
        }

        return $result->collapse()->toArray();
    }
}
