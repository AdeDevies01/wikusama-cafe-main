<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'desc',
        'type',
        'ip_address',
        'user_agent'
    ];

    protected $fields = [
        'user_id',
        'desc',
        'type',
        'ip_address',
        'user_agent',
        'created_at',
        'updated_at'
    ];

    static $sortables = [
        'created_at' => 'Waktu aktivitas',
    ];

    static $activityTypes = ['login', 'logout', 'create', 'update', 'delete'];

    public function scopeOptions($query, $options = [])
    {
        if (isset($options['q'])) {
            $query->where('desc', 'like', '%' . $options['q'] . '%')
                ->orWhereHas('user', function ($query) use ($options) {
                    $query->where('name', 'like', '%' . $options['q'] . '%');
                });
        }
        if (isset($options['type'])) {
            $query->where('type', $options['type']);
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
