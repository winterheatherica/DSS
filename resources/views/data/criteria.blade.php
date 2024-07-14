<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="flex justify-center text-white text-center">
        <x-add href="/add_criteria">Tambah</x-add>
    </div>


    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Criteria Id</th>
                    <th class="border px-4 py-2">Criteria Name</th>
                    <th class="border px-4 py-2">Criteria Status</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($total_criteria as $criteria)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{$criteria ['criteria_id']}}</td>
                        <td class="border px-4 py-2">{{$criteria ['criteria_name']}}</td>
                        <td class="border px-4 py-2">
                            @if($criteria['criteria_status'] == 'b')
                                Benefit
                            @elseif($criteria['criteria_status'] == 'c')
                                Cost
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            <div class="flex items-center">
                                <div class="hidden md:block">
                                    <div class="flex items-baseline space-x-4">
                                        <x-editanddelete href="/criteria/{{$criteria['criteria_id']}}">Lihat Detail</x-editanddelete>
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
