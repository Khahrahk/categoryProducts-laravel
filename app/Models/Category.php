<?php

namespace App\Models;

use App\Models\Presenters\CategoryPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function products(): HasMany
    {
        return $this->HasMany(Product::class, 'category_id', 'id');
    }

    public function presenter(): CategoryPresenter
    {
        return new CategoryPresenter($this);
    }
}
