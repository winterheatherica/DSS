<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="flex justify-center text-white text-center">
        <x-add href="/add_criteria">Tambah</x-add>
    </div>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Criteria Id</th>
                    <th class="border px-4 py-2">Criteria Name</th>
                    <th class="border px-4 py-2">Criteria Status</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($total_criteria as $criteria)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{$criteria['criteria_id']}}</td>
                        <td class="border px-4 py-2">
                            <span id="name-{{$criteria['criteria_id']}}">
                                {{$criteria['criteria_name']}}
                            </span>
                            <form id="form-name-{{$criteria['criteria_id']}}" action="/update_criteria_name" method="POST" class="hidden">
                                @csrf
                                <input type="hidden" name="criteria_id" value="{{$criteria['criteria_id']}}">
                                <input id="input-name-{{$criteria['criteria_id']}}" type="text" name="criteria_name" class="hidden bg-gray-300 text-black px-2 py-1 rounded-md">
                                <button type="submit" class="hidden">Save Name</button>
                            </form>
                        </td>
                        <td class="border px-4 py-2">
                            <span id="status-{{$criteria['criteria_id']}}">
                                {{$criteria['criteria_status'] == 'b' ? 'Benefit' : 'Cost'}}
                            </span>
                            <form id="form-status-{{$criteria['criteria_id']}}" action="/update_criteria_status" method="POST" class="hidden">
                                @csrf
                                <input type="hidden" name="criteria_id" value="{{$criteria['criteria_id']}}">
                                <label>
                                    <input type="radio" name="criteria_status" value="b" required {{ $criteria['criteria_status'] == 'b' ? 'checked' : '' }}> Benefit
                                </label>
                                <label class="ml-4">
                                    <input type="radio" name="criteria_status" value="c" required {{ $criteria['criteria_status'] == 'c' ? 'checked' : '' }}> Cost
                                </label>
                                <button type="submit" class="hidden">Save Status</button>
                            </form>
                        </td>
                        <td class="border px-4 py-2">
                            <div class="flex items-center justify-center space-x-4">
                                <x-editanddelete href="/criteria/{{$criteria['criteria_id']}}">Lihat Detail</x-editanddelete>
                                <x-editanddelete onclick="toggleEditName({{$criteria['criteria_id']}})" style="text-decoration: none; cursor: pointer;">Edit Name</x-editanddelete>
                                <x-editanddelete onclick="toggleEditStatus({{$criteria['criteria_id']}})" style="text-decoration: none; cursor: pointer;">Edit Status</x-editanddelete>
                                <x-editanddelete href="/about">Delete</x-editanddelete>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-center mt-4">
        {{ $total_criteria->links() }}
    </div>


    <script>
        function toggleEditName(criteriaId) {
            let nameElement = document.getElementById(`name-${criteriaId}`);
            let inputNameElement = document.getElementById(`input-name-${criteriaId}`);
            let formNameElement = document.getElementById(`form-name-${criteriaId}`);
            let buttonElement = event.target;

            if (buttonElement.innerText === 'Edit Name') {
                nameElement.classList.add('hidden');
                inputNameElement.classList.remove('hidden');
                inputNameElement.value = nameElement.innerText.trim();
                formNameElement.classList.remove('hidden');
                buttonElement.innerText = 'Save Name';
            } else {
                formNameElement.submit();
            }
        }

        function toggleEditStatus(criteriaId) {
            let statusElement = document.getElementById(`status-${criteriaId}`);
            let formStatusElement = document.getElementById(`form-status-${criteriaId}`);
            let buttonElement = event.target;

            if (buttonElement.innerText === 'Edit Status') {
                statusElement.classList.add('hidden');
                formStatusElement.classList.remove('hidden');
                buttonElement.innerText = 'Save Status';
            } else {
                formStatusElement.submit();
            }
        }
    </script>
</x-layout>
