<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Wildside\Userstamps\Userstamps;

class StrategicTarget extends Model
{
    use SoftDeletes, SoftCascadeTrait, Userstamps;

    protected $table = 'strategic_targets';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('isActive', function (Builder $builder) {
            $builder->where('strategic_targets.status', true);
        });
    }
    
    protected $fillable = [
        'name', 'perspective_id', 'status', 'created_by', 'updated_by', 'deleted_by',
    ];

    public function perspective()
    {
        return $this->belongsTo(Perspective::class, 'perspective_id', 'id');
    }
}
