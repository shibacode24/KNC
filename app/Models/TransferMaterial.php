<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferMaterial extends Model
{
    use HasFactory;
    protected $table = 'transfer_material';

    protected $fillable = ['transfer_type', 'source_location', 'target_location'];

    public function siteName()
    {
        return $this->hasOne(Site::class, 'id', 'target_location');
    }


    public function sourceWarehouseName()
    {
        return $this->hasOne(Warehouse::class, 'id', 'source_location');
    }


    public function targetWarehouseName()
    {
        return $this->hasOne(Warehouse::class, 'id', 'target_location');
    }
}
