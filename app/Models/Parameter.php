<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Wildside\Userstamps\Userstamps;

class Parameter extends Model
{
    use SoftCascadeTrait, Userstamps;

    protected static function boot()
    {
       	parent::boot();

        static::addGlobalScope('isActive', function (Builder $builder) {
            $builder->where('setting_parameters.status', true);
        });
    }

    protected $table = 'setting_parameters';

    protected $fillable = [
        'key_setting', 'value', 'status'
    ];
}
