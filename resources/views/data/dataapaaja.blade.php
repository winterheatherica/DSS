<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-red-500 shadow-lg">
            <thead class="bg-red-700 text-white">
                <tr>
                    <th class="px-4 py-2">history_id</th>
                    <th class="px-4 py-2">method_id</th>
                    <th class="px-4 py-2">user_id</th>
                    <th class="px-4 py-2">case_name</th>
                    <th class="px-4 py-2">primary_weight</th>
                    <th class="px-4 py-2">secondary_weight</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $detailed_history)
                    <tr class="bg-red-600 text-white">
                        <td class="border px-4 py-2">{{$detailed_history ['history_id']}}</td>
                        <td class="border px-4 py-2">{{$detailed_history ['method_id']}}</td>
                        <td class="border px-4 py-2">{{$detailed_history ['user_id']}}</td>
                        <td class="border px-4 py-2">{{$detailed_history ['case_name']}}</td>
                        <td class="border px-4 py-2">{{$detailed_history ['primary_weight']}}</td>
                        <td class="border px-4 py-2">{{$detailed_history ['secondary_weight']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layout>
