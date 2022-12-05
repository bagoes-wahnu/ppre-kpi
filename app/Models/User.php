<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Wildside\Userstamps\Userstamps;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes, SoftCascadeTrait, Userstamps;

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope('isActive', function (Builder $builder) {
    //         $builder->where('users.status', true);
    //     });
    // }

    protected $fillable = [
        'role_id',
        'organization_id',
        'name',
        'username',
        'status',
        'unit',
        'pic',
        'created_by',
        'updated_by',
        'deleted_by',
        'atasan'
    ];

    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function atasan()
    {
        return $this->belongsTo(User::class, 'atasan', 'id');
    }
}
