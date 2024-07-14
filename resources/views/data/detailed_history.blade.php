<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">History Id</th>
                    <th class="border px-4 py-2">Method</th>
                    <th class="border px-4 py-2">User Id</th>
                    <th class="border px-4 py-2">Case Name</th>
                    <th class="border px-4 py-2">Primary Weight</th>
                    <th class="border px-4 py-2">Secondary Weight</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-gray-500 text-white text-sm border text-center">
                    <td class="border px-4 py-2">{{ $detailed_history->history_id }}</td>
                    <td class="border px-4 py-2">{{ $detailed_history->method_name }}</td>
                    <td class="border px-4 py-2">{{ $detailed_history->user_id }}</td>
                    <td class="border px-4 py-2">{{ $detailed_history->case_name }}</td>
                    <td class="border px-4 py-2">{{ $detailed_history->primary_weight ?? 'Tidak Ada' }}</td>
                    <td class="border px-4 py-2">{{ $detailed_history->secondary_weight ?? 'Tidak Ada' }}</td>
                    <td class="border px-4 py-2">
                        <div class="flex items-center">
                            <div class="hidden md:block">
                                <div class="flex items-baseline space-x-4">
                                    <x-editanddelete href="/history">Back</x-editanddelete>
                                    <x-editanddelete href="/">Edit</x-editanddelete>
                                    <x-editanddelete href="/about">Delete</x-editanddelete>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- WP1 Data -->
    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Criteria ID</th>
                    <th class="border px-4 py-2">Criteria Name</th>
                    <th class="border px-4 py-2">Criteria Status</th>
                    <th class="border px-4 py-2">Criteria Value</th>
                    <th class="border px-4 py-2">Normalisasi Criteria</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wp1_data as $data)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{ $data->criteria_id }}</td>
                        <td class="border px-4 py-2">{{ $data->criteria_name }}</td>
                        <td class="border px-4 py-2">{{ $data->criteria_status }}</td>
                        <td class="border px-4 py-2">{{ $data->criteria_value }}</td>
                        <td class="border px-4 py-2">{{ $data->Normalisasi_Criteria }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- WP2 Data -->
    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Alternative ID</th>
                    <th class="border px-4 py-2">Alternative Name</th>
                    <th class="border px-4 py-2">Normalisasi Alternative</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wp2_data as $data)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{ $data->alternative_id }}</td>
                        <td class="border px-4 py-2">{{ $data->alternative_name }}</td>
                        <td class="border px-4 py-2">{{ $data->Normalisasi_Alternative }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- WP3 Data -->
    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Alternative ID</th>
                    <th class="border px-4 py-2">Alternative Name</th>
                    <th class="border px-4 py-2">Hasil Akhir</th>
                    {{-- <th class="border px-4 py-2">Rank</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($wp3_data as $data)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{ $data->alternative_id }}</td>
                        <td class="border px-4 py-2">{{ $data->alternative_name }}</td>
                        <td class="border px-4 py-2">{{ $data->Hasil_Akhir }}</td>
                        {{-- <td class="border px-4 py-2">{{ $data->Rank }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
