<x-layout>
    <x-slot:title>{{ $detailed_history->method->method_name}} : {{ $detailed_history->case_name }} - {{ $detailed_history->table_user->username}}</x-slot:title>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">History Id</th>
                    <th class="border px-4 py-2">Method</th>
                    <th class="border px-4 py-2">Creator</th>
                    <th class="border px-4 py-2">Case Name</th>
                    <th class="border px-4 py-2">Primary Weight</th>
                    <th class="border px-4 py-2">Secondary Weight</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-gray-500 text-white text-sm border text-center">
                    <td class="border px-4 py-2">{{ $detailed_history->history_id}}</td>
                    <td class="border px-4 py-2">{{ $detailed_history->method->method_name}}</td>
                    <td class="border px-4 py-2">{{ $detailed_history->table_user->username}}</td>
                    <td class="border px-4 py-2">{{ $detailed_history->case_name }}</td>
                    <td class="border px-4 py-2">{{ $detailed_history->primary_weight ?? 'Tidak Ada' }}</td>
                    <td class="border px-4 py-2">{{ $detailed_history->secondary_weight ?? 'Tidak Ada' }}</td>
                    <td class="border px-4 py-2">
                        <div class="flex items-center">
                            <div class="hidden md:block">
                                <div class="flex items-baseline space-x-4">
                                    <x-editanddelete href="/history">Back</x-editanddelete>
                                    <x-editanddelete href="{{ route('history.editshow', ['history_id' => $detailed_history->history_id]) }}">Edit</x-editanddelete>
                                    <x-editanddelete href="javascript:void(0);" onclick="confirmCopy('{{ route('history.copy', ['history_id' => $detailed_history->history_id]) }}')">Copy</x-editanddelete>
                                    <x-editanddelete href="javascript:void(0);" onclick="confirmDeletion('{{ route('history.destroy', ['history_id' => $detailed_history->history_id]) }}')">Delete</x-editanddelete>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8 flex justify-center">
        <div class="grid grid-cols-2 max-w-screen-lg">
            <div>
                <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
                    <thead>
                        <tr class="bg-gray-700 text-sm text-white text-center">
                            <th class="border px-4 py-2" colspan="2">Data Alternative</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr class="bg-gray-700 text-sm text-white text-center">
                            <th class="border px-4 py-2">Alternative ID</th>
                            <th class="border px-4 py-2">Alternative Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternative_proportions as $data)
                            <tr class="bg-gray-500 text-white text-sm border text-center">
                                <td class="border px-4 py-2">{{ $data->alternative_id }}</td>
                                <td class="border px-4 py-2">{{ $data->alternative->alternative_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div>
                <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
                    <thead>
                        <tr class="bg-gray-700 text-sm text-white text-center">
                            <th class="border px-4 py-2" colspan="4">Data Criteria</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr class="bg-gray-700 text-sm text-white text-center">
                            <th class="border px-4 py-2">Criteria ID</th>
                            <th class="border px-4 py-2">Criteria Name</th>
                            <th class="border px-4 py-2">Criteria Status</th>
                            <th class="border px-4 py-2">Criteria Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($criteria_proportions as $index => $data)
                            <tr class="bg-gray-500 text-white text-sm border text-center">
                                <td class="border px-4 py-2">{{ $data->criteria_id }}</td>
                                <td class="border px-4 py-2">{{ $data->criteria->criteria_name }}</td>
                                <td class="border px-4 py-2">
                                    @if ($data->criteria->criteria_status === 'b')
                                        Benefit
                                    @elseif ($data->criteria->criteria_status === 'c')
                                        Cost
                                    @else
                                        {{ $data->criteria->criteria_status }}
                                    @endif
                                </td>
                                <td class="border px-4 py-2">{{ $data->criteria_value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="my-8 flex justify-center">
        <div>
            <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
                <thead>
                    <tr class="bg-gray-700 text-sm text-white text-center">
                        <th class="border px-4 py-2" colspan="4">Data Criteria Normalisasi  </th>
                    </tr>
                </thead>
                <thead>
                    <tr class="bg-gray-700 text-sm text-white text-center">
                        <th class="border px-4 py-2">Criteria ID</th>
                        <th class="border px-4 py-2">Criteria Name</th>
                        <th class="border px-4 py-2">Criteria Status</th>
                        <th class="border px-4 py-2">Criteria Value Normalisasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($criteria_proportions as $index => $data)
                        <tr class="bg-gray-500 text-white text-sm border text-center">
                            <td class="border px-4 py-2">{{ $data->criteria_id }}</td>
                            <td class="border px-4 py-2">{{ $data->criteria->criteria_name }}</td>
                            <td class="border px-4 py-2">
                                @if ($data->criteria->criteria_status === 'b')
                                    Benefit
                                @elseif ($data->criteria->criteria_status === 'c')
                                    Cost
                                @else
                                    {{ $data->criteria->criteria_status }}
                                @endif
                            </td>
                            <td class="border px-4 py-2">{{ number_format($arr4[$index], 5) }}</td>
                        </tr>
                    @endforeach
                </tbody>            
            </table>
        </div>
    </div>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2" colspan="{{ 1 + count($criteria_proportions) }}">Tabel Pemetaan Alternative Criteria</th>
                </tr>
            </thead>
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Alternative Name</th>
                    @foreach ($criteria_proportions as $criteria)
                        <th class="border px-4 py-2">{{ $criteria->criteria->criteria_name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($alternative_proportions as $alternative)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{ $alternative->alternative->alternative_name }}</td>
                        @foreach ($criteria_proportions as $criteria)
                            <td class="border px-4 py-2">
                                @php
                                    $alternative_criteria = \App\Models\Alternative_Criteria::where('alternative_id', $alternative->alternative_id)
                                        ->where('criteria_id', $criteria->criteria_id)
                                        ->first();
                                @endphp
                                {{ $alternative_criteria ? $alternative_criteria->alternative_criteria_value : '-' }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2" colspan="{{ 1 + count($criteria_proportions) }}">Tabel Normalisasi Alternative Criteria</th>
                </tr>
            </thead>
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Alternative Name</th>
                    @foreach ($criteria_proportions as $criteria)
                        <th class="border px-4 py-2">{{ $criteria->criteria->criteria_name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($alternative_proportions as $i => $alternative)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{ $alternative->alternative->alternative_name }}</td>
                        @foreach ($criteria_proportions as $j => $criteria)
                            <td class="border px-4 py-2">
                                {{ isset($arr3[$i][$j]) ? number_format($arr3[$i][$j], 8) : '-' }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2" colspan="{{ 1 + count($criteria_proportions) }}">Normalisasi Criteria * Alternative Criteria</th>
                </tr>
            </thead>
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Alternative Name</th>
                    @foreach ($criteria_proportions as $criteria)
                        <th class="border px-4 py-2">{{ $criteria->criteria->criteria_name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($alternative_proportions as $i => $alternative)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{ $alternative->alternative->alternative_name }}</td>
                        @foreach ($criteria_proportions as $j => $criteria)
                            <td class="border px-4 py-2">
                                {{ isset($arr5[$i][$j]) ? number_format($arr5[$i][$j], 8) : '-' }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2" colspan="2">Hasil Penjumlahan Tabel Sebelumnya</th>
                </tr>
            </thead>
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Alternative Name</th>
                    <th class="border px-4 py-2">SAW</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alternative_proportions as $index => $alternative)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{ $alternative->alternative->alternative_name }}</td>
                        <td class="border px-4 py-2">{{ $SAW[$index] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2" colspan="{{ 1 + count($criteria_proportions) }}">Alternative Criteria ^ Normalisasi Criteria</th>
                </tr>
            </thead>
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Alternative Name</th>
                    @foreach ($criteria_proportions as $criteria)
                        <th class="border px-4 py-2">{{ $criteria->criteria->criteria_name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($alternative_proportions as $i => $alternative)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{ $alternative->alternative->alternative_name }}</td>
                        @foreach ($criteria_proportions as $j => $criteria)
                            <td class="border px-4 py-2">
                                {{ isset($arr6[$i][$j]) ? number_format($arr6[$i][$j], 8) : '-' }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2" colspan="2">Hasil Perkalian Tabel Sebelumnya</th>
                </tr>
            </thead>
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Alternative Name</th>
                    <th class="border px-4 py-2">WP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alternative_proportions as $index => $alternative)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{ $alternative->alternative->alternative_name }}</td>
                        <td class="border px-4 py-2">{{ $WP[$index] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="my-8 flex justify-center">
        <table class="table-auto bg-gray-700 shadow-lg rounded-md font-medium">
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2" colspan="7">Tabel Hasil Akhir</th>
                </tr>
            </thead>
            <thead>
                <tr class="bg-gray-700 text-sm text-white text-center">
                    <th class="border px-4 py-2">Alternative Name</th>
                    <th class="border px-4 py-2">SAW * {{ $detailed_history->primary_weight }}</th>
                    <th class="border px-4 py-2">+</th>
                    <th class="border px-4 py-2">WP * {{ $detailed_history->secondary_weight }}</th>
                    <th class="border px-4 py-2">=</th>
                    <th class="border px-4 py-2">WASPAS</th>
                    <th class="border px-4 py-2">Rank</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alternative_proportions as $index => $alternative)
                    <tr class="bg-gray-500 text-white text-sm border text-center">
                        <td class="border px-4 py-2">{{ $alternative->alternative->alternative_name }}</td>
                        <td class="border px-4 py-2">{{ $SAW[$index] * $detailed_history->primary_weight }}</td>
                        <td class="border px-4 py-2">+</td>
                        <td class="border px-4 py-2">{{ $WP[$index] * $detailed_history->secondary_weight }}</td>
                        <td class="border px-4 py-2">=</td>
                        <td class="border px-4 py-2">{{ $WASPAS[$index] }}</td>
                        <td class="border px-4 py-2">{{ $final_rank[$index] }}</td>
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
