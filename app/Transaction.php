<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param          $query
     * @param Category $category
     */
    public function scopeByCategory($query, Category $category)
    {
        if ($category->exists) {
            $query->where('category_id', $category->id);
        }
    }
}
