<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class RealizationPica extends Model
{
    use SoftDeletes, SoftCascadeTrait, Userstamps;

    protected $fillable = [
        'realization_id',
        'problem_identification',
        'corrective_action',
        'pic',
        'due_date'
    ];

    public function evidence() {
        return $this->hasOne(PicaEvidence::class)->withDefault();
    }
}
