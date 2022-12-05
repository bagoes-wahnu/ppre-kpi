<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Realization extends Model
{
    use SoftDeletes, SoftCascadeTrait, Userstamps;
    
    protected $fillable = [
        'target_id',
        'quarter',
        'realization',
        'score',
        'score_x_bobot',
        'status'
    ];

    protected $attributes = [
        'realization' => null,
        'status' => null
    ];

    protected static function boot() {
        parent::boot();
    }

    public function evidence(): HasOne {
        return $this->hasOne(RealizationEvidence::class)->latest();
    }

    public function pica(): HasOne {
        return $this->hasOne(RealizationPica::class);
    }

    public function belongsToTarget(): BelongsTo {
        return $this->belongsTo(Target::class);
    }
    
    public function pendingChangeRequest(): HasOne {
        return $this->hasOne(RealizationChangeRequest::class)->where('status', 1);
    }

    public function appprovedChangeRequest(): HasOne {
        return $this->hasOne(RealizationChangeRequest::class)->where('status', 2);
    }

    public function rejectedChangeRequest(): HasOne {
        return $this->hasOne(RealizationChangeRequest::class)->where('status', 3);
    }

    public function changeRequest(): HasOne {
        return $this->hasOne(RealizationChangeRequest::class);
    }

    public function changeRequests(): HasMany {
        return $this->hasMany(RealizationChangeRequest::class);
    }

    public function target(): BelongsTo {
        return $this->belongsTo(Target::class);
    }

    public function mappingScore(): BelongsTo {
        return $this->belongsTo(MappingScore::class);
    }
}
