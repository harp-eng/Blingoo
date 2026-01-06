<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{
    protected $table = 'meta_data';

    protected $fillable = [
        'model_type',
        'model_id',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    /**
     * Get the parent model (Post, Product, Page, etc.).
     */
    public function model()
    {
        return $this->morphTo();
    }
}
