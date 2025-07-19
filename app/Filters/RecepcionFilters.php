<?php 

namespace sisVentas\Filters;

/**
* Filters Receptions
*/
class RecepcionFilters extends Filters
{
	/**
	 * @var array Registrar name of filters
	 */
	protected $filters = ['header','proveedor', 'line'];

	public function header($header)
	{

		return $this->builder->where('po_header_id',$header);
	}

	public function line($line)
	{
		return $this->builder->with(['lines' => function ($query) use ($line) {
					$query->whereIn('line_num', $line);
				}]);
	}
	/**
	 * Ejemplo de metodos para fol filters
	 * @param  $proveedor
	 * @return Illumimate\Database\Eloquent\Builder
	 */
	public function proveedor($proveedor)
	{
		return $this->builder->where('vendor_id', $proveedor);
	}
}
