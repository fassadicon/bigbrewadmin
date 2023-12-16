<x-modal name="show-user" class="p-6 mx-auto max-w-md bg-white rounded-md shadow-md m-4">
    <div wire:loading.class="invisible">
        @if ($user)
            <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
            <h1 class="text-lg text-gray-600">{{ $user->email }}</h1>
            <h1 class="text-lg text-green-600">Superadmin</h1>
            <h1 class="text-lg mt-4">Products with this size:</h1>

            <div class="mt-4">
                <table class="w-full border-collapse border border-gray-300 m-4">
                    <thead class="bg-gray-100">
                        <th class="p-3">Log</th>
                        <th class="p-3">Current</th>
                        <th class="p-3">Old</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Activity by</th>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">{{ $log->description }}</td>
                                <td class="p-3">
                                    @foreach ($log->properties as $key => $value)
                                        @if ($key === 'attributes')
                                            @foreach ($value as $key => $data)
                                                {{ "$key: $data\n" }}
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td class="p-3">
                                    @foreach ($log->properties as $key => $value)
                                        @if ($key === 'old')
                                            @foreach ($value as $key => $data)
                                                {{ "$key: $data\n" }}
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td class="p-3">{{ $log->created_at->format('M d, Y') }}</td>
                                <td class="p-3">
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
