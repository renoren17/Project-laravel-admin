@extends('layouts.master')

@section('title', 'Edit Film')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            <form
                action="{{ route('film.update', $film->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- JUDUL --}}
                    <div class="form-group">
                        <label for="judul">Judul Film</label>

                        <input
                            name="judul"
                            type="text"
                            class="form-control @error('judul') is-invalid @enderror"
                            id="judul"
                            placeholder="Judul Film"
                            value="{{ old('judul', $film->judul) }}"
                        >

                        @error('judul')
                            <span class="error invalid-feedback" style="display: inline;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- TAHUN --}}
                    <div class="form-group">
                        <label for="tahun">Tahun</label>

                        <input
                            name="tahun"
                            type="number"
                            class="form-control @error('tahun') is-invalid @enderror"
                            id="tahun"
                            placeholder="Tahun"
                            value="{{ old('tahun', $film->tahun) }}"
                        >

                        @error('tahun')
                            <span class="error invalid-feedback" style="display: inline;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- GENRE --}}
                    <div class="form-group">
                        <label>Genre</label>

                        <div
                            class="genre-picker @error('genre_id') is-invalid @enderror"
                            id="genrePicker"
                        >

                            <div
                                class="genre-tags"
                                id="genreTags"
                            ></div>

                            <input
                                type="text"
                                class="genre-search"
                                id="genreSearch"
                                placeholder="Ketik genre..."
                                autocomplete="off"
                            >

                            <div
                                class="genre-results"
                                id="genreResults"
                            ></div>

                        </div>

                        @error('genre_id')
                            <span
                                class="error invalid-feedback"
                                style="display: inline;"
                            >
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- TRAILER YOUTUBE --}}
                    <div class="form-group">
                        <label for="trailer_url">Trailer YouTube</label>

                        <input
                            name="trailer_url"
                            type="url"
                            class="form-control @error('trailer_url') is-invalid @enderror"
                            id="trailer_url"
                            placeholder="https://www.youtube.com/watch?v=..."
                            value="{{ old('trailer_url', $film->trailer_url) }}"
                        >

                        @error('trailer_url')
                            <span
                                class="error invalid-feedback"
                                style="display: inline;"
                            >
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- RINGKASAN --}}
                    <div class="form-group">
                        <label for="ringkasan">Ringkasan</label>

                        <textarea
                            name="ringkasan"
                            class="form-control @error('ringkasan') is-invalid @enderror"
                            id="ringkasan"
                            placeholder="Ringkasan"
                        >{{ old('ringkasan', $film->ringkasan) }}</textarea>

                        @error('ringkasan')
                            <span
                                class="error invalid-feedback"
                                style="display: inline;"
                            >
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- POSTER --}}
                    <div class="form-group">
                        <label for="poster">Poster</label>

                        <br>

                        @if($film->poster)

                            <img
                                src="{{ asset($film->poster) }}"
                                width="120"
                                class="mb-2 rounded"
                            >

                            <br>

                        @endif

                        <div class="custom-file">

                            <input
                                name="poster"
                                type="file"
                                accept="image/*"
                                class="custom-file-input @error('poster') is-invalid @enderror"
                                id="poster"
                            >

                            <label
                                class="custom-file-label"
                                for="poster"
                            >
                                Ganti file...
                            </label>

                            @error('poster')
                                <span
                                    class="error invalid-feedback"
                                    style="display: inline;"
                                >
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                    </div>


                    {{-- CAST --}}
                    <div class="form-group">
                        <label>Cast</label>

                        <div
                            class="border rounded p-2 @error('cast_id') is-invalid @enderror"
                            style="max-height: 200px; overflow-y: auto;"
                        >

                            @foreach ($casts as $cast)

                                <div class="form-check">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="cast_id[]"
                                        value="{{ $cast->id }}"
                                        id="cast_{{ $cast->id }}"
                                        {{ $film->cast->pluck('id')->contains($cast->id) ? 'checked' : '' }}
                                    >

                                    <label
                                        class="form-check-label"
                                        for="cast_{{ $cast->id }}"
                                    >
                                        {{ $cast->nama }}
                                    </label>

                                </div>

                            @endforeach

                        </div>

                        @error('cast_id')
                            <span
                                class="error invalid-feedback"
                                style="display: inline;"
                            >
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="px-3 d-flex justify-content-between align-items-center">

                    <button
                        type="reset"
                        class="btn btn-warning"
                    >
                        Reset
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Submit
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>


@push('js')

<style>
    .genre-picker {
        position: relative;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
        min-height: 45px;
        padding: 6px 8px;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 5px;
        cursor: text;
    }

    .genre-picker:focus-within {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .genre-tags {
        display: contents;
    }

    .genre-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 8px;
        background-color: #e9ecef;
        border-radius: 5px;
        font-size: 14px;
        line-height: 1.2;
    }

    .genre-tag-remove {
        border: none;
        background: transparent;
        padding: 0;
        margin: 0;
        color: #666;
        font-size: 16px;
        font-weight: bold;
        line-height: 1;
        cursor: pointer;
    }

    .genre-tag-remove:hover {
        color: #dc3545;
    }

    .genre-search {
        flex: 1;
        min-width: 150px;
        border: none;
        outline: none;
        padding: 5px 2px;
        font-size: 14px;
        background: transparent;
    }

    .genre-results {
        display: none;
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        right: 0;
        max-height: 200px;
        overflow-y: auto;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 5px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        z-index: 1050;
    }

    .genre-result {
        padding: 9px 12px;
        cursor: pointer;
        font-size: 14px;
    }

    .genre-result:hover {
        background-color: #f1f1f1;
    }
</style>


