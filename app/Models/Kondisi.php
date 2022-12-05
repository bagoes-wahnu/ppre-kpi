<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kondisi extends Model
{
    protected $table = 'kondisi';

    protected $fillable = [
        'value'
    ];

    public function conditionFormulas() : HasMany {
        return $this->hasMany(ConditionFormula::class, 'kondisi_id', 'id');
    }
}
