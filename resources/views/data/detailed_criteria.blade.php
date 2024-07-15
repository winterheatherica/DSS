<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="flex justify-center text-white text-center">
        <x-add href="/criteria">Kembali</x-add>
    </div>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Alternative Id</th>
                    <th class="border px-4 py-2">Alternative Name</th>
                    <th class="border px-4 py-2">Criteria Value</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($criteria as $detailed_criteria)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{$detailed_criteria->alternative_id}}</td>
                        <td class="border px-4 py-2">{{$detailed_criteria->alternative_name}}</td>
                        <td class="border px-4 py-2">
                            <form id="form-{{$detailed_criteria->alternative_id}}" action="/save_criteria_value" method="POST">
                                @csrf
                                <input type="hidden" name="criteria_id" value="{{$criteria_id}}">
                                <input type="hidden" name="alternative_id" value="{{$detailed_criteria->alternative_id}}">
                                <span id="value-{{$detailed_criteria->alternative_id}}">
                                    {{$detailed_criteria->alternative_criteria_value ?? '-'}}
                                </span>
                                <input type="text" name="criteria_value" id="input-{{$detailed_criteria->alternative_id}}" class="hidden bg-gray-300 text-black px-2 py-1 rounded-md">
                            </form>
                        </td>
                        <td class="border px-4 py-2">
                            <div class="flex items-center">
                                <div class="hidden md:block">
                                    <div class="flex items-baseline space-x-4">
                                        <x-editanddelete onclick="toggleEdit({{$detailed_criteria->alternative_id}})" style="text-decoration: none; cursor: pointer;">Edit</x-editanddelete>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function toggleEdit(criteriaId) {
            let valueElement = document.getElementById(`value-${criteriaId}`);
            let inputElement = document.getElementById(`input-${criteriaId}`);
            let formElement = document.getElementById(`form-${criteriaId}`);
            let buttonElement = event.target;

            if (buttonElement.innerText === 'Edit') {
                valueElement.classList.add('hidden');
                inputElement.classList.remove('hidden');
                inputElement.value = valueElement.innerText.trim() === '-' ? '' : valueElement.innerText.trim();
                buttonElement.innerText = 'Save';
            } else {
                formElement.submit();
            }
        }
    </script>

</x-layout>
