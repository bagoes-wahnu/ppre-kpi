<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class ConditionFormula extends Model
{
    use SoftDeletes, SoftCascadeTrait, Userstamps;

    protected $fillable = [
        'year_id',
        'name',
        'score',
        'category',
        'description',
        'kondisi_id',
        'start_value',
        'end_value',
        'operator'
    ];

    public function year() : BelongsTo {
        return $this->belongsTo(TargetYear::class, 'year_id', 'id');
    }

    public function kondisi() : BelongsTo {
        return $this->belongsTo(Kondisi::class, 'kondisi_id', 'id');
    }
}
