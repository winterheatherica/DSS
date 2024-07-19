<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="flex justify-center text-white text-center">
        <x-add href="/add_alternative">Tambah</x-add>
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
                            </form>
                        </td>
                        <td class="border px-4 py-2">
                            <div class="flex items-center">
                                <div class="hidden md:block">
                                    <div class="flex items-baseline space-x-4">
                                        <x-editanddelete href="/alternative/{{$alternative['alternative_id']}}">Lihat Detail</x-editanddelete>
                                        <x-editanddelete onclick="toggleEdit({{$alternative['alternative_id']}})" style="text-decoration: none; cursor: pointer;">Edit</x-editanddelete>
                                        <x-editanddelete href="/about">Delete</x-editanddelete>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-center mt-4">
        {{ $total_alternative->links() }}
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
    </script>

</x-layout>
