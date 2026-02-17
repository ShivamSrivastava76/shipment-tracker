@extends('layouts.app')

@section('title', 'Shipments List')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Shipments List</h1>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('shipments.index') }}" class="mb-6">
        <div class="flex gap-2">
            <input 
                type="text" 
                name="search" 
                value="{{ $search }}"
                placeholder="Search by tracking number..."
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button 
                type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            >
                Search
            </button>
            @if($search)
                <a 
                    href="{{ route('shipments.index') }}"
                    class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition"
                >
                    Clear
                </a>
            @endif
        </div>
    </form>

    <!-- Shipments Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tracking Number</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Receiver Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination City</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shipment Date</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($shipments as $shipment)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <a href="{{ route('shipments.show', $shipment) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                {{ $shipment->tracking_number }}
                            </a>
                        </td>
                        <td class="px-6 py-4">{{ $shipment->receiver_name }}</td>
                        <td class="px-6 py-4">{{ $shipment->destination_city }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($shipment->status === 'delivered') bg-green-100 text-green-800
                                @elseif($shipment->status === 'in_transit') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ $shipment->formatted_status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $shipment->shipment_date->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            No shipments found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $shipments->links() }}
    </div>
@endsection