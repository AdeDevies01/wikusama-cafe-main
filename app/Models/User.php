<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fields = [
        'name',
        'username',
        'password',
        'role',
        'created_at',
        'updated_at'
    ];

    static $sortables = [
        'name' => 'Nama',
        'username' => 'Username',
        'created_at' => 'Waktu dibuat',
        'updated_at' => 'Waktu diperbarui'
    ];

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'photo',
    ];

    static $roles = ['administrator', 'manager', 'cashier'];

    protected $hidden = [
        'password',
    ];

    public function scopeOptions($query, $options = [])
    {
        if (isset($options['q'])) {
            $query->where('name', 'like', '%' . $options['q'] . '%')
                ->orWhere('username', 'like', '%' . $options['q'] . '%');
        }
        if (isset($options['role'])) {
            $query->where('role', $options['role']);
        }
        if (isset($options['sortby']) && in_array($options['sortby'], $this->fields)) {
            if (!isset($options['order'])) {
                $options['order'] = 'asc';
            }
            $query->orderBy($options['sortby'], ($options['order'] == 'asc' || $options['order'] == 'desc') ? $options['order'] : 'asc');
        } else {
            $query->orderBy('updated_at', 'desc');
        }
        return $query;
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
