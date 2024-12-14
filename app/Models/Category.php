<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primarykey = "id";

    protected $fillable = [
        'name', 
        'status', 
        'parent_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getFullPathAttribute()
    {
        $fullPath = $this->name;
        if ($this->parent) {
            $fullPath = $this->parent->full_path . ' > ' . $fullPath;
        }
        return $fullPath;
    }

}
