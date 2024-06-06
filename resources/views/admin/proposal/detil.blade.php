@extends('layouts.main')

@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item "><span>Proposal</span></li>
                <li class="breadcrumb-item active"><span>Detil Proposal {{ $biodata->no_induk }} -
                        {{ $biodata->nama }}</span></li>
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
                    @if (!empty($dataProposal))
                        <div class="table container-fluid">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td style="width: 20%"><strong>NIM</strong></td>
                                    <td>{{ $biodata->no_induk }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NAMA</strong></td>
                                    <td>{{ $biodata->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Program Studi</strong></td>
                                    <td>{{ $prodi }}</td>
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
                                            @if (count($penguji) == 0)
                                                <div class="col-md-9">
                                                   @if (count($logbookDone) < 3)
                                                   <span class="badge text-bg-warning text-light"> Minimal 4x bimbingan</span>
                                                   @endif
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="javascript:void(0)"
                                                        onclick="tambahPenguji('{{ $dataProposal->id }}', '{{ $biodata->no_induk }}')"
                                                        class="btn btn-sm btn-primary float-end  {{ count($logbookDone) < 3 ? 'disabled' : '' }}"><i
                                                            class="fa-solid fa-user-plus"></i> Tambah Penguji</a>
                                                </div>
                                            @else
                                                @foreach ($penguji as $item)
                                                    <div class="col-md-9">
                                                        <u>{{ $item->nama }}</u>
                                                        <hr>NIP: {{ $item->nip }}
                                                    </div>
                                                    <div class="col-md-3"><span class="badge text-bg-warning"> Menunggu
                                                            Approval</span></div>
                                                @endforeach
                                            @endif
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
                    <div class="col-lg-12 table table-responsive">
                        <table class="table table-sm table-bordered table-striped" id="myTable">
                            <thead>
                                <tr>
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
            {{-- END LOGBOOK --}}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambah-penguji" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Penguji</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ URL::to('admin/data/proposal/store-penguji') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_pendaftaran" id="id_pendaftaran" value="{{ Crypt::encrypt($dataProposal->id) }}">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Dosen Pembimbing</label>
                        <select class="form-select form-select-lg mb-3" id="allDosenPembimbing" name="dosen_penguji"
                            style="width: 100%">
                            <option value="">--- Pilih Dosen ---</option>
                            @foreach ($allDosenPenguji as $item)
                                <option value="{{ $item['nip'] }}">{{ $item['nip'] }} - {{ $item['nama'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    {{-- End Modal --}}
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
    {{-- SWAL --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        function tambahPenguji(id, nim) {
            $('#allDosenPembimbing').select2({
                dropdownParent: $('#tambah-penguji')
            });
            $("#tambah-penguji").modal('show');
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
            columns: [{
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
                [0, 'desc']
            ],
            columnDefs: [{
                className: 'text-center',
                targets: [0, 1, 2]
            }, ],
        });

        function addKegiatanLogBook(id, nim) {
            $("#idProposal").val(id);
            $("#nimLogBook").val(nim);
            $("#storeLogBook").trigger("reset");
            $('#catatanLogBook').summernote('reset');
            $("#modalLogBook").modal('show');
        }

        $(document).on('click', '.edit', function() {
            var id = $(this).data('id')
            $.get("{{ URL::to('log-book/show-detil') }}/" + id,
                function(data) {
                    $("#idLogBook").val(data.data.id);
                    $("#idProposal").val(data.data.pendaftaran_id);
                    $("#tgl_bimbingan").val(data.data.tgl_bimbingan);
                    $('#catatanLogBook').summernote('code', data.data.catatan);
                    $("#modalLogBook").modal('show');
                });
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).data('id')
            Swal.fire({
                title: "Peringatan",
                text: "Apakah Anda ingin menghapus catatan ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ URL::to('log-book/delete-detil') }}/" + id,
                        success: function(data) {
                            table.ajax.reload(null, false);
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Catatan berhasil dihapus",
                                icon: "success"
                            });
                        }
                    });


                }
            });
        });

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
