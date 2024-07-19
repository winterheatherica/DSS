<x-layout>
    <x-slot:title>Calculation</x-slot:title>

    <div class="my-8 flex justify-center">
        <form method="POST" action="/">
            @csrf
            <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
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
            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md">Submit</button>
        </form>
    </div>

    <div class="my-8 flex justify-center">
        <div class="grid grid-cols-2 gap-8 max-w-screen-lg">
            <div>
                <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
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

            <div>
                <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
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
                                    <input type="text" name="criteria_value" class="text-black px-2 py-1 rounded-md">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="checkbox" name="criteria[]" value="{{$criteria->criteria_id}}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="flex justify-center text-white text-center mt-4">
        <button type="submit" class="rounded-md px-3 py-2 text-sm bg-gray-500 hover:bg-gray-700">Mulai Hitung</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const methodDropdown = document.getElementById('method-dropdown');
            const primaryWeightRow = document.getElementById('primary-weight-row');
            const secondaryWeightRow = document.getElementById('secondary-weight-row');
        
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
        });
    </script>

</x-layout>



ini adalah final nya, secara layout sudah benar namun saya ingin menambah logic,

-- Tabel tb_alternative_proportion
CREATE TABLE tb_alternative_proportion (
    history_id NUMBER,
    alternative_id NUMBER,
    final_score NUMBER,
    final_rank NUMBER,
    CONSTRAINT fk_tb_alternative_proportion_history_id_tb_history FOREIGN KEY (history_id) REFERENCES tb_history(history_id),
    CONSTRAINT fk_tb_alternative_proportion_alternative_id_tb_alternative FOREIGN KEY (alternative_id) REFERENCES tb_alternative(alternative_id),
    PRIMARY KEY (history_id, alternative_id)
);

-- Tabel tb_criteria_proportion
CREATE TABLE tb_criteria_proportion (
    history_id NUMBER,
    criteria_id NUMBER,
    criteria_value NUMBER,
    criteria_priority VARCHAR2(1) NULL,
    CONSTRAINT fk_tb_criteria_proportion_history_id_tb_history FOREIGN KEY (history_id) REFERENCES tb_history(history_id),
    CONSTRAINT fk_tb_criteria_proportion_criteria_id_tb_criteria FOREIGN KEY (criteria_id) REFERENCES tb_criteria(criteria_id),
    PRIMARY KEY (history_id, criteria_id)
);

-- Tabel tb_history
CREATE TABLE tb_history (
    history_id NUMBER PRIMARY KEY,
    method_id NUMBER,
    user_id NUMBER,
    case_name VARCHAR2(100),
    primary_weight NUMBER NULL,
    secondary_weight NUMBER NULL,
    CONSTRAINT fk_tb_history_method_id_tb_method FOREIGN KEY (method_id) REFERENCES tb_method(method_id),
    CONSTRAINT fk_tb_history_user_id_tb_user FOREIGN KEY (user_id) REFERENCES tb_user(user_id)
);

ketika button "Mulai Hitung" di klik maka akan otomatis menambah ke database
ke 3 tabel yaitu tb_history, tb_criteria_proportion dan tb_alternative_proportion

1. tb_history
history_id auto increment
method_id sesuai method_id yang dipilih
user_id anggap saja selalu user_id = 1
case_name sesuai field text Case
primary dan secondary sesuai text field, dan kalau value nya '-' anggap saja NULL

tb_alternative_proportion
history_id sama seperti history_id yang baru
alternative_id sesuai seluruh alternative yang di checkbox
final_score dan final_rank biarkan NULL dlu

tb_criteria_proportion
history_id sama seperti history_id yang baru
criteria_id sesuai seluruh criteria yang di checkbox
criteria_value sesuai seluruh text field yang di checkbox

intinya anda hanya menambahkan ke history apa yang telah di checkbox ke tb_history