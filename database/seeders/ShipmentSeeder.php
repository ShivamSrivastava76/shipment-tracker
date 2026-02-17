<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Shipment;
use App\Models\StatusLog;
use Illuminate\Database\Seeder;
use DB;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Clear existing data in correct order
        StatusLog::truncate();
        Shipment::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Shipment 1 - Delivered (Mumbai to Delhi)
        $shipment1 = Shipment::create([
            'tracking_number' => 'IND123456789',
            'sender_name' => 'Rajesh Kumar',
            'sender_address' => 'Flat 301, Sunshine Apartments, Andheri East, Mumbai - 400093',
            'receiver_name' => 'Priya Sharma',
            'receiver_address' => 'House No. 45, Block C, Janakpuri, New Delhi - 110058',
            'destination_city' => 'Delhi',
            'status' => 'delivered',
            'shipment_date' => '2024-01-15'
        ]);

        StatusLog::insert([
            [
                'shipment_id' => $shipment1->id,
                'status' => 'pending',
                'location' => 'Mumbai',
                'created_at' => '2024-01-15 09:30:00'
            ],
            [
                'shipment_id' => $shipment1->id,
                'status' => 'in_transit',
                'location' => 'Pune',
                'created_at' => '2024-01-15 18:45:00'
            ],
            [
                'shipment_id' => $shipment1->id,
                'status' => 'in_transit',
                'location' => 'Indore',
                'created_at' => '2024-01-16 14:20:00'
            ],
            [
                'shipment_id' => $shipment1->id,
                'status' => 'in_transit',
                'location' => 'Delhi NCR',
                'created_at' => '2024-01-17 10:15:00'
            ],
            [
                'shipment_id' => $shipment1->id,
                'status' => 'delivered',
                'location' => 'New Delhi',
                'created_at' => '2024-01-17 16:30:00'
            ]
        ]);

        $shipment2 = Shipment::create([
            'tracking_number' => 'IND987654321',
            'sender_name' => 'Suresh Reddy',
            'sender_address' => '#42, 3rd Cross, Indiranagar, Bangalore - 560038',
            'receiver_name' => 'Lakshmi Narayanan',
            'receiver_address' => 'Old No. 10, New No. 21, T Nagar, Chennai - 600017',
            'destination_city' => 'Chennai',
            'status' => 'in_transit',
            'shipment_date' => '2024-02-01'
        ]);

        StatusLog::insert([
            [
                'shipment_id' => $shipment2->id,
                'status' => 'pending',
                'location' => 'Bangalore',
                'created_at' => '2024-02-01 10:00:00'
            ],
            [
                'shipment_id' => $shipment2->id,
                'status' => 'in_transit',
                'location' => 'Vellore',
                'created_at' => '2024-02-02 08:30:00'
            ]
        ]);

        $shipment3 = Shipment::create([
            'tracking_number' => 'IND456789123',
            'sender_name' => 'Amitava Das',
            'sender_address' => 'B-56, Salt Lake City, Sector V, Kolkata - 700091',
            'receiver_name' => 'Mohammed Abdul',
            'receiver_address' => 'H No. 8-2-293, Banjara Hills, Hyderabad - 500034',
            'destination_city' => 'Hyderabad',
            'status' => 'pending',
            'shipment_date' => '2024-02-05'
        ]);

        StatusLog::create([
            'shipment_id' => $shipment3->id,
            'status' => 'pending',
            'location' => 'Kolkata',
            'created_at' => '2024-02-05 11:45:00'
        ]);

        $shipment4 = Shipment::create([
            'tracking_number' => 'INDFLP123456',
            'sender_name' => 'Flipkart India Pvt Ltd',
            'sender_address' => 'Embassy Tech Village, Outer Ring Road, Bangalore - 560103',
            'receiver_name' => 'Rahul Gandhi',
            'receiver_address' => 'House No. 123, Model Town, Lucknow - 226001',
            'destination_city' => 'Lucknow',
            'status' => 'in_transit',
            'shipment_date' => now()->subDays(2)->format('Y-m-d')
        ]);

        StatusLog::insert([
            [
                'shipment_id' => $shipment4->id,
                'status' => 'pending',
                'location' => 'Bangalore',
                'created_at' => now()->subDays(2)->setTime(10, 0)->format('Y-m-d H:i:s')
            ],
            [
                'shipment_id' => $shipment4->id,
                'status' => 'in_transit',
                'location' => 'Hyderabad',
                'created_at' => now()->subDays(1)->setTime(15, 30)->format('Y-m-d H:i:s')
            ]
        ]);

        $shipment5 = Shipment::create([
            'tracking_number' => 'INTCUS789012',
            'sender_name' => 'Amazon US',
            'sender_address' => '410 Terry Ave N, Seattle, WA 98109, USA',
            'receiver_name' => 'Ananya Singh',
            'receiver_address' => 'C-45, Defence Colony, New Delhi - 110024',
            'destination_city' => 'Delhi',
            'status' => 'in_transit',
            'shipment_date' => now()->subDays(5)->format('Y-m-d')
        ]);

        StatusLog::insert([
            [
                'shipment_id' => $shipment5->id,
                'status' => 'pending',
                'location' => 'Seattle, USA',
                'created_at' => now()->subDays(5)->setTime(8, 0)->format('Y-m-d H:i:s')
            ],
            [
                'shipment_id' => $shipment5->id,
                'status' => 'in_transit',
                'location' => 'Dubai, UAE',
                'created_at' => now()->subDays(3)->setTime(22, 15)->format('Y-m-d H:i:s')
            ],
            [
                'shipment_id' => $shipment5->id,
                'status' => 'in_transit',
                'location' => 'Mumbai International Airport',
                'created_at' => now()->subDays(2)->setTime(6, 30)->format('Y-m-d H:i:s')
            ],
            [
                'shipment_id' => $shipment5->id,
                'status' => 'in_transit',
                'location' => 'Delhi NCR',
                'created_at' => now()->subDays(1)->setTime(14, 45)->format('Y-m-d H:i:s')
            ]
        ]);

        
    }
}