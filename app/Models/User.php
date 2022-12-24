<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $guarded = ['id'];
    protected $table = 'admin';

    protected static function boot()
    {
        parent::boot();

        static::creating(function (User $admin) {
            $admin->password = Hash::make($admin->password);
        });
        static::updating(function (User $admin) {
            if ($admin->isDirty(["password"])) {
                $admin->password = Hash::make($admin->password);
            }
        });
    }
}
