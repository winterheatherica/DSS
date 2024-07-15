<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="flex justify-center text-white text-center">
        <x-add href="/alternative">Kembali</x-add>
    </div>

    <div class="my-8 flex justify-center">
        <form method="POST" action="/add_alternative">
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
                        <td class="border px-4 py-2">Alternative Name</td>
                        <td class="border px-4 py-2">
                            <input type="text" name="alternative_name" class="text-black px-2 py-1 rounded-md" required>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-center text-white text-center mt-4">
                <button type="submit" class="rounded-md px-3 py-2 text-sm bg-gray-500 hover:bg-gray-700">Tambah</button>
            </div>
        </form>
    </div>

    <div id="notificationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 id="modalTitle" class="text-xl font-bold mb-4"></h2>
            <p id="modalMessage" class="mb-4"></p>
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded-md">Tutup</button>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showModal('Sukses', '{{ session('success') }}');
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showModal('Gagal', 'Terjadi kesalahan saat menambahkan data.');
            });
        </script>
    @endif

    <script>
        function showModal(title, message) {
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalMessage').innerText = message;
            document.getElementById('notificationModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('notificationModal').classList.add('hidden');
        }
    </script>
</x-layout>
