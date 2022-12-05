<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Wildside\Userstamps\Userstamps;

class Role extends Model
{
    use SoftDeletes, SoftCascadeTrait, Userstamps;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('isActive', function (Builder $builder) {
            $builder->where('roles.status', true);
        });
    }

    protected $table = 'roles';

    protected $fillable = [
        'name', 'slug', 'status', 'created_by', 'updated_by', 'deleted_by',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

}
