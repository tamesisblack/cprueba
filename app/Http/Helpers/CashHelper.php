<?php

namespace sisVentas\Http\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use sisVentas\CashRgisterTrx;

class CashHelper
{
    public static function getFiltros($site_id): Collection
    {
        $listSucursal = DB::table('inv_sites')
            ->select('name', 'id')
            ->get();

        $listNumCaja  = DB::table('cash_register')
            ->select('name', 'id')
            ->where('site_id', $site_id)
            ->get();

        $listPersonal = DB::table('hr_per_people_inf')
            ->select('FULL_NAME', 'PERSON_ID')
            ->get();

        $listTipoOperacion = [
            (object)[
                'id' => 1,
                'name' => 'Apertura'
            ],
            (object)[
                'id' => 2,
                'name' => 'ingreso'
            ],
            (object)[
                'id' => 3,
                'name' => 'retiro'
            ]
        ];

        $collect = collect();

        $collect->put('listSucursal', $listSucursal);
        $collect->put('listNumCaja', $listNumCaja);
        $collect->put('listPersonal', $listPersonal);
        $collect->put('listTipoOperacion', $listTipoOperacion);

        return $collect;
    }

    public static function historyWithFilter($sucursalId, $numeroCajaId, $personalId, $tipoOperacionId, $fechaInicio, $fechaFin): Collection
    {

        $query = CashRgisterTrx::query();

        if (isset($sucursalId) && $sucursalId != '')
            $query->where('site_id', $sucursalId);

        if (isset($numeroCajaId) && $numeroCajaId != '')
            $query->where('cash_reg_id', $numeroCajaId);

        if (isset($personalId) && $personalId != '')
            $query->where('personal_id', $personalId);

        if (isset($tipoOperacionId) && $tipoOperacionId != '')
            $query->where('type_operation', $tipoOperacionId);

        if (isset($fechaInicio) && isset($fechaFin))
            $query->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59']);

        $query->with('sucursal', 'caja', 'personal');

        $data = $query->get();

        return $data;
    }
}
