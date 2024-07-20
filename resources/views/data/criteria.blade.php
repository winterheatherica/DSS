<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="flex justify-center text-white text-center">
        <x-add href="/add_criteria?page={{ request()->get('page', 1) }}">Tambah</x-add>
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
                                <input id="input-name-{{$criteria['criteria_id']}}" type="text" name="criteria_name" class="hidden bg-gray-300 text-black px-2 py-1 rounded-md" value="{{$criteria['criteria_name']}}">
                                <input type="hidden" name="page" value="{{ request()->get('page', 1) }}">
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
                                <input type="hidden" name="page" value="{{ request()->get('page', 1) }}">
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
                                <x-editanddelete href="/criteria/{{$criteria['criteria_id']}}?page={{ request()->get('page', 1) }}">Lihat Detail</x-editanddelete>
                                <x-editanddelete onclick="toggleEditName({{$criteria['criteria_id']}})" style="text-decoration: none; cursor: pointer;">Edit Name</x-editanddelete>
                                <x-editanddelete onclick="toggleEditStatus({{$criteria['criteria_id']}})" style="text-decoration: none; cursor: pointer;">Edit Status</x-editanddelete>
                                <x-editanddelete onclick="confirmDelete({{$criteria['criteria_id']}}, {{ request()->get('page', 1) }})" style="text-decoration: none; cursor: pointer;">Delete</x-editanddelete>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-center mt-4" style="text-decoration: none; cursor: pointer;">
        {{ $total_criteria->links() }}
    </div>

    <!-- Modal -->
    <div id="notificationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 id="modalTitle" class="text-xl font-bold mb-4 text-center">Konfirmasi Penghapusan</h2>
            <p id="modalMessage" class="mb-4 text-center">Apakah Anda yakin ingin menghapus kriteria ini?</p>
            <div class="flex justify-center">
                <div class="px-2">
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2 text-sm hover:bg-gray-700" style="text-decoration: none; cursor: pointer;">Hapus</button>
                    </form>
                </div>
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2 text-sm hover:bg-gray-700" style="text-decoration: none; cursor: pointer;">Batal</button>
            </div>
        </div>
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

        function confirmDelete(criteriaId, currentPage) {
            const modal = document.getElementById('notificationModal');
            const deleteForm = document.getElementById('deleteForm');

            deleteForm.action = `/criteria/${criteriaId}`;
            modal.classList.remove('hidden');

            const pageInput = document.createElement('input');
            pageInput.type = 'hidden';
            pageInput.name = 'page';
            pageInput.value = currentPage;

            deleteForm.appendChild(pageInput);
        }

        function closeModal() {
            const modal = document.getElementById('notificationModal');
            modal.classList.add('hidden');
        }
    </script>

</x-layout>