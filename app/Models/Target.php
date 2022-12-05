<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Wildside\Userstamps\Userstamps;

class Target extends Model
{
    use SoftDeletes, SoftCascadeTrait, Userstamps, Notifiable;

    protected $fillable = [
        'parent_id',
        'target_year_id',
        'parameter_id',
        'unit_id',
        'pic',
        'target',
        'bobot',
        'status'
    ];

    public function year() {
        return $this->belongsTo(TargetYear::class, 'target_year_id', 'id');
    }

    public function parameter() {
        return $this->belongsTo(MasterParameter::class);
    }

    public function unit() {
        return $this->belongsTo(User::class);
    }

    public function remarks() {
        return $this->hasMany(TargetRemark::class);
    }

    public function remark() {
        return $this->hasOne(TargetRemark::class)->latest();
    }

    public function realization() {
        return $this->hasOne(Realization::class)->withDefault();
    }

    public function realizations() {
        return $this->hasMany(Realization::class);
    }

    public function belongsToRealization() {
        return $this->belongsTo(Realization::class)->withDefault();
    }
}
