@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Pembeli</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pembeli.store') }}" class="space-y-4">
        @csrf
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Pembeli</label>
            <input id="nama" type="text" name="nama" value="{{ old('nama') }}" required class="border rounded w-full p-2 @error('nama') border-red-500 @enderror">
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required class="border rounded w-full p-2 @error('jenis_kelamin') border-red-500 @enderror">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
            <input id="alamat" type="text" name="alamat" value="{{ old('alamat') }}" required class="border rounded w-full p-2 @error('alamat') border-red-500 @enderror">
            @error('alamat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP</label>
            <input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp') }}" required class="border rounded w-full p-2 @error('no_hp') border-red-500 @enderror">
            @error('no_hp')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
        </div>
    </form>
</div>
@endsection