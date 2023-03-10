<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'name',
        'desc',
        'price',
        'category_id',
        'img'
    ];

    protected $fields = [
        'name',
        'desc',
        'price',
        'category_id',
        'img',
        'created_at',
        'updated_at'
    ];

    static $sortable = [
        'name' => 'Nama',
        'price' => 'Harga',
        'created_at' => 'Waktu dibuat',
        'updated_at' => 'Waktu diperbarui'
    ];

    public function scopeOptions($query, $options = [])
    {
        if (isset($options['q'])) {
            $query->where('name', 'like', '%' . $options['q'] . '%')
                ->orWhere('desc', 'like', '%' . $options['q'] . '%');
        }
        if (isset($options['category'])) {
            $query->where('category_id', $options['category']);
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
