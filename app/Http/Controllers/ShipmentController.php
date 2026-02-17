<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShipmentController extends Controller
{
    private const ITEMS_PER_PAGE = 10;

    public function index(Request $request)
    {
        $search = $request->get('search');
        $page = $request->get('page', 1);

        $query = Shipment::query();

        if ($search) {
            $query->where('tracking_number', 'LIKE', "%{$search}%");
        }

        $shipments = $query->orderBy('shipment_date', 'desc')
            ->paginate(self::ITEMS_PER_PAGE)
            ->withQueryString();

        return view('shipments.index', compact('shipments', 'search'));
    }

    public function show(Shipment $shipment)
    {
        // Eager load status logs with the shipment
        $shipment->load(['statusLogs' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);
        
        return view('shipments.show', compact('shipment'));
    }
}