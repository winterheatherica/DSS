<x-layout>
    <x-slot:title>Edit History -> {{ $detailed_history->method->method_name }} : {{ $detailed_history->case_name }} - {{ $detailed_history->table_user->username }}</x-slot:title>

    <div class="flex justify-center text-white text-center">
        <x-add href="/history">Back</x-add>
    </div>

    <div class="my-8 flex justify-center">
        <form method="POST" action="{{ route('history.update', ['history_id' => $detailed_history->history_id]) }}">
            @csrf
            @method('PUT')
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
                            <td class="border px-4 py-2">History ID</td>
                            <td class="border px-4 py-2">
                                <input type="text" name="history_id" value="{{ $detailed_history->history_id }}" class="text-black px-2 py-1 rounded-md" disabled>
                            </td>
                        </tr>
                        <tr class="bg-gray-500 text-white text-sm border text-center">
                            <td class="border px-4 py-2">Method</td>
                            <td class="border px-4 py-2">
                                <select id="method-dropdown" name="method_id" class="text-black px-2 py-1 rounded-md" required>
                                    @foreach ($methods as $method)
                                        <option value="{{ $method->method_id }}" {{ $detailed_history->method_id == $method->method_id ? 'selected' : '' }}>
                                            {{ $method->method_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr class="bg-gray-500 text-white text-sm border text-center">
                            <td class="border px-4 py-2">Case Name</td>
                            <td class="border px-4 py-2">
                                <input type="text" name="case_name" value="{{ $detailed_history->case_name }}" class="text-black px-2 py-1 rounded-md" required>
                            </td>
                        </tr>
                        <tr class="bg-gray-500 text-white text-sm border text-center" id="primary-weight-row">
                            <td class="border px-4 py-2">Primary Weight</td>
                            <td class="border px-4 py-2">
                                <input type="text" name="primary_weight" value="{{ $detailed_history->primary_weight }}" class="text-black px-2 py-1 rounded-md" required>
                            </td>
                        </tr>
                        <tr class="bg-gray-500 text-white text-sm border text-center" id="secondary-weight-row">
                            <td class="border px-4 py-2">Secondary Weight</td>
                            <td class="border px-4 py-2">
                                <input type="text" name="secondary_weight" value="{{ $detailed_history->secondary_weight }}" class="text-black px-2 py-1 rounded-md" required>
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
                                <td class="border px-4 py-2">{{ $alternative->alternative_id }}</td>
                                <td class="border px-4 py-2">
                                    <span id="name-{{ $alternative->alternative_id }}">
                                        {{ $alternative->alternative_name }}
                                    </span>
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="checkbox" name="alternatives[]" value="{{ $alternative->alternative_id }}" {{ $detailed_history->alternative_proportions->contains('alternative_id', $alternative->alternative_id) ? 'checked' : '' }}>
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
                                <td class="border px-4 py-2">{{ $criteria->criteria_id }}</td>
                                <td class="border px-4 py-2">
                                    <span id="name-{{ $criteria->criteria_id }}">
                                        {{ $criteria->criteria_name }}
                                    </span>
                                </td>
                                <td class="border px-4 py-2">
                                    <span id="status-{{ $criteria->criteria_id }}">
                                        {{ $criteria->criteria_status == 'b' ? 'Benefit' : 'Cost' }}
                                    </span>
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="text" name="criteria_value[{{ $criteria->criteria_id }}]" value="{{ optional($detailed_history->criteria_proportions->firstWhere('criteria_id', $criteria->criteria_id))->criteria_value }}" class="text-black px-2 py-1 rounded-md" {{ $detailed_history->criteria_proportions->contains('criteria_id', $criteria->criteria_id) ? '' : 'disabled' }}>
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="checkbox" name="criteria[]" value="{{ $criteria->criteria_id }}" {{ $detailed_history->criteria_proportions->contains('criteria_id', $criteria->criteria_id) ? 'checked' : '' }}>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-center mt-4">
                <button type="submit" class="rounded-md px-3 py-2 text-white text-sm bg-gray-500 hover:bg-gray-700">Update</button>
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

            criteriaCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const inputField = document.querySelector(`input[name="criteria_value[${this.value}]"]`);
                    inputField.disabled = !this.checked;
                });
            });
        });
    </script>
</x-layout>
