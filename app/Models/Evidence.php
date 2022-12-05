<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Wildside\Userstamps\Userstamps;

class Evidence extends Model
{
    use SoftDeletes, SoftCascadeTrait, Userstamps;

    protected $fillable = [
        'parameter_id', 'name', 'status', 'created_by', 'updated_by', 'deleted_by'
    ];
}
