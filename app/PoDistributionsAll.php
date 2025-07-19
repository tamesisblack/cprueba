<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;
use sisVentas\PoLinesAll;

class PoDistributionsAll extends Model
{
    //
    protected $table = 'po_distributions_all';

    protected $primaryKey = 'po_distribution_id';

    protected $fillable = [
        'distribution_num',
        'po_header_id',
        'po_line_id',
        'quantity_ordered',
        'po_release_id',
        'quantity_delivered',
        'quantity_billed',
        'quantity_cancelled',
        'req_header_reference_num',
        'req_line_reference_num',
        'req_distribution_id',
        'deliver_to_location_id',
        'deliver_to_person_id',
        'rate_date',
        'rate',
        'amount_billedd',
        'destination_type_code',
        'destination_organization_id',
        'destination_subinventory',
        'source_distribution_id',
        'gl_closed_date',
        'org_id',
        'amount_ordered',
        'amount_delivered',
        'amount_cancelled',
        'last_updated_by'
    ];

    public function linesall()
    {
        return $this->hasOne(PoLinesAll::class, 'po_line_id', 'po_line_id');
    }
}
