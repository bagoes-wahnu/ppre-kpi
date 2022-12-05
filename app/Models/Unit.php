<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Unit extends Model
{
    protected $table = 'users';

    /**
     * Get the user associated with the Target
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function target(): HasOne
    {
        return $this->hasOne(Target::class, 'unit_id', 'id');
    }
}
