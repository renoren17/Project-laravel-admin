@extends('layouts.master')

@section('content')

<div class="container-fluid">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">FAQ</h3>

        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item active">FAQ</li>
        </ol>
    </div>

    {{-- FAQ HEADER --}}
    <div class="text-center py-3 mb-4">

        <h2 class="fw-normal mb-2">
            How can we help?
        </h2>

        <p class="text-secondary mb-3">
            Temukan jawaban dari pertanyaan yang sering ditanyakan
            seputar kegiatan sekolah.
        </p>

        {{-- SEARCH --}}
        <form class="row justify-content-center" onsubmit="return false;">
            <div class="col-md-6">

                <div class="input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-secondary">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input
                        type="text"
                        id="faqSearch"
                        class="form-control border-secondary"
                        placeholder="Search the FAQ..."
                        autocomplete="off"
                    >
                </div>

            </div>
        </form>

    </div>


    {{-- ========================================= --}}
    {{-- AKADEMIK --}}
    {{-- ========================================= --}}

    <div class="card bg-body-tertiary border mb-4 faq-category">

        <div class="card-header bg-transparent border-bottom py-3">

            <h5 class="mb-0">

                <i class="fas fa-graduation-cap text-primary me-2"></i>

                Akademik & Pembelajaran

            </h5>

        </div>


        <div class="faq-list">

            {{-- FAQ 1 --}}
            <div class="faq-item border-bottom">

                <button
                    class="faq-question"
                    type="button"
                    aria-expanded="false"
                >

                    <span>
                        Bagaimana cara melihat jadwal pelajaran?
                    </span>

                    <i fas fa-chevron-down faq-arrow"></i>

                </button>

                <div class="faq-answer">

                    <p class="mb-0">
                        Jadwal pelajaran dapat dilihat melalui menu
                        <strong>Jadwal</strong> pada sistem informasi sekolah.
                        Jadwal berisi informasi mengenai mata pelajaran,
                        guru, ruang, serta waktu pembelajaran.
                    </p>

                </div>

            </div>


            {{-- FAQ 2 --}}
            <div class="faq-item border-bottom">

                <button
                    class="faq-question"
                    type="button"
                    aria-expanded="false"
                >

                    <span>
                        Bagaimana cara melihat nilai saya?
                    </span>

                    <i fas fa-chevron-down faq-arrow"></i>

                </button>

                <div class="faq-answer">

                    <p class="mb-0">
                        Nilai dapat diperiksa melalui menu
                        <strong>Nilai Akademik</strong>.
                        Pastikan akun yang digunakan merupakan akun siswa
                        yang telah terdaftar di sekolah.
                    </p>

                </div>

            </div>


            {{-- FAQ 3 --}}
            <div class="faq-item">

                <button
                    class="faq-question"
                    type="button"
                    aria-expanded="false"
                >

                    <span>
                        Bagaimana jika saya tidak dapat mengikuti pembelajaran?
                    </span>

                    <i class="fas fa-chevron-down faq-arrow"></i>

                </button>

                <div class="faq-answer">

                    <p class="mb-0">
                        Jika tidak dapat mengikuti pembelajaran, siswa harus
                        memberikan informasi kepada wali kelas atau guru
                        yang bersangkutan sesuai dengan ketentuan sekolah.
                    </p>

                </div>

            </div>

        </div>

    </div>



    {{-- ========================================= --}}
    {{-- ADMINISTRASI --}}
    {{-- ========================================= --}}

    <div class="card bg-body-tertiary border mb-4 faq-category">

        <div class="card-header bg-transparent border-bottom py-3">

            <h5 class="mb-0">

                <i class="fas fa-credit-card text-primary me-2"></i>

                Administrasi Sekolah

            </h5>

        </div>


        <div class="faq-list">

            {{-- FAQ 4 --}}
            <div class="faq-item border-bottom">

                <button
                    class="faq-question"
                    type="button"
                    aria-expanded="false"
                >

                    <span>
                        Bagaimana cara mendapatkan informasi pembayaran sekolah?
                    </span>

                    <i class="fas fa-chevron-down faq-arrow"></i>

                </button>

                <div class="faq-answer">

                    <p class="mb-0">
                        Informasi pembayaran sekolah dapat diperiksa melalui
                        bagian administrasi atau menu pembayaran pada sistem
                        informasi sekolah.
                    </p>

                </div>

            </div>


            {{-- FAQ 5 --}}
            <div class="faq-item border-bottom">

                <button
                    class="faq-question"
                    type="button"
                    aria-expanded="false"
                >

                    <span>
                        Apakah pembayaran sekolah dapat dilakukan secara online?
                    </span>

                    <i class="fas fa-chevron-down faq-arrow"></i>

                </button>

                <div class="faq-answer">

                    <p class="mb-0">
                        Pembayaran secara online dapat dilakukan apabila metode
                        tersebut telah disediakan oleh pihak sekolah.
                        Informasi mengenai metode pembayaran dapat diperoleh
                        melalui bagian administrasi.
                    </p>

                </div>

            </div>


            {{-- FAQ 6 --}}
            <div class="faq-item">

                <button
                    class="faq-question"
                    type="button"
                    aria-expanded="false"
                >

                    <span>
                        Bagaimana jika terdapat kesalahan data siswa?
                    </span>

                    <i class="fas fa-chevron-down faq-arrow"></i>

                </button>

                <div class="faq-answer">

                    <p class="mb-0">
                        Segera laporkan kesalahan data kepada bagian tata usaha
                        atau administrasi sekolah agar dapat dilakukan
                        pemeriksaan dan perbaikan data.
                    </p>

                </div>

            </div>

        </div>

    </div>



    {{-- ========================================= --}}
    {{-- KEGIATAN SEKOLAH --}}
    {{-- ========================================= --}}

    <div class="card bg-body-tertiary border mb-4 faq-category">

        <div class="card-header bg-transparent border-bottom py-3">

            <h5 class="mb-0">

                <i class="fas fa-calendar-alt text-primary me-2"></i>

                Kegiatan & Peraturan Sekolah

            </h5>

        </div>


        <div class="faq-list">

            {{-- FAQ 7 --}}
            <div class="faq-item border-bottom">

                <button
                    class="faq-question"
                    type="button"
                    aria-expanded="false"
                >

                    <span>
                        Di mana saya dapat melihat informasi kegiatan sekolah?
                    </span>

                    <i class="fas fa-chevron-down faq-arrow"></i>

                </button>

                <div class="faq-answer">

                    <p class="mb-0">
                        Informasi kegiatan sekolah dapat dilihat melalui
                        pengumuman resmi, kalender akademik, atau menu
                        <strong>Informasi Sekolah</strong>.
                    </p>

                </div>

            </div>


            {{-- FAQ 8 --}}
            <div class="faq-item border-bottom">

                <button
                    class="faq-question"
                    type="button"
                    aria-expanded="false"
                >

                    <span>
                        Bagaimana cara mengetahui peraturan sekolah?
                    </span>

                    <i class="fas fa-chevron-down faq-arrow"></i>

                </button>

                <div class="faq-answer">

                    <p class="mb-0">
                        Peraturan sekolah dapat dipelajari melalui buku
                        tata tertib siswa maupun informasi resmi yang
                        diberikan oleh pihak sekolah.
                    </p>

                </div>

            </div>


            {{-- FAQ 9 --}}
            <div class="faq-item">

                <button
                    class="faq-question"
                    type="button"
                    aria-expanded="false"
                >

                    <span>
                        Siapa yang dapat saya hubungi jika membutuhkan bantuan?
                    </span>

                    <i class="fas fa-chevron-down faq-arrow"></i>

                </button>

                <div class="faq-answer">

                    <p class="mb-0">
                        Siswa dapat menghubungi wali kelas, guru, bagian tata
                        usaha, atau petugas sekolah yang berkaitan dengan
                        permasalahan yang ingin disampaikan.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- ========================================= --}}
{{-- STYLE --}}
{{-- ========================================= --}}

