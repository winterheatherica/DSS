<x-layout>
    <x-slot:title>Calculation</x-slot:title>

    <div class="my-8 flex justify-center">
        <form method="POST" action="{{ route('calculation.store') }}">
            @csrf
            <div class="flex justify-center mb-4">
            <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium mx-auto">
                <thead>
                    <tr class="bg-gray-700 text-sm text-white text-center">
                        <th class="border px-4 py-2">Field</th>
                        <th class="border px-4 py-2">Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">Method</td>
                        <td class="border px-4 py-2">
                            <select id="method-dropdown" name="method_id" class="text-black px-2 py-1 rounded-md" required>
                                @foreach ($methods as $method)
                                    <option value="{{ $method->method_id }}">{{ $method->method_name }}</option>
                                @endforeach
                            </select>                            
                        </td>
                    </tr>
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">Case Name</td>
                        <td class="border px-4 py-2">
                            <input type="text" name="case_name" class="text-black px-2 py-1 rounded-md" required>
                        </td>
                    </tr>
                    <tr class="bg-gray-500 text-white text-sm border text-center" id="primary-weight-row">
                        <td class="border px-4 py-2">Primary Weight</td>
                        <td class="border px-4 py-2">
                            <input type="text" name="primary_weight" class="text-black px-2 py-1 rounded-md" required>
                        </td>
                    </tr>
                    <tr class="bg-gray-500 text-white text-sm border text-center" id="secondary-weight-row">
                        <td class="border px-4 py-2">Secondary Weight</td>
                        <td class="border px-4 py-2">
                            <input type="text" name="secondary_weight" class="text-black px-2 py-1 rounded-md" required>
                        </td>
                    </tr>                    
                </tbody>
            </table>
        </div>
        <div class="flex justify-center my-4">
            <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium mx-auto">
                <thead>
                    <tr class="bg-gray-700 text-sm text-white text-center">
                        <th class="border px-4 py-2">Alternative Id</th>
                        <th class="border px-4 py-2">Alternative Name</th>
                        <th class="border px-4 py-2">Pick</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($total_alternative as $alternative)
                        <tr class="bg-gray-500 text-white text-sm border text-center">
                            <td class="border px-4 py-2">{{$alternative->alternative_id}}</td>
                            <td class="border px-4 py-2">
                                <span id="name-{{$alternative->alternative_id}}">
                                    {{$alternative->alternative_name}}
                                </span>
                            </td>
                            <td class="border px-4 py-2">
                                <input type="checkbox" name="alternatives[]" value="{{$alternative->alternative_id}}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <div class="flex justify-center mt-4">
            <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium mx-auto">
                <thead>
                    <tr class="bg-gray-700 text-sm text-white text-center">
                        <th class="border px-4 py-2">Criteria Id</th>
                        <th class="border px-4 py-2">Criteria Name</th>
                        <th class="border px-4 py-2">Criteria Status</th>
                        <th class="border px-4 py-2">Criteria Value</th>
                        <th class="border px-4 py-2">Pick</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($total_criteria as $criteria)
                        <tr class="bg-gray-500 text-white text-sm border text-center">
                            <td class="border px-4 py-2">{{$criteria->criteria_id}}</td>
                            <td class="border px-4 py-2">
                                <span id="name-{{$criteria->criteria_id}}">
                                    {{$criteria->criteria_name}}
                                </span>
                            </td>
                            <td class="border px-4 py-2">
                                <span id="status-{{$criteria->criteria_id}}">
                                    {{$criteria->criteria_status == 'b' ? 'Benefit' : 'Cost'}}
                                </span>
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" name="criteria_value[{{ $criteria->criteria_id }}]" class="text-black px-2 py-1 rounded-md" disabled>
                            </td>
                            <td class="border px-4 py-2">
                                <input type="checkbox" name="criteria[]" value="{{$criteria->criteria_id}}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <div class="flex justify-center mt-4">
                <button type="submit" class="rounded-md px-3 py-2 text-white text-sm bg-gray-500 hover:bg-gray-700">Mulai Hitung</button>
            </div>
        </form>
    </div> 

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const methodDropdown = document.getElementById('method-dropdown');
            const primaryWeightRow = document.getElementById('primary-weight-row');
            const secondaryWeightRow = document.getElementById('secondary-weight-row');
            const criteriaCheckboxes = document.querySelectorAll('input[name="criteria[]"]');
        
            function toggleWeightFields() {
                const selectedMethod = methodDropdown.options[methodDropdown.selectedIndex].text;
                if (selectedMethod !== 'PM') {
                    primaryWeightRow.innerHTML = '<td class="border px-4 py-2">Primary Weight</td><td class="border px-4 py-2">-</td>';
                    secondaryWeightRow.innerHTML = '<td class="border px-4 py-2">Secondary Weight</td><td class="border px-4 py-2">-</td>';
                } else {
                    primaryWeightRow.innerHTML = '<td class="border px-4 py-2">Primary Weight</td><td class="border px-4 py-2"><input type="text" name="primary_weight" class="text-black px-2 py-1 rounded-md" required></td>';
                    secondaryWeightRow.innerHTML = '<td class="border px-4 py-2">Secondary Weight</td><td class="border px-4 py-2"><input type="text" name="secondary_weight" class="text-black px-2 py-1 rounded-md" required></td>';
                }
            }
        
            methodDropdown.addEventListener('change', toggleWeightFields);
            toggleWeightFields();

            criteriaCheckboxes.forEach(checkbox => {
                const criteriaValueInput = checkbox.closest('tr').querySelector('input[name^="criteria_value"]');
                criteriaValueInput.disabled = !checkbox.checked;
                
                checkbox.addEventListener('change', function() {
                    if (checkbox.checked) {
                        criteriaValueInput.disabled = false;
                        criteriaValueInput.required = true;
                    } else {
                        criteriaValueInput.disabled = true;
                        criteriaValueInput.required = false;
                        criteriaValueInput.value = '';
                    }
                });
            });
        });
    </script>
    
</x-layout>
