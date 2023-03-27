<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\EloquentExtended;

class Project extends Model
{
    use HasFactory, EloquentExtended;
    protected $hidden = [];

    protected $searchable = [
        'name',
        'detail',
        'status',
        'notes'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