<style>

    /* =========================================
       FAQ CATEGORY / BOX UTAMA
    ========================================= */

    .faq-category {
        background-color: #ffffff !important;

        border: 1px solid #000000 !important;

        border-radius: 6px;

        overflow: hidden;

        color: #212529;
    }


    /* =========================================
       HEADER KATEGORI
    ========================================= */

    .faq-category .card-header {
        min-height: 54px;

        display: flex;

        align-items: center;

        background-color: #ffffff !important;

        color: #212529 !important;

        border-bottom: 1px solid #000000 !important;
    }

    .faq-category .card-header h5 {
        font-size: 1rem;

        font-weight: 400;

        color: #212529 !important;
    }


    /* =========================================
       SETIAP FAQ
    ========================================= */

    .faq-item {
        width: 100%;

        background-color: #ffffff !important;

        color: #212529 !important;

        border-color: #000000 !important;
    }


    /* =========================================
       TOMBOL PERTANYAAN
    ========================================= */

    .faq-question {
        width: 100%;

        border: 0;

        background-color: #ffffff !important;

        color: #212529 !important;

        display: flex;

        align-items: center;

        justify-content: space-between;

        padding: 17px 20px;

        text-align: left;

        font-size: 0.95rem;

        cursor: pointer;

        transition: background-color 0.15s ease;
    }


    .faq-question:hover {
        background-color: #f8f9fa !important;

        color: #212529 !important;
    }


    /* =========================================
       GARIS ANTAR PERTANYAAN
    ========================================= */

    .faq-item.border-bottom {
        border-bottom: 1px solid #000000 !important;
    }


    /* =========================================
       ICON PANAH
    ========================================= */

    .faq-arrow {
        color: #212529 !important;

        font-size: 15px;

        transition: transform 0.2s ease;
    }


    .faq-question[aria-expanded="true"] .faq-arrow {
        transform: rotate(180deg);
    }


    /* =========================================
       JAWABAN FAQ
    ========================================= */

    .faq-answer {
        display: none;

        padding: 0 20px 18px 20px;

        background-color: #ffffff !important;

        color: #212529 !important;

        font-size: 0.9rem;

        line-height: 1.7;
    }


    .faq-answer.show {
        display: block;
    }


    .faq-answer strong {
        color: #212529 !important;
    }


    /* =========================================
       SEARCH
    ========================================= */

    #faqSearch {
        font-size: 0.95rem;

        background-color: #ffffff !important;

        color: #212529 !important;

        border: 1px solid #000000 !important;
    }


    #faqSearch::placeholder {
        color: #6c757d;
    }


    .input-group-text {
        background-color: #ffffff !important;

        color: #212529 !important;

        border: 1px solid #000000 !important;
    }


    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 768px) {

        .faq-question {
            padding: 15px;

            font-size: 0.9rem;
        }

        .faq-answer {
            padding-left: 15px;

            padding-right: 15px;
        }

    }

