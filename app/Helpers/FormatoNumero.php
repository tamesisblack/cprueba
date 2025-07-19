<?php

    namespace sisVentas;

/*
            es-AR
            es-BO
            es-CL
            es-CO
            es-CR
            es-DO
            es-EC
            es-ES
            es-GT
            es-HN
            es-MX
            es-NI
            es-PA
            es-PE
            es-PR
            es-PY
            es-SV
            es-US
            es-UY
            es-VE
            */

    class FormatoNumero 
	{
		
		public static function formatoPais ($locale, $currencycode, $value)
		{ 
			$fnt = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
			$fnt->setTextAttribute($fnt::CURRENCY_CODE, $currencycode);
			$fnt->setAttribute($fnt::FRACTION_DIGITS,2);
			return $fnt->format($value);

		}
    }


