@extends('layouts.main')

@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item active"><span>Proposal</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg">
            <div class="row">
                {{-- START DAFTAR PROPOSAL --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Pendaftaran Proposal</h5></span>
                    </div>
                    <div class="card-body">
                        @if (empty($data['proposal']))
                            <div class="alert alert-danger text-center" role="alert">
                                Anda belum mendaftarkan Proposal Anda.
                            </div>
                            <div>
                                <a href="javascript:void(0)" class="btn btn-primary float-end"
                                    onclick="daftarProposal('{{ auth()->user()->no_induk }}')">Daftar</a>
                            </div>
                        @endif
                    </div>
                </div>
                {{-- END DAFTAR PROPOSAL --}}

                {{-- START LOGBOOK --}}
            </div>
        </div>
    </div>

    {{-- MODAL PROPOSAL --}}
    <div class="modal fade" id="modalDaftarProposal" data-coreui-backdrop="static" data-coreui-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Proposal</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Judul Skripsi</label>
                        <textarea class="form-control summernote" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Dosen Pembimbing</label>
                        <select class="form-select form-select-lg mb-3" id="allDosenPembimbing" name="dosen_pembimbing" style="width: 100%">
                            <option value="">--- Pilih Dosen ---</option>
                            @foreach ($allDosenPembimbing as $item)
                                <option value="{{ $item['nip'] }}">{{ $item['nip'] }} - {{ $item['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    {{-- END MODAL PROPOSAL --}}
@endsection
@push('js')
    {{-- Summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                placeholder: 'Judul Skripsi Anda',
                tabsize: 2,
                height: 100
            });


        });
    </script>
    <script>
        function daftarProposal(nim) {
            // console.log(nim);
            $('#allDosenPembimbing').select2({
                dropdownParent: $('#modalDaftarProposal')
            });
            $("#modalDaftarProposal").modal('show');

        }
    </script>
@endpush
