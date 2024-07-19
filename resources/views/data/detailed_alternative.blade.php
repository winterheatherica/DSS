<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="flex justify-center text-white text-center">
        <x-add href="/alternative">Kembali</x-add>
    </div>

    <div class="my-8 flex justify-center text-white text-center">
        <x-add onclick="toggleEditMode()">Edit Mode</x-add>
    </div>

    <div class="my-8 flex justify-center">
        <form id="criteria-form" action="/save_criteria_value" method="POST">
            @csrf
            <input type="hidden" name="alternative_id" value="{{$alternative_id}}">
            <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
                <thead>
                    <tr class="bg-gray-700 text-sm text-white text-center">
                        <th class="border px-4 py-2">Criteria Id</th>
                        <th class="border px-4 py-2">Criteria Name</th>
                        <th class="border px-4 py-2">Criteria Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternative as $detailed_alternative)
                        <tr class="bg-gray-500 text-white text-sm border text-center">
                            <td class="border px-4 py-2">{{$detailed_alternative->criteria_id}}</td>
                            <td class="border px-4 py-2">{{$detailed_alternative->criteria_name}}</td>
                            <td class="border px-4 py-2">
                                <span id="value-{{$detailed_alternative->criteria_id}}">
                                    {{$detailed_alternative->alternative_criteria_value ?? '-'}}
                                </span>
                                <input type="number" name="criteria_values[{{$detailed_alternative->criteria_id}}]" id="input-{{$detailed_alternative->criteria_id}}" class="hidden bg-gray-300 text-black px-2 py-1 rounded-md" value="{{$detailed_alternative->alternative_criteria_value}}">
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
