<x-modal name="show-discount">
    <div wire:loading.class="invisible">
        @if ($discount)
            <div style="padding: 20px;">

                <h1 style="font-size: 24px; margin-bottom: 10px;">{{ $discount->name }}</h1>
                <p style="font-size: 16px; margin-bottom: 10px;">Type: {{ $discount->type == 1 ? 'Fixed' : 'Percentage' }}</p>
                @php
                $statusName;
                if ($discount->status == 1) {
                    $statusName = 'Ongoing';
                } elseif ($discount->status == 3) {
                    $statusName = 'Scheduled';
                } elseif ($discount->status == 2) {
                    $statusName = 'Expired';
                } else {
                    $statusName = 'Invalid';
                }
            @endphp
                <p style="font-size: 16px; margin-bottom: 20px;">Activity: {{ $statusName }}</p>
                <p style="font-size: 16px; margin-bottom: 10px;">Value: {{ $discount->value }}</p>
                <p style="font-size: 16px; margin-bottom: 10px;">Start Date: {{ $discount->start_date != null ? \Carbon\Carbon::parse($discount->start_date)->format('M d, Y') : 'N/A' }}</p>
                <p style="font-size: 16px; margin-bottom: 10px;">End Date: {{ $discount->start_date != null ? \Carbon\Carbon::parse($discount->end_date)->format('M d, Y') : 'N/A' }}</p>

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
