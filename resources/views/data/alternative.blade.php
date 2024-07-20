<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="flex justify-center text-white text-center">
        <x-add href="/add_alternative?page={{ request()->get('page', 1) }}">Tambah</x-add>
    </div>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Alternative Id</th>
                    <th class="border px-4 py-2">Alternative Name</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($total_alternative as $alternative)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{$alternative['alternative_id']}}</td>
                        <td class="border px-4 py-2">
                            <span id="name-{{$alternative['alternative_id']}}">
                                {{$alternative['alternative_name']}}
                            </span>
                            <form id="form-{{$alternative['alternative_id']}}" action="/update_alternative" method="POST" class="hidden">
                                @csrf
                                <input type="hidden" name="alternative_id" value="{{$alternative['alternative_id']}}">
                                <input id="input-{{$alternative['alternative_id']}}" type="text" name="alternative_name" class="hidden bg-gray-300 text-black px-2 py-1 rounded-md">
                                <input type="hidden" name="page" value="{{ request()->get('page', 1) }}">
                            </form>                            
                        </td>
                        <td class="border px-4 py-2">
                            <div class="flex items-center">
                                <div class="hidden md:block">
                                    <div class="flex items-baseline space-x-4">
                                        <x-editanddelete href="/alternative/{{$alternative['alternative_id']}}?page={{ request()->get('page', 1) }}">Lihat Detail</x-editanddelete>
                                        <x-editanddelete onclick="toggleEdit({{$alternative['alternative_id']}})" style="text-decoration: none; cursor: pointer;">Edit</x-editanddelete>
                                        <x-editanddelete onclick="confirmDelete({{$alternative['alternative_id']}}, {{ request()->get('page', 1) }})" style="text-decoration: none; cursor: pointer;">Delete</x-editanddelete>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-center mt-4" style="text-decoration: none; cursor: pointer;">
        {{ $total_alternative->links() }}
    </div>

    <!-- Modal -->
    <div id="notificationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 id="modalTitle" class="text-xl font-bold mb-4 text-center">Konfirmasi Penghapusan</h2>
            <p id="modalMessage" class="mb-4 text-center">Apakah Anda yakin ingin menghapus alternatif ini?</p>
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
        function toggleEdit(alternativeId) {
            let nameElement = document.getElementById(`name-${alternativeId}`);
            let inputElement = document.getElementById(`input-${alternativeId}`);
            let formElement = document.getElementById(`form-${alternativeId}`);
            let buttonElement = event.target;

            if (buttonElement.innerText === 'Edit') {
                nameElement.classList.add('hidden');
                inputElement.classList.remove('hidden');
                inputElement.value = nameElement.innerText.trim();
                formElement.classList.remove('hidden');
                buttonElement.innerText = 'Save';
            } else {
                formElement.submit();
            }
        }

        function confirmDelete(alternativeId, currentPage) {
            const modal = document.getElementById('notificationModal');
            const deleteForm = document.getElementById('deleteForm');

            deleteForm.action = `/alternative/${alternativeId}`;
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
