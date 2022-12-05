<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Wildside\Userstamps\Userstamps;

class MasterParameter extends Model
{
    use SoftDeletes, SoftCascadeTrait, Userstamps;

    protected $table = 'parameters';

    protected $fillable = [
        'perspective_id', 
        'strategic_target_id', 
        'parameter', 
        'formula', 
        'satuan', 
        'kondisi_id', 
        'type_ytd_id',
        'sumber', 
        'keterangan', 
        'status', 
        'created_by', 
        'updated_by', 
        'deleted_by',
    ];

    protected $softCascade = ['evidence'];

    public function evidence()
    {
        return $this->hasMany(Evidence::class, 'parameter_id', 'id');
    }

    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class, 'kondisi_id', 'id');
    }

    public function type_ytd()
    {
        return $this->belongsTo(TypeYtd::class, 'type_ytd_id', 'id');
    }

    public function perspective()
    {
        return $this->belongsTo(Perspective::class, 'perspective_id', 'id');
    }

    public function strategic_target()
    {
        return $this->belongsTo(StrategicTarget::class, 'strategic_target_id', 'id');
    }
}
