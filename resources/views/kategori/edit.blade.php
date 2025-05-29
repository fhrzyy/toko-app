@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Kategori</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('kategori.update', $kategori) }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input id="nama" type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" required class="border rounded w-full p-2 @error('nama') border-red-500 @enderror">
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
        </div>
    </form>
</div>
@endsection