<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferWorkPlaceMaterial extends Model
{
    use HasFactory;
    protected $table = 'transfer_workplace_material';

    protected $fillable = ['site_id', 'source_workplace_id', 'target_workplace_id', 'material_id', 'quantity'];

}
