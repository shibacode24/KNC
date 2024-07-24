<?php

namespace App\Models\PO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectPOList extends Model
{
    use HasFactory;

    protected $table = 'direct_po_list';

    protected $fillable = ['date', 'time', 'material_id', 'quantity', 'unit_type_id', 'brand_id', 'vendor_id',];

}