<script>
    $(document).ready(function () {

        const genres = @json($genres);

        let selectedGenres = [];


        /*
        |--------------------------------------------------------------------------
        | Genre yang sudah dimiliki film
        |--------------------------------------------------------------------------
        */

        const currentGenreIds = @json($film->genres->pluck('id'))
            .map(Number);


        /*
        |--------------------------------------------------------------------------
        | Kalau validasi gagal, gunakan pilihan dari old()
        | Kalau tidak, gunakan genre yang sudah dimiliki film
        |--------------------------------------------------------------------------
        */

        const selectedGenreIds = @json(old('genre_id'))
            ? @json(old('genre_id')).map(Number)
            : currentGenreIds;


        selectedGenreIds.forEach(function (id) {

            const genre = genres.find(function (item) {

                return Number(item.id) === id;

            });

            if (genre) {
                selectedGenres.push(genre);
            }

        });


        /*
        |--------------------------------------------------------------------------
        | Element
        |--------------------------------------------------------------------------
        */

        const genrePicker = $('#genrePicker');
        const genreTags = $('#genreTags');
        const genreSearch = $('#genreSearch');
        const genreResults = $('#genreResults');


        /*
        |--------------------------------------------------------------------------
        | Tampilkan genre yang dipilih
        |--------------------------------------------------------------------------
        */

        function renderTags() {

            genreTags.empty();

            selectedGenres.forEach(function (genre) {

                const tag = $('<span>')
                    .addClass('genre-tag');

                const name = $('<span>')
                    .text(genre.nama);

                const removeButton = $('<button>')
                    .attr({
                        type: 'button',
                        'data-id': genre.id
                    })
                    .addClass('genre-tag-remove')
                    .text('×');

                tag.append(name);
                tag.append(removeButton);

                genreTags.append(tag);


                /*
                | Hidden input
                */

                $('<input>')
                    .attr({
                        type: 'hidden',
                        name: 'genre_id[]',
                        value: genre.id
                    })
                    .appendTo(genreTags);

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Pencarian genre
        |--------------------------------------------------------------------------
        */

        function renderResults(keyword = '') {

            genreResults.empty();

            const search = keyword
                .toLowerCase()
                .trim();


            if (search === '') {

                genreResults.hide();

                return;

            }


            const results = genres.filter(function (genre) {

                const alreadySelected = selectedGenres.some(function (selected) {

                    return Number(selected.id) === Number(genre.id);

                });


                if (alreadySelected) {
                    return false;
                }


                return genre.nama
                    .toLowerCase()
                    .includes(search);

            });


            if (results.length === 0) {

                genreResults.hide();

                return;

            }


            results.forEach(function (genre) {

                const result = $('<div>')
                    .addClass('genre-result')
                    .attr('data-id', genre.id)
                    .text(genre.nama);

                genreResults.append(result);

            });


            genreResults.show();

        }


        /*
        |--------------------------------------------------------------------------
        | Ketik genre
        |--------------------------------------------------------------------------
        */

        genreSearch.on('input', function () {

            renderResults($(this).val());

        });


        /*
        |--------------------------------------------------------------------------
        | Fokus search
        |--------------------------------------------------------------------------
        */

        genreSearch.on('focus', function () {

            renderResults($(this).val());

        });


        /*
        |--------------------------------------------------------------------------
        | Pilih genre
        |--------------------------------------------------------------------------
        */

        genreResults.on('click', '.genre-result', function () {

            const id = Number($(this).attr('data-id'));


            const genre = genres.find(function (item) {

                return Number(item.id) === id;

            });


            if (!genre) {
                return;
            }


            const alreadySelected = selectedGenres.some(function (item) {

                return Number(item.id) === id;

            });


            if (alreadySelected) {
                return;
            }


            selectedGenres.push(genre);

            renderTags();

            genreSearch.val('');

            genreResults.hide();

            genreSearch.focus();

        });


        /*
        |--------------------------------------------------------------------------
        | Hapus genre
        |--------------------------------------------------------------------------
        */

        genreTags.on('click', '.genre-tag-remove', function () {

            const id = Number($(this).attr('data-id'));


            selectedGenres = selectedGenres.filter(function (genre) {

                return Number(genre.id) !== id;

            });


            renderTags();

            genreSearch.focus();

        });


        /*
        |--------------------------------------------------------------------------
        | Klik area genre
        |--------------------------------------------------------------------------
        */

        genrePicker.on('click', function (e) {

            if (
                !$(e.target).hasClass('genre-tag-remove') &&
                !$(e.target).is('#genreSearch')
            ) {

                genreSearch.focus();

            }

        });


        /*
        |--------------------------------------------------------------------------
        | Klik di luar
        |--------------------------------------------------------------------------
        */

        $(document).on('click', function (e) {

            if (
                !genrePicker.is(e.target) &&
                genrePicker.has(e.target).length === 0
            ) {

                genreResults.hide();

            }

        });


        /*
        |--------------------------------------------------------------------------
        | Reset
        |--------------------------------------------------------------------------
        */

        $('form').on('reset', function () {

            setTimeout(function () {

                selectedGenres = [];

                renderTags();

                genreSearch.val('');

                genreResults.hide();

            }, 0);

        });


        /*
        |--------------------------------------------------------------------------
        | File poster
        |--------------------------------------------------------------------------
        */

        $('.custom-file-input').on('change', function () {

            let fileName = $(this)
                .val()
                .split('\\')
                .pop();

            $(this)
                .next('.custom-file-label')
                .html(fileName || 'Ganti file...');

        });


        /*
        |--------------------------------------------------------------------------
        | Tampilkan genre awal
        |--------------------------------------------------------------------------
        */

        renderTags();

    });
</script>

@endpush

@endsection