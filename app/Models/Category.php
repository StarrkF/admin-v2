<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_type_id',
        'name',
        'slug',
        'number',
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setNumberAttribute($value)
    {
        $this->attributes['number'] = $value ? $value : 100;
    }

    public function page_type()
    {
        return $this->belongsTo(PageType::class);
    }

}
