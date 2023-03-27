<?php

namespace App\Traits;

trait EloquentExtended
{

    public function scopeSearch($query, $term)
    {
        $columns = implode(',', $this->searchable);
        $query->when($term, function($q) use($columns, $term){
            $q->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", [$term]);
        });
        return $query;
    }
}
