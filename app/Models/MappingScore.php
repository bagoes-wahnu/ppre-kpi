<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Wildside\Userstamps\Userstamps;

class MappingScore extends Model
{
    use SoftCascadeTrait, Userstamps;

    protected static function boot()
    {
       	parent::boot();

        static::addGlobalScope('isActive', function (Builder $builder) {
            $builder->where('setting_mapping_scores.status', true);
        });
    }

    protected $table = 'setting_mapping_scores';

    protected $fillable = [
        'color_id', 'name', 'name', 'description', 'min_value', 'max_value', 'status'
    ];

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
}
