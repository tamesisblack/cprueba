<?php 

namespace sisVentas\Repositories;

use sisVentas\Header;


class Orders
{
	
	public function pendientes()
	{

		return Header::with('distributions')->whereHas('distributions', function ($query){
    					$query->whereColumn('quantity_ordered', '>', 'quantity_delivered');
					})->get()->pluck('po_header_id', 'po_header_id');
	}
}