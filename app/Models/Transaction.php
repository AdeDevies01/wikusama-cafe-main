<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = [
        'cashier_id',
        'table_id',
        'total_price',
        'total_payment',
        'customer_name',
        'is_delivered',
        'is_paid',
        'note'
    ];

    protected $fields = [
        'cashier_id',
        'table_id',
        'total_price',
        'total_payment',
        'customer_name',
        'is_delivered',
        'is_paid',
        'note',
        'created_at',
        'updated_at'
    ];

    static $sortables = [
        'customer_name' => 'Nama Pelanggan',
        'total_price' => 'Total Tagihan',
        'created_at' => 'Waktu dibuat',
        'updated_at' => 'Waktu dibayar',
    ];

    public function scopeOptions($query, $options = [])
    {
        if (isset($options['q'])) {
            $query->where('customer_name', 'like', '%' . $options['q'] . '%')
                ->orWhereHas('table', function ($q) use ($options) {
                    $q->where('number', 'like', '%' . $options['q'] . '%');
                });
        }
        if (isset($options['cashier_id'])) {
            $query->where('cashier_id', $options['cashier_id']);
        }
        if (isset($options['start_date'])) {
            $query->whereDate('created_at', '>=', $options['start_date']);
        }
        if (isset($options['end_date'])) {
            $query->whereDate('created_at', '<=', $options['end_date']);
        }
        if (isset($options['is_paid'])) {
            $query->where('is_paid', $options['is_paid']);
        }
        if (isset($options['sortby']) && in_array($options['sortby'], $this->fields)) {
            if (!isset($options['order'])) {
                $options['order'] = 'asc';
            }
            $query->orderBy($options['sortby'], ($options['order'] == 'asc' || $options['order'] == 'desc') ? $options['order'] : 'asc');
        } else {
            $query->orderBy('is_paid')->orderBy('created_at', 'desc');
        }
        return $query;
    }

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
