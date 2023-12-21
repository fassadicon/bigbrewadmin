<x-modal name="show-order">
    <div wire:loading.class="invisible">
        @if ($order)
            <div style="padding: 20px;">

                <h1 style="font-size: 24px; margin-bottom: 10px;">Order ID: {{ $order->id }}</h1>
                {{-- Uncomment the following line if $size->role is available --}}
                {{-- <h1>{{ $size->role }}</h1> --}}
                <h1 style="font-size: 18px; margin-bottom: 20px;">Catered by: {{ $order->user->name }}</h1>
                <h1 style="font-size: 18px; margin-bottom: 20px;">Remarks: {{ $order->remarks }}</h1>

                <h2 style="font-size: 18px; margin-bottom: 10px;">Products in this Order:</h2>
                <ul>
                    @foreach ($order->orderItems as $orderItem)
                        <li>{{ $orderItem->product->productDetail->name }} {{ $orderItem->product->size->name }} x {{ $orderItem->quantity }} - PHP {{ $orderItem->amount }}</li>
                    @endforeach
                </ul>

                <h2 style="font-size: 18px; margin-bottom: 10px;">Total amount: PHP {{ $order->total_amount }}</h2>
                <div style="margin-bottom: 20px;">
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
                                                    @if (is_array($data))
                                                        <div>
                                                            @foreach ($data as $orderItem)
                                                                @foreach ($orderItem as $key => $detail)
                                                                    {{ "$key: $detail\n" }}
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        {{ "$key: $data\n" }}
                                                    @endif
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
