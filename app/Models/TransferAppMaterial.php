<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferAppMaterial extends Model
{
    use HasFactory;
    protected $table = 'transfer_app_material';

    protected $fillable = ['supervisor_id', 'source_site_id', 'dest_site_id', 'dest_warehouse_id'];

}
