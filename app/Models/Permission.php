<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;
    protected $primarykey = "id";
    protected $table = 'permissions';
    protected $fillable = [
        'name',
        'title'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_has_permission');
    }
}
