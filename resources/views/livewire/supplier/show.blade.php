<x-modal name="show-supplier">
    <div wire:loading.class="invisible">
        @if ($supplier)
            <div style="padding: 20px;">

                <h1 style="font-size: 24px; margin-bottom: 10px;">{{ $supplier->name }}</h1>
                <p style="font-size: 16px; margin-bottom: 10px;">{{ $supplier->measurement }}</p>
                <p style="font-size: 16px; margin-bottom: 20px;">{{ $supplier->description }}</p>

                <h2 style="font-size: 18px; margin-bottom: 10px;">Inventory Items from this supplier:</h2>

                <ul style="list-style-type: none; padding: 0; margin: 0;">
                    @forelse ($supplier->inventoryLogs->inventoryItems as $inventoryItem)
                        <li style="font-size: 14px; margin-bottom: 5px;">{{ $inventoryItem->name }}</li>
                    @empty
                        <li style="font-size: 14px; margin-bottom: 5px;">None</li>
                    @endforelse
                </ul>

                <div style="margin-top: 20px;">

                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <th style="padding: 10px; background-color: #f2f2f2;">Log</th>
                            <th style="padding: 10px; background-color: #f2f2f2;">Current</th>
                            <th style="padding: 10px; background-color: #f2f2f2;">Old</th>
                            <th style="padding: 10px; background-color: #f2f2f2;">Date</th>
                            <th style="padding: 10px; background-color: #f2f2f2;">Activity by</th>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td style="padding: 10px;">{{ $log->description }}</td>
                                    <td style="padding: 10px;">
                                        @foreach ($log->properties as $key => $value)
                                            @if ($key === 'attributes')
                                                @foreach ($value as $key => $data)
                                                    {{ "$key: $data\n" }}
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                    <td style="padding: 10px;">
                                        @foreach ($log->properties as $key => $value)
                                            @if ($key === 'old')
                                                @foreach ($value as $key => $data)
                                                    {{ "$key: $data\n" }}
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                    <td style="padding: 10px;">{{ $log->created_at->format('M d, Y') }}</td>
                                    <td style="padding: 10px;">
                                        @if ($log->causer)
                                            {{ $log->causer->name }}
                                        @else
                                            System generated
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        @endif
    </div>
</x-modal>
