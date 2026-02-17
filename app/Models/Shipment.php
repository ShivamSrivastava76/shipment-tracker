<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
     public $timestamps = false; 

     protected $fillable = [
        'tracking_number',
        'sender_name',
        'sender_address',
        'receiver_name',
        'receiver_address',
        'destination_city',
        'status',
        'shipment_date'
    ];

    protected $casts = [
        'shipment_date' => 'date'
    ];

    public function statusLogs()
    {
        return $this->hasMany(StatusLog::class)->orderBy('created_at', 'desc');
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
