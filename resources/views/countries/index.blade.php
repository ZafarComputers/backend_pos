{{-- With AJAX --}}
@extends('layouts.app')

@section('title','Countries')

@section('content')
<div x-data="{ open: false, editMode: false, countryId: null }">

    <!-- Header -->
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Countries</h2>
        <button @click="open=true; editMode=false;" class="px-4 py-2 bg-blue-600 text-white rounded">+ Add Country</button>
    </div>

    <!-- Table -->
    <table class="min-w-full bg-white rounded shadow">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Code</th>
                <th class="px-4 py-2">Currency</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody id="countryTable">
            @foreach($countries as $country)
            <tr class="border-b" id="row-{{ $country->id }}">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $country->title }}</td>
                <td class="px-4 py-2">{{ $country->code }}</td>
                <td class="px-4 py-2">{{ $country->currency }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded {{ $country->status=='active'?'bg-green-500 text-white':'bg-red-500 text-white' }}">
                        {{ ucfirst($country->status) }}
                    </span>
                </td>
                <td class="px-4 py-2 space-x-2">
                    <button 
                        @click="open=true; editMode=true; countryId={{ $country->id }}; 
                                $refs.title.value='{{ $country->title }}'; 
                                $refs.code.value='{{ $country->code }}'; 
                                $refs.currency.value='{{ $country->currency }}'; 
                                $refs.status.value='{{ $country->status }}';"
                        class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</button>
                    <button onclick="deleteCountry({{ $country->id }})" 
                        class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg w-96">
            <h2 class="text-lg font-bold mb-4" x-text="editMode ? 'Edit Country' : 'Add Country'"></h2>
            <form id="countryForm">
                @csrf
                <input type="hidden" name="_method" x-bind:value="editMode ? 'PUT' : 'POST'">

                <div class="mb-3">
                    <label class="block text-sm">Title</label>
                    <input x-ref="title" name="title" class="w-full border px-2 py-1 rounded">
                </div>
                <div class="mb-3">
                    <label class="block text-sm">Code</label>
                    <input x-ref="code" name="code" class="w-full border px-2 py-1 rounded">
                </div>
                <div class="mb-3">
                    <label class="block text-sm">Currency</label>
                    <input x-ref="currency" name="currency" class="w-full border px-2 py-1 rounded">
                </div>
                <div class="mb-3">
                    <label class="block text-sm">Status</label>
                    <select x-ref="status" name="status" class="w-full border px-2 py-1 rounded">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" @click="open=false" class="px-3 py-1 bg-gray-400 text-white rounded">Cancel</button>
                    <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('countryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let form = e.target;
    let formData = new FormData(form);
    let method = formData.get('_method');
    let url = '/countries' + (method === 'PUT' ? '/' + Alpine.store('countryId') : '');

    fetch(url, {
        method: method === 'PUT' ? 'POST' : 'POST',
        headers: {'X-CSRF-TOKEN': formData.get('_token')},
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            location.reload(); // simplest refresh
        }
    });
});

function deleteCountry(id) {
    if(!confirm('Delete this country?')) return;
    fetch('/countries/' + id, {
        method: 'DELETE',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            document.getElementById('row-'+id).remove();
        }
    });
}
</script>
@endsection





{{-- With out AJAX --}}
{{-- @extends('layouts.app')

@section('title','Countries')

@section('content')
<div class="flex justify-between mb-4">
    <h2 class="text-xl font-bold">Countries</h2>
    <a href="{{ route('countries.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Add Country</a>
</div>

<table class="min-w-full bg-white rounded shadow">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Code</th>
            <th class="px-4 py-2">Currency</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($countries as $country)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $loop->iteration }}</td>
            <td class="px-4 py-2">{{ $country->title }}</td>
            <td class="px-4 py-2">{{ $country->code }}</td>
            <td class="px-4 py-2">{{ $country->currency }}</td>
            <td class="px-4 py-2">
                <span class="px-2 py-1 rounded {{ $country->status=='active'?'bg-green-500 text-white':'bg-red-500 text-white' }}">
                    {{ ucfirst($country->status) }}
                </span>
            </td>
            <td class="px-4 py-2">
                <a href="{{ route('countries.edit',$country) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                <form action="{{ route('countries.destroy',$country) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this country?')">
                    @csrf @method('DELETE')
                    <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection --}}
