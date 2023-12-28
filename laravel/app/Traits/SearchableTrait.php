<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait SearchableTrait
{
    public function scopeSearch($query, $search)
    {
        $fields = $this->getSearchFields();
        $query->where(function (Builder $q) use ($search, $fields) {
            foreach ($fields as $field) {
                if (strpos($field, '.') !== false) {
                    $relationParts = explode('.', $field);
                    $relation = array_shift($relationParts);
                    $nestedField = implode('.', $relationParts);

                    $q->orWhereHas($relation, function (Builder $nestedQuery) use ($search, $nestedField) {
                        $nestedQuery->where($nestedField, 'LIKE', "%$search%");
                    });
                } else {
                    $q->orWhere($field, 'LIKE', "%$search%");
                }
            }
        });
    }

    abstract public function getSearchFields();
}
