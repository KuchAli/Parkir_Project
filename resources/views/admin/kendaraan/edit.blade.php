@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>Edit Data Alat</h5>
        </div>

        <div class="card-body m-5">
            <form action="{{ route('admin.tools.update', $tool->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Kategori --}}
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $tool->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nama Alat --}}
                <div class="mb-3">
                    <label class="form-label">Nama Alat</label>
                    <input type="text" name="tool_name"
                        class="form-control @error('tool_name') is-invalid @enderror"
                        value="{{ old('tool_name', $tool->tool_name) }}">
                    @error('tool_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Stok --}}
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stock"
                        class="form-control @error('stock') is-invalid @enderror"
                        value="{{ old('stock', $tool->stock) }}" min="0">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Catatan Kondisi --}}
                <div class="mb-3">
                    <label class="form-label">Catatan Kondisi</label>
                    <textarea name="condition_note"
                        class="form-control @error('condition_note') is-invalid @enderror"
                        rows="3">{{ old('condition_note', $tool->condition_note) }}</textarea>
                    @error('condition_note')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Aksi --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.tools.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button class="btn btn-outline-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
