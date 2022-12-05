<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Color extends Model
{
    use  SoftCascadeTrait;

    public $timestamps = false;

    protected static function boot()
    {
       	parent::boot();

        static::addGlobalScope('isActive', function (Builder $builder) {
            $builder->where('colors.status', true);
        });
    }

    protected $table = 'colors';

    protected $fillable = [
        'code', 'status'
    ];
}
