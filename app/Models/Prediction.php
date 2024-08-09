<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    use HasFactory;
    protected $table = 'prediction';

    protected $fillable = ['category_id', 'sub_category_id', 'min_measurement_of_unit', 'working_unit_type_id', 'hours_of_completion'];

    public function categoryName()
    {
        return $this->hasOne(TaskCategory::class, 'id', 'category_id');
    }

    public function subCategoryName()
    {
        return $this->hasOne(TaskSubCategory::class, 'id', 'sub_category_id');
    }

    public function workingUnitTypeName()
    {
        return $this->hasOne(WorkingUnitType::class, 'id', 'working_unit_type_id');
    }


}
