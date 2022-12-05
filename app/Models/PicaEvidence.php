<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class PicaEvidence extends Model
{
    use SoftDeletes, SoftCascadeTrait, Userstamps;

    protected $fillable = [
        'realization_pica_id',
        'initial_attachment',
        'correction_attachment'
    ];
}
