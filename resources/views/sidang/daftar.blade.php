@extends('layouts.main')

@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item active"><span>Sidang</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg">
            {{-- START DAFTAR PROPOSAL --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Pendaftaran Sidang</h5></span>
                </div>
                <div class="card-body">
                    <form action="{{ URL::to('daftar/sidang/store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nim" value="{{ auth()->user()->no_induk }}">
                        @if (!empty($proposal))
                            <div class="table container-fluid">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td style="width: 20%"><strong>NIM</strong></td>
                                        <td>{{ auth()->user()->no_induk }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama</strong></td>
                                        <td>{{ auth()->user()->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Program Studi</strong></td>
                                        <td>{{ $prodi }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Judul</strong></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p>Judul Proposal : {!! $proposal->title !!}</p>
                                                    <label for="">Isi Judul Skripsi</label>
                                                    <textarea class="form-control summernote" id="exampleFormControlTextarea1" rows="3" name="judul"></textarea>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Dosen Pembimbing</strong></td>
                                        <td>
                                            <div class="row">
                                                @foreach ($pembimbing as $item)
                                                    <div class="col-md-9">
                                                        <u>{{ $item->nama }}</u><br>NIY: {{ $item->nip }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Dosen Penguji</strong></td>
                                        <td>
                                            <div class="row">
                                                @foreach ($penguji as $item)
                                                    <div class="col-md-9">
                                                        <u>{{ $item->nama }}</u>
                                                        <br>NIY: {{ $item->nip }}
                                                        <br>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary float-end" id="saveBtnUnggah">Daftar <i class="fa-solid fa-right-to-bracket"></i></button>
                    </form>
                </div>
            </div>
            {{-- END DAFTAR PROPOSAL --}}
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- Summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ URL::to('/') }}/js/summernote-ext-rtl.js"></script>
    <script>
        $(document).ready(function() {
            var options = {
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['ltr', 'rtl']],
                    ['insert', ['link', 'picture', 'video', 'hr']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            };

            $('.summernote').summernote(options);

        });
    </script>
@endpush
