<x-modal name="show-order">
    <div wire:loading.class="invisible">
        @if ($order)
            <h1>{{ $order->id }}</h1>
            {{-- <h1>{{ $size->role }}</h1> --}}
            <h1>Superadmin</h1>
            <h1>Products with this size:</h1>

            <div class="">
                <table>
                    <thead>
                        <th>Log</th>
                        <th>Current</th>
                        <th>Old</th>
                        <th>Date</th>
                        <th>Activity by</th>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log->description }}</td>
                                <td>
                                    @foreach ($log->properties as $key => $value)
                                        @if ($key === 'attributes')
                                            @foreach ($value as $key => $data)
                                                @if (is_array($data))
                                                    @foreach ($data as $orderItem)
                                                        <div class="bg-slate-300">
                                                            @foreach ($orderItem as $key => $detail)
                                                                {{ "$key: $detail\n" }}<br>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                @else
                                                    {{ "$key: $data\n" }}<br>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($log->properties as $key => $value)
                                        @if ($key === 'old')
                                            @foreach ($value as $key => $data)
                                                @unless (is_array($data))
                                                    {{ "$key: $data" }}<br>
                                                @else
                                                    @foreach ($value as $key => $data)
                                                        @unless (is_array($data))
                                                            {{ "$key: $data" }}<br>
                                                        @endunless
                                                    @endforeach
                                                @endunless
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $log->created_at->format('M d, Y') }}</td>
                                <td>
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
        @endif


    </div>


</x-modal>
