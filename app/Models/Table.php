<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $table = 'tables';

    protected $fillable = [
        'number',
        'capacity',
        'desc',
        'is_available'
    ];

    protected $fields = [
        'number',
        'capacity',
        'desc',
        'is_available',
        'created_at',
        'updated_at'
    ];

    static $sortables = [
        'number' => 'Nomor Meja',
        'capacity' => 'Kapasitas',
        'created_at' => 'Waktu dibuat',
        'updated_at' => 'Waktu diperbarui'
    ];

    public function scopeOptions($query, $options = [])
    {
        if (isset($options['q'])) {
            $query->where('number', 'like', '%' . $options['q'] . '%')
                ->orWhere('desc', 'like', '%' . $options['q'] . '%');
        }
        if (isset($options['is_available'])) {
            $query->where('is_available', $options['is_available']);
        }
        if (isset($options['sortby']) && in_array($options['sortby'], $this->fields)) {
            if (!isset($options['order'])) {
                $options['order'] = 'asc';
            }
            $query->orderBy($options['sortby'], ($options['order'] == 'asc' || $options['order'] == 'desc') ? $options['order'] : 'asc');
        } else {
            $query->orderBy('number', 'asc');
        }
        return $query;
    }
}