</style>


{{-- ========================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | FAQ ACCORDION
    |--------------------------------------------------------------------------
    */

    const questions = document.querySelectorAll('.faq-question');

    questions.forEach(function (question) {

        question.addEventListener('click', function () {

            const answer = this.nextElementSibling;

            const isOpen = this.getAttribute('aria-expanded') === 'true';

            // Tutup semua FAQ lain
            questions.forEach(function (otherQuestion) {

                otherQuestion.setAttribute('aria-expanded', 'false');

                const otherAnswer = otherQuestion.nextElementSibling;

                if (otherAnswer) {
                    otherAnswer.classList.remove('show');
                }

            });

            // Kalau sebelumnya tertutup, buka
            if (!isOpen) {

                this.setAttribute('aria-expanded', 'true');

                answer.classList.add('show');

            }

        });

    });



    /*
    |--------------------------------------------------------------------------
    | SEARCH FAQ
    |--------------------------------------------------------------------------
    */

    const searchInput = document.getElementById('faqSearch');

    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();

        const items = document.querySelectorAll('.faq-item');

        items.forEach(function (item) {

            const question = item
                .querySelector('.faq-question span')
                .textContent
                .toLowerCase();

            const answer = item
                .querySelector('.faq-answer')
                .textContent
                .toLowerCase();

            if (
                keyword === '' ||
                question.includes(keyword) ||
                answer.includes(keyword)
            ) {

                item.style.display = '';

            } else {

                item.style.display = 'none';

            }

        });


        /*
        | Hide category if all questions inside it are hidden
        */

        document.querySelectorAll('.faq-category').forEach(function (category) {

            const visibleItems = category.querySelectorAll(
                '.faq-item:not([style*="display: none"])'
            );

            if (keyword !== '' && visibleItems.length === 0) {

                category.style.display = 'none';

            } else {

                category.style.display = '';

            }

        });

    });

});

</script>

@endsection