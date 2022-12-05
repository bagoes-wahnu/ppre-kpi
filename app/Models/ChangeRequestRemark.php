<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class ChangeRequestRemark extends Model
{
    use SoftDeletes, SoftCascadeTrait, Userstamps;

    protected $fillable = [
        'realization_change_request_id',
        'status',
        'description'
    ];
}
