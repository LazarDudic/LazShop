<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait Search
{
    public function scopeSearch($query, $searchQuery, array $searchFields = [])
    {
        $fields = $this->validateSearchFields($searchFields);

        return static::where(function ($query) use ($fields, $searchQuery) {
            foreach ($fields as $field) {
                $query->orWhere($field, 'LIKE', "%$searchQuery%");
            }
        });
    }

    protected function validateSearchFields($searchFields)
    {
        $fieldsFromDatabase = Schema::getColumnListing($this->getTable());

        foreach ($searchFields as $field) {
            if (in_array($field, $fieldsFromDatabase)) {
                $fields[] = $field;
            } else {
                throw new \Exception('Search field ' . $field .  ' is invalid.');
            }
        }

        return $fields ?? $fieldsFromDatabase;
    }

}
