<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">History Id</th>
                    <th class="border px-4 py-2">Method Id</th>
                    <th class="border px-4 py-2">User Id</th>
                    <th class="border px-4 py-2">Case </th>
                    <th class="border px-4 py-2">Primary</th>
                    <th class="border px-4 py-2">Secondary</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $detailed_history)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{$detailed_history ['history_id']}}</td>
                        <td class="border px-4 py-2">{{$detailed_history ['method_id']}}</td>
                        <td class="border px-4 py-2">{{$detailed_history ['user_id']}}</td>
                        <td class="border px-4 py-2">{{$detailed_history ['case_name']}}</td>
                        <td class="border px-4 py-2">{{ $detailed_history['primary_weight'] ?? 'Tidak Ada' }}</td>
                        <td class="border px-4 py-2">{{ $detailed_history['secondary_weight'] ?? 'Tidak Ada' }}</td>
                        <td class="border px-4 py-2">
                            <div class="flex items-center">
                                <div class="hidden md:block">
                                    <div class="flex items-baseline space-x-4">
                                        <x-editanddelete href="/history/{{$detailed_history['history_id']}}">Lihat Detail</x-editanddelete>
                                        <x-editanddelete href="/">Edit</x-editanddelete>
                                        <x-editanddelete href="/about">Delete</x-editanddelete>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layout>
