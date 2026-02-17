@extends('layouts.app')

@section('title', "Shipment {$shipment->tracking_number}")

@section('content')
    <div class="mb-6">
        <a href="{{ route('shipments.index') }}" class="text-blue-600 hover:text-blue-800 hover:underline inline-flex items-center">
            ← Back to Shipments
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Shipment Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">
                    Shipment Details: {{ $shipment->tracking_number }}
                </h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h2 class="text-lg font-semibold text-gray-700 mb-3">Sender Information</h2>
                        <p class="mb-2"><span class="font-medium text-gray-600">Name:</span> {{ $shipment->sender_name }}</p>
                        <p><span class="font-medium text-gray-600">Address:</span> {{ $shipment->sender_address }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h2 class="text-lg font-semibold text-gray-700 mb-3">Receiver Information</h2>
                        <p class="mb-2"><span class="font-medium text-gray-600">Name:</span> {{ $shipment->receiver_name }}</p>
                        <p class="mb-2"><span class="font-medium text-gray-600">Address:</span> {{ $shipment->receiver_address }}</p>
                        <p><span class="font-medium text-gray-600">Destination:</span> {{ $shipment->destination_city }}</p>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <p class="mb-2">
                        <span class="font-medium text-gray-600">Current Status:</span>
                        <span class="ml-2 px-2 py-1 text-sm rounded-full 
                            @if($shipment->status === 'delivered') bg-green-100 text-green-800
                            @elseif($shipment->status === 'in_transit') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $shipment->formatted_status }}
                        </span>
                    </p>
                    <p>
                        <span class="font-medium text-gray-600">Shipment Date:</span>
                        {{ $shipment->shipment_date->format('d M, Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Status Timeline -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Status Timeline</h2>

                @if($shipment->statusLogs->isEmpty())
                    <p class="text-gray-500 text-center py-4">No status updates available</p>
                @else
                    <div class="space-y-4">
                        @foreach($shipment->statusLogs as $log)
                            <div class="relative flex items-start gap-4">
                                <div class="relative">
                                    <div class="w-4 h-4 rounded-full 
                                        @if($log->status === 'delivered') bg-green-500
                                        @elseif($log->status === 'in_transit') bg-yellow-500
                                        @else bg-gray-500
                                        @endif">
                                    </div>
                                    @if(!$loop->last)
                                        <div class="absolute top-4 left-2 w-0.5 h-12 bg-gray-300 -translate-x-1/2"></div>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <div class="flex justify-between items-start mb-1">
                                            <span class="font-medium text-gray-700">
                                                {{ ucfirst(str_replace('_', ' ', $log->status)) }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                {{ $log->created_at->format('d M, H:i') }}
                                            </span>
                                        </div>
                                        @if($log->location)
                                            <p class="text-sm text-gray-600">
                                                 {{ $log->location }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection