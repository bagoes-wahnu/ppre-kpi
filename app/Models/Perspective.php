<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Wildside\Userstamps\Userstamps;

class Perspective extends Model
{
    use SoftDeletes, SoftCascadeTrait, Userstamps;

    protected $table = 'perspectives';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('isActive', function (Builder $builder) {
            $builder->where('perspectives.status', true);
        });
    }

    protected $fillable = [
        'name', 'status', 'created_by', 'updated_by', 'deleted_by',
    ];

    public function strategic_target()
    {
        return $this->hasMany(StrategicTarget::class, 'perspective_id', 'id');
    }

}
