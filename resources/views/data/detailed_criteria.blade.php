<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="flex justify-center text-white text-center">
        <x-add href="/criteria?page={{ request()->get('page', 1) }}">Kembali</x-add>
    </div>    

    <div class="my-8 flex justify-center text-white text-center">
        <x-add onclick="toggleEditMode()">Edit Mode</x-add>
    </div>

    <div class="my-8 flex justify-center">
        <form id="criteria-form" action="/save_alternative_value" method="POST">
            @csrf
            <input type="hidden" name="criteria_id" value="{{$criteria_id}}">
            <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
                <thead>
                    <tr class="bg-gray-700 text-sm text-white text-center">
                        <th class="border px-4 py-2">Alternative Id</th>
                        <th class="border px-4 py-2">Alternative Name</th>
                        <th class="border px-4 py-2">Criteria Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($criteria as $detailed_criteria)
                        <tr class="bg-gray-500 text-white text-sm border text-center">
                            <td class="border px-4 py-2">{{$detailed_criteria->alternative_id}}</td>
                            <td class="border px-4 py-2">{{$detailed_criteria->alternative_name}}</td>
                            <td class="border px-4 py-2">
                                <span id="value-{{$detailed_criteria->alternative_id}}">
                                    {{$detailed_criteria->alternative_criteria_value ?? '-'}}
                                </span>
                                <input type="number" name="criteria_values[{{$detailed_criteria->alternative_id}}]" id="input-{{$detailed_criteria->alternative_id}}" class="hidden bg-gray-300 text-black px-2 py-1 rounded-md" value="{{$detailed_criteria->alternative_criteria_value}}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
    
    <div class="flex justify-center text-white text-center mt-4">
        <x-add onclick="submitForm()">Save All</x-add>
    </div>

    <script>
        let isEditMode = false;

        function toggleEditMode() {
            isEditMode = !isEditMode;
            const inputs = document.querySelectorAll('input[type="number"]');
            const values = document.querySelectorAll('span[id^="value-"]');

            inputs.forEach(input => {
                if (isEditMode) {
                    input.classList.remove('hidden');
                } else {
                    if (input.value.trim() === '') {
                        input.value = '';
                    }
                    input.classList.add('hidden');
                }
            });

            values.forEach(value => {
                if (isEditMode) {
                    value.classList.add('hidden');
                } else {
                    value.classList.remove('hidden');
                }
            });
        }

        function submitForm() {
            document.getElementById('criteria-form').submit();
        }
    </script>

</x-layout>
