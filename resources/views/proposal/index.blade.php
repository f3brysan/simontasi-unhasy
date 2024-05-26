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
            {{-- START DAFTAR PROPOSAL --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Pendaftaran Proposal</h5></span>
                </div>
                <div class="card-body">
                    @if (empty($dataProposal))
                        <div class="alert alert-danger text-center" role="alert">
                            Anda belum mendaftarkan Proposal Anda.
                        </div>
                        <div>
                            <a href="javascript:void(0)" class="btn btn-primary float-end"
                                onclick="daftarProposal()">Daftar</a>
                        </div>
                    @endif

                    @if (!empty($dataProposal))
                        <div class="table container-fluid">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td style="width: 20%"><strong>NIM</strong></td>
                                    <td>{{ auth()->user()->no_induk }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NAMA</strong></td>
                                    <td>{{ auth()->user()->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Judul</strong></td>
                                    <td>{!! $dataProposal->title !!}</td>
                                </tr>
                                <tr>
                                    <td><strong>Dosen Pembimbing</strong></td>
                                    <td>
                                        <div class="row">
                                            @foreach ($pembimbing as $item)
                                                <div class="col-md-9">
                                                    <u>{{ $item->nama }}</u><br>NIP: {{ $item->nip }}
                                                </div>
                                                <div class="col-md-3">
                                                    @if ($item->is_ok == 1)
                                                        <span class="text-center badge text-bg-success text-light"><i
                                                                class="fa-solid fa-check"></i> Disetujui</span>

                                                        <p class="text-muted">{{ $item->is_ok_at }}</p>
                                                    @else
                                                        <span class="badge text-bg-warning text-light"> Menunggu
                                                            Persetujuan</span>
                                                    @endif
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
                                                    <hr>NIP: {{ $item->nip }}
                                                </div>
                                                <div class="col-md-3"><span class="badge text-bg-warning"> Menunggu
                                                        Approval</span></div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            {{-- END DAFTAR PROPOSAL --}}

            {{-- START LOGBOOK --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Log Book Bimbingan</h5>
                </div>
                <div class="card-body">
                    <a href="javascript:(0)" class="btn btn-sm btn-primary mb-4"
                        onclick="addKegiatanLogBook('{{ Crypt::encrypt($dataProposal->id) }}', '{{ auth()->user()->no_induk }}')"><i
                            class="fa-solid fa-file-circle-plus"></i></i> Tambah</a>
                    <div class="col-lg-12 table table-responsive">
                        <table class="table table-sm table-bordered table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th class="text-center">Aksi</th>                                    
                                    <th class="text-center">Tanggal Bimbingan</th>
                                    <th class="text-center" style="width: 50%">Catatan</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
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
                <form id="storeProposal">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Judul Skripsi</label>
                            <textarea class="form-control summernote" id="exampleFormControlTextarea1" rows="3" name="judul"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Dosen Pembimbing</label>
                            <select class="form-select form-select-lg mb-3" id="allDosenPembimbing" name="dosen_pembimbing"
                                style="width: 100%">
                                <option value="">--- Pilih Dosen ---</option>
                                @foreach ($allDosenPembimbing as $item)
                                    <option value="{{ $item['nip'] }}">{{ $item['nip'] }} - {{ $item['nama'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="saveBtnDaftarProposal">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END MODAL PROPOSAL --}}

    {{-- MODAL LOG BOOK --}}
    <div class="modal fade" id="modalLogBook" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Log Book Kegiatan</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="storeLogBook">
                    <div class="modal-body">
                        <input type="hidden" name="idLogBook" id="idLogBook">
                        <input type="hidden" name="idProposal" id="idProposal">
                        <input type="hidden" name="nimLogBook" id="nimLogBook">                        
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Tanggal Bimbingan</label>
                            <input type="date" class="form-control" id="tgl_bimbingan" name="tgl_bimbingan">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatanLogBook" rows="3" name="catatanLogBook"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="saveBtnLogBook">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END MODAL LOG BOOK --}}
@endsection
@push('js')
    {{-- Summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- JQuery Validate --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
    {{-- TOAST JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"
        integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Data Tables --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.summernote').summernote({
                placeholder: 'Judul Skripsi Anda',
                tabsize: 2,
                height: 100
            });

            $('#catatanLogBook').summernote({
                placeholder: 'Detil catatan bimbingan',
                tabsize: 2,
                height: 100
            });
        });
    </script>
    <script>
        function daftarProposal() {
            $('#allDosenPembimbing').select2({
                dropdownParent: $('#modalDaftarProposal')
            });
            $("#modalDaftarProposal").modal('show');
        }

        if ($("#storeProposal").length > 0) {
            $("#storeProposal").validate({
                submitHandler: function(form) {
                    $('#saveBtnDaftarProposal').html('Menyimpan . .');

                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('daftar/proposal/store') }}",
                        data: $('#storeProposal').serializeArray(),
                        dataType: 'json',
                        success: function(data) {
                            if (data == true) {
                                $('#storeProposal').trigger("reset");
                                $('#modalDaftarProposal').modal("hide");
                                $('#saveBtnDaftarProposal').html('Simpan');
                                iziToast.success({
                                    title: 'Berhasil',
                                    message: 'Proposal tersimpan.',
                                    position: 'topRight'
                                });
                                location.reload();
                            }
                        },
                        error: function(data) {
                            console.log('Error', data);
                            $('#tombol-simpan').html('Simpan');
                        }
                    });
                }
            });
        }
    </script>
    <script>
        table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ URL::to('log-book/get/' . Crypt::encrypt($dataProposal->id)) }}",
                type: 'GET'
            },
            columns: [
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },               
                {
                    data: 'tgl_bimbingan',
                    name: 'tgl_bimbingan'
                },
                {
                    data: 'catatan',
                    name: 'catatan'
                },
                {
                    data: 'status',
                    name: 'status'
                },                             
            ],
            order: [
                [2, 'asc']
            ],
            columnDefs: [
                {
                    className: 'text-center',
                    targets: [0,1,3]
                },
            ],
        });

        function addKegiatanLogBook(id, nim) {
            $("#idProposal").val(id);
            $("#nimLogBook").val(nim);            
            $("#modalLogBook").modal('show');
            console.log(id, nim);
        }

        if ($("#storeLogBook").length > 0) {
            $("#storeLogBook").validate({
                submitHandler: function(form) {
                    $('#saveBtnLogBook').html('Menyimpan . .');

                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('log-book/store') }}",
                        data: $('#storeLogBook').serializeArray(),
                        dataType: 'json',
                        success: function(data) {
                            if (data == true) {
                                $('#storeLogBook').trigger("reset");
                                $('#modalLogBook').modal("hide");
                                $('#saveBtnLogBook').html('Simpan');
                                iziToast.success({
                                    title: 'Berhasil',
                                    message: 'Log Book tersimpan.',
                                    position: 'topRight'
                                });
                                table.ajax.reload(null, false);
                            }
                        },
                        error: function(data) {
                            console.log('Error', data);
                            $('#tombol-simpan').html('Simpan');
                        }
                    });
                }
            });
        }
    </script>
@endpush
