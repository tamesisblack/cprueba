<?php

namespace sisVentas\Http\Composers;

use sisVentas\Header;
use sisVentas\Proveedor;
use sisVentas\Repositories\Orders;
use Illuminate\View\View;



class OrdersComposer
{
	protected $orders;

	function __construct(Orders $orders)
	{
		$this->orders = $orders;
	}
	
	public function compose(View $view)
	{
		$orders = $this->orders->pendientes();
		$proveedors = Proveedor::all()->pluck('vendor_id', 'vendor_name');
		$view->with('orders', $orders)->with('proveedors', $proveedors);
	}
}