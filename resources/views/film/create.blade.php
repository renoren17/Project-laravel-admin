@extends('layouts.master')

@section('title', 'Tambah Film')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <form action="{{ route('film.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="judul">Judul Film</label>
            <input name="judul" type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" placeholder="Judul Film" value="{{ old('judul') }}">
            @error('judul')
              <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="ringkasan">Ringkasan</label>
            <textarea name="ringkasan" class="form-control @error('ringkasan') is-invalid @enderror" id="ringkasan" placeholder="Ringkasan">{{ old('ringkasan') }}</textarea>
            @error('ringkasan')
              <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="tahun">Tahun</label>
            <input name="tahun" type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" placeholder="Tahun" value="{{ old('tahun') }}">
            @error('tahun')
              <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="poster">Poster</label>
            <div class="custom-file">
              <input name="poster" type="file" accept="image/*" class="custom-file-input @error('poster') is-invalid @enderror" id="poster">
              <label class="custom-file-label" for="poster">Pilih file...</label>
              @error('poster')
                <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-group">
            <label>Genre</label>
            <div class="border rounded p-2 @error('genre_id') is-invalid @enderror" style="max-height: 160px; overflow-y: auto;">
                @foreach ($genres as $genre)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="genre_id[]" value="{{ $genre->id }}"
                    id="genre_{{ $genre->id }}"
                    {{ collect(old('genre_id'))->contains($genre->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="genre_{{ $genre->id }}">
                    {{ $genre->nama }}
                    </label>
                </div>
                @endforeach
            </div>
            @error('genre_id')
                <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label>Cast</label>
            <div class="border rounded p-2 @error('cast_id') is-invalid @enderror" style="max-height: 200px; overflow-y: auto;">
                @foreach ($casts as $cast)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="cast_id[]" value="{{ $cast->id }}"
                    id="cast_{{ $cast->id }}"
                    {{ collect(old('cast_id'))->contains($cast->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="cast_{{ $cast->id }}">
                    {{ $cast->nama }}
                    </label>
                </div>
                @endforeach
            </div>
            @error('cast_id')
                <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
            @enderror
          </div>
        <div class="px-3 d-flex justify-content-between align-items-center">
          <button type="reset" class="btn btn-warning">Reset</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('js')
<script>
  $(document).ready(function () {
    $('.custom-file-input').on('change', function () {
      let fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').html(fileName || 'Pilih file...');
    });
  });
</script>
@endpush
@endsection