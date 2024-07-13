@props(['active' => false])
<a {{$attributes}} class="rounded-md px-3 py-2 text-sm font-medium {{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}" {{ $active ? 'aria-current="page"' : false }}>{{$slot}}</a>
