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
                                    <option value="{{ $method->method_id }}"
                                        @if ($method->method_id == 5) selected @endif>
                                        {{ $method->method_name }}
                                    </option>
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

    <!-- Notification Modal for Positive Weights -->
    <div id="notificationModalPositive" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4 text-center">Notification</h2>
            <p class="mb-4 text-center">The weights have been adjusted to sum to 1.</p>
            <div class="flex justify-center">
                <button onclick="closeModal('notificationModalPositive')" class="px-4 py-2 bg-gray-500 text-white rounded-md text-sm hover:bg-gray-700">OK</button>
            </div>
        </div>
    </div>

    <!-- Notification Modal for Negative Weights -->
    <div id="notificationModalNegative" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4 text-center">Warning</h2>
            <p class="mb-4 text-center">Both weights must be positive.</p>
            <div class="flex justify-center">
                <button onclick="closeModal('notificationModalNegative')" class="px-4 py-2 bg-gray-500 text-white rounded-md text-sm hover:bg-gray-700">OK</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const methodDropdown = document.getElementById('method-dropdown');
            const primaryWeightRow = document.getElementById('primary-weight-row');
            const secondaryWeightRow = document.getElementById('secondary-weight-row');
            const criteriaCheckboxes = document.querySelectorAll('input[name="criteria[]"]');
            
            function toggleWeightFields() {
                const selectedMethod = methodDropdown.options[methodDropdown.selectedIndex].text;
                if (selectedMethod !== 'WASPAS') {
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const primaryWeightInput = document.querySelector("input[name='primary_weight']");
            const secondaryWeightInput = document.querySelector("input[name='secondary_weight']");
            const positiveModal = document.getElementById('notificationModalPositive');
            const negativeModal = document.getElementById('notificationModalNegative');

            function showModal(modal) {
                modal.classList.remove('hidden');
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                modal.classList.add('hidden');
            }

            function validateWeights() {
                const primaryWeight = parseFloat(primaryWeightInput.value);
                const secondaryWeight = parseFloat(secondaryWeightInput.value);

                if (isNaN(primaryWeight) || isNaN(secondaryWeight)) {
                    return; // If either input is not a number, do nothing.
                }

                if (primaryWeight < 0 || secondaryWeight < 0) {
                    showModal(negativeModal);
                    return;
                }

                const total = primaryWeight + secondaryWeight;

                if (total !== 1) {
                    const totalSementara = primaryWeight + secondaryWeight;
                    const newPrimaryWeight = primaryWeight / totalSementara;
                    const newSecondaryWeight = secondaryWeight / totalSementara;
                    
                    primaryWeightInput.value = newPrimaryWeight.toFixed(2);
                    secondaryWeightInput.value = newSecondaryWeight.toFixed(2);

                    showModal(positiveModal);
                }
            }

            primaryWeightInput.addEventListener("input", validateWeights);
            secondaryWeightInput.addEventListener("input", validateWeights);

            // Close modal on "OK" button click
            document.querySelector('#notificationModalPositive button').addEventListener('click', () => closeModal('notificationModalPositive'));
            document.querySelector('#notificationModalNegative button').addEventListener('click', () => closeModal('notificationModalNegative'));
        });
    </script>
    
</x-layout>
