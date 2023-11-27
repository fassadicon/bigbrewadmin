<x-modal name="show-user">
    <div wire:loading.class="invisible">
        @if ($user)
            <h1>{{ $user->name }}</h1>
            <h1>{{ $user->email }}</h1>
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
                                                {{ "$key: $data\n" }}<br>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($log->properties as $key => $value)
                                        @if ($key === 'old')
                                            @foreach ($value as $key => $data)
                                                {{ "$key: $data" }}<br>
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
