<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusLog extends Model
{
    protected $fillable = [
        'shipment_id',
        'status',
        'location',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function getFormattedStatusAttribute(): string
    {
        return str_replace('_', ' ', ucfirst($this->status));
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'delivered' => 'green',
            'in_transit' => 'yellow',
            default => 'gray'
        };
    }
}
