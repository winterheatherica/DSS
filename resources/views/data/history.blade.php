<x-layout>
    <x-slot:title>History List</x-slot:title>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">History Id</th>
                    <th class="border px-4 py-2">Method</th>
                    <th class="border px-4 py-2">Creator</th>
                    <th class="border px-4 py-2">Case</th>
                    <th class="border px-4 py-2">WSM</th>
                    <th class="border px-4 py-2">WPM</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $detailed_history)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{ $detailed_history->history_id }}</td>
                        <td class="border px-4 py-2">{{ $detailed_history->method->method_name }}</td>
                        <td class="border px-4 py-2">{{ $detailed_history->table_user->username }}</td>
                        <td class="border px-4 py-2">{{ $detailed_history->case_name }}</td>
                        <td class="border px-4 py-2">{{ $detailed_history->primary_weight ?? 'Tidak Ada' }}</td>
                        <td class="border px-4 py-2">{{ $detailed_history->secondary_weight ?? 'Tidak Ada' }}</td>
                        <td class="border px-4 py-2">
                            <div class="flex items-center">
                                <div class="hidden md:block">
                                    <div class="flex items-baseline space-x-4">
                                        <x-editanddelete href="/history/{{ $detailed_history->history_id }}">Lihat Detail</x-editanddelete>
                                        <x-editanddelete href="{{ route('history.editshow', ['history_id' => $detailed_history->history_id]) }}">Edit</x-editanddelete>
                                        <x-editanddelete href="javascript:void(0);" onclick="confirmCopy('{{ route('history.copy', ['history_id' => $detailed_history->history_id]) }}')">Copy</x-editanddelete>
                                        <x-editanddelete href="javascript:void(0);" onclick="confirmDeletion('{{ route('history.destroy', ['history_id' => $detailed_history->history_id]) }}')">Delete</x-editanddelete>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for Deletion Confirmation -->
    <div id="notificationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 id="modalTitle" class="text-xl font-bold mb-4 text-center">Konfirmasi Penghapusan</h2>
            <p id="modalMessage" class="mb-4 text-center">Apakah Anda yakin ingin menghapus history ini?</p>
            <div class="flex justify-center">
                <div class="px-2">
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2 text-sm hover:bg-gray-700">Hapus</button>
                    </form>
                </div>
                <button onclick="closeModal('notificationModal')" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2 text-sm hover:bg-gray-700">Batal</button>
            </div>
        </div>
    </div>

    <!-- Modal for Copy Confirmation -->
    <div id="copyModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4 text-center">Konfirmasi Penyalinan</h2>
            <p class="mb-4 text-center">Apakah Anda yakin ingin menyalin history ini?</p>
            <div class="flex justify-center">
                <div class="px-2">
                    <form id="copyForm" action="" method="GET">
                        <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2 text-sm hover:bg-gray-700">Copy</button>
                    </form>
                </div>
                <button onclick="closeModal('copyModal')" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2 text-sm hover:bg-gray-700">Batal</button>
            </div>
        </div>
    </div>

    <script>
        function confirmCopy(actionUrl) {
            document.getElementById('copyForm').action = actionUrl;
            document.getElementById('copyModal').classList.remove('hidden');
        }

        function confirmDeletion(actionUrl) {
            document.getElementById('deleteForm').action = actionUrl;
            document.getElementById('notificationModal').classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
    
</x-layout>
