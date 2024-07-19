<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Method Id</th>
                    <th class="border px-4 py-2">Method Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($total_method->sortBy('method_id') as $method)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{$method['method_id']}}</td>
                        <td class="border px-4 py-2">{{$method['method_name']}}</td>
                    </tr>
                @endforeach
            </tbody>            
        </table>
    </div>

</x-layout>
