<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="flex justify-center text-white text-center">
        <x-add href="/add_alternative">Tambah</x-add>
    </div>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Alternative Id</th>
                    <th class="border px-4 py-2">Alternative Name</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($total_alternative as $alternative)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{$alternative ['alternative_id']}}</td>
                        <td class="border px-4 py-2">{{$alternative ['alternative_name']}}</td>
                        <td class="border px-4 py-2">
                            <div class="flex items-center">
                                <div class="hidden md:block">
                                    <div class="flex items-baseline space-x-4">
                                        <x-editanddelete href="/alternative/{{$alternative['alternative_id']}}">Lihat Detail</x-editanddelete>
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