<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class TargetYear extends Model
{
    use SoftDeletes, SoftCascadeTrait, Userstamps;

    protected $fillable = [
        'year',
        'is_active'
    ];

    public function parameterTargetNeedApproval() : HasMany {
        return $this->hasMany(Target::class)->where([
            'status' => 1
        ]);
    }
}
