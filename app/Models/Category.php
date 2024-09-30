<?php

namespace App\Models;

use App\Models\Presenters\CategoryPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
    ];

    public function searchableAs(): string
    {
        return 'categories_index';
    }

    public function toSearchableArray(): array
    {
        return $this->toArray();
    }

    public function products(): HasMany
    {
        return $this->HasMany(Product::class, 'category_id', 'id');
    }

    public function presenter(): CategoryPresenter
    {
        return new CategoryPresenter($this);
    }
}
