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
                                    <td>
                                        <div class="row">
                                            <div class="col-md-10">
                                                {!! $dataProposal->title !!}
                                            </div>
                                            <div class="col-md-2">
                                                @if ($dataProposal->is_ok == null)
                                                    <a href="javascript:void(0)"
                                                        onclick="kunciJudul('{{ Crypt::encrypt($dataProposal->id) }}')"
                                                        class="m-1 btn btn-sm btn-info text-light float-end"><i
                                                            class="fas fa-lock"></i> Kunci</a>
                                                    <a href="javascript:void(0)"
                                                        onclick="gantiJudul('{{ Crypt::encrypt($dataProposal->id) }}')"
                                                        class="m-1 btn btn-sm btn-primary float-end"><i
                                                            class="fas fa-pencil"></i> Ubah</a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        onclick="bukaJudul('{{ Crypt::encrypt($dataProposal->id) }}')"
                                                        class="m-1 btn btn-sm btn-warning float-end"><i
                                                            class="fas fa-unlock"></i> Buka Kunci</a>
                                                @endif
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
                                                <div class="col-md-3">
                                                    @if ($item->is_ok == 1)
                                                        Disetujui Pada : {{ $item->is_ok_at }}
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-sm btn-danger text-light float-end"
                                                            onclick="unapprovePembimbing('{{ Crypt::encrypt($dataProposal->id) }}')"><i
                                                                class="fas fa-refresh"></i> Batal Setujui</a>
                                                    @else
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-sm btn-success float-end m-1"
                                                            onclick="approvePembimbing('{{ Crypt::encrypt($dataProposal->id) }}')"><i
                                                                class="fas fa-check"></i> Setujui</a>
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-sm btn-primary float-end m-1"
                                                            onclick="ubahPembimbing('{{ Crypt::encrypt($dataProposal->id) }}')"><i
                                                                class="fas fa-pencil"></i> Ubah</a>
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
                                                    <u>{{ $item->nama }}</u><br>NIY: {{ $item->nip }}

                                                    <br>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="javascript:void(0)"
                                                        onclick="hapusPenguji('{{ Crypt::encrypt($item->id) }}')"
                                                        class="ml-4 btn btn-sm btn-warning text-dark"><i
                                                            class="fas fa-trash"></i> Hapus</a>
                                                </div>
                                            @endforeach
                                            @if (count($penguji) < 2)
                                                <div class="col-md-3">
                                                    <a href="javascript:void(0)"
                                                        onclick="tambahPenguji('{{ $dataProposal->id }}', '{{ $biodata->no_induk }}')"
                                                        class="btn btn-sm btn-primary float-end  {{ count($logbookDone) >= 2 ? 'disabled' : '' }}"><i
                                                            class="fa-solid fa-user-plus"></i> Tambah Penguji</a>
                                                </div>
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

            {{-- START JADWAL PROPOSAL --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Jadwal Sidang</h5></span>
                </div>
                <div class="card-body">
                    @if (!empty($dataProposal))
                        <div class="table container-fluid">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Tanggal dan Waktu</th>
                                        <th class="text-center">Lokasi</th>
                                        <th class="text-center" style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (empty($jadwal))
                                        <tr>
                                            <td class="text-center" colspan="2"><span class="badge bg-warning">Jadwal
                                                    belum diset !</span></td>
                                            <td class="text-center" style="width: 30%"><a href="javascript:void(0)"
                                                    class="btn btn-sm btn-primary"
                                                    onclick="setJadwal('{{ Crypt::encrypt($dataProposal->id) }}')">Set
                                                    Jadwal</a></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($jadwal->awal)) }}<br>
                                                {{ date('H:i', strtotime($jadwal->awal)) }} -
                                                {{ date('H:i', strtotime($jadwal->akhir)) }} WIB
                                            </td>
                                            <td class="text-center">Di {{ $jadwal->lokasi }}</td>
                                            <td class="text-center"><a href="javascript:void(0)"
                                                    onclick="editJadwal('{{ Crypt::encrypt($dataProposal->id) }}')"
                                                    class="btn btn-sm btn-primary">Edit</a></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            {{-- END JADWAL PROPOSAL --}}

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

    {{-- MODAL PROPOSAL --}}
    <div class="modal fade" id="modalEditProposal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Proposal</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editProposal">
                    <input type="hidden" id="pendaftaran_id" name="pendaftaran_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Judul Skripsi</label>
                            <textarea class="form-control summernote" id="judul_skripsi" rows="3" name="judul"></textarea>
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

    <!-- Modal -->
    <div class="modal fade" id="editPembimbing" data-coreui-backdrop="static" data-coreui-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Penguji</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ URL::to('admin/data/proposal/store-pembimbing') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_pendaftaran" id="id_pendaftaran"
                            value="{{ Crypt::encrypt($dataProposal->id) }}">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Dosen Pembimbing</label>
                            <select class="form-select form-select-lg mb-3" id="allDosenPembimbing"
                                name="dosen_pembimbing" style="width: 100%">
                                <option value="">--- Pilih Dosen ---</option>
                                @foreach ($allDosenPembimbing as $item)
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

    <!-- Modal -->
    <div class="modal fade" id="tambah-penguji" data-coreui-backdrop="static" data-coreui-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Penguji</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ URL::to('admin/data/proposal/store-penguji') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_pendaftaran" id="id_pendaftaran"
                            value="{{ Crypt::encrypt($dataProposal->id) }}">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Dosen Penguji</label>
                            <select class="form-select form-select-lg mb-3" id="allDosenPenguji" name="dosen_penguji"
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

    <!-- Modal -->
    <div class="modal fade" id="modalSetJadwal" data-coreui-backdrop="static" data-coreui-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Set Jadwal Sidang</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ URL::to('admin/data/proposal/store/jadwal-sidang') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_pendaftaran" id="id_pendaftaran"
                            value="{{ Crypt::encrypt($dataProposal->id) }}">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Jadwal Sidang</label>
                            <input type="datetime-local" class="form-control" name="jadwalsidang" id="jadwalsidang">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Lokasi Sidang</label>
                            <input type="text" class="form-control" name="lokasi" id="lokasi">
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

            var options = {
                height: 300,
                placeholder: 'Judul roposal Anda',
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

            $('#catatanLogBook').summernote({
                placeholder: 'Detil catatan bimbingan',
                tabsize: 2,
                height: 100
            });
        });
    </script>
    <script>
        function gantiJudul(id) {
            $.get("{{ URL::to('daftar/proposal/get-judul') }}/" + id,
                function(data) {
                    $("#pendaftaran_id").val(data.id);
                    $('#judul_skripsi').summernote('code', data.title);
                    $("#modalEditProposal").modal('show');
                });
        }

        function kunciJudul(id) {
            $.get("{{ URL::to('dosen/proposal/approval-dosen/') }}/" + id,
                function(data) {
                    iziToast.success({
                        title: 'Berhasil',
                        message: 'Data tersimpan.',
                        position: 'topRight'
                    });
                    location.reload();
                });
        }

        function bukaJudul(id) {
            $.get("{{ URL::to('dosen/proposal/approval-dosen/') }}/" + id,
                function(data) {
                    iziToast.success({
                        title: 'Berhasil',
                        message: 'Data tersimpan.',
                        position: 'topRight'
                    });
                    location.reload();
                });
        }

        if ($("#editProposal").length > 0) {
            $("#editProposal").validate({
                submitHandler: function(form) {
                    $('#saveBtnDaftarProposal').html('Menyimpan . .');

                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('daftar/proposal/store') }}",
                        data: $('#editProposal').serializeArray(),
                        dataType: 'json',
                        success: function(data) {
                            if (data == true) {
                                $('#editProposal').trigger("reset");
                                $('#modalEditProposal').modal("hide");
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

        function approvePembimbing(id) {
            console.log(id);
            Swal.fire({
                title: "Perhatian",
                text: "Kunci Dosen Pembimbing?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get("{{ URL::to('proposal/approve/') }}/" + id,
                        function(data) {
                            if (data == '1') {
                                var msg = 'disetujui';
                            } else {
                                var msg = 'ditolak';
                            }
                            table.ajax.reload(null, false);
                            iziToast.success({
                                title: 'Berhasil',
                                message: 'Data berhasil diperbarui.',
                                position: 'topRight'
                            });
                            location.reload();
                        });
                }
            });
        }

        function unapprovePembimbing(id) {
            console.log(id);
            Swal.fire({
                title: "Perhatian",
                text: "Buka kunci Dosen Pembimbing?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get("{{ URL::to('proposal/approve/') }}/" + id,
                        function(data) {
                            iziToast.success({
                                title: 'Berhasil',
                                message: 'Data berhasil diperbarui.',
                                position: 'topRight'
                            });
                            location.reload();
                        });
                }
            });
        }

        function ubahPembimbing(id) {
            $.get("{{ URL::to('admin/data/proposal/get/dosen-pembimbing') }}/" + id,
                function(data) {
                    console.log(data.nip);
                    $('#allDosenPembimbing').select2({
                        dropdownParent: $('#editPembimbing')
                    });
                    $("#allDosenPembimbing").val(data.nip);
                    $("#allDosenPembimbing").trigger('change');
                    $("#editPembimbing").modal('show');
                });
        }

        function tambahPenguji(id, nim) {
            $('#allDosenPenguji').select2({
                dropdownParent: $('#tambah-penguji')
            });
            $("#tambah-penguji").modal('show');
        }

        function hapusPenguji(id) {
            console.log(id);
            Swal.fire({
                title: "Perhatian",
                text: "Hapus Dosen Penguji?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('admin/data/proposal/delete-penguji') }}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(ress) {
                            iziToast.success({
                                title: 'Berhasil',
                                message: 'Dosen Penguji berhasil dihapus.',
                                position: 'topRight'
                            });
                            location.reload();
                        }
                    });
                }
            });
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

        function setJadwal(id) {
            $("#modalSetJadwal").modal('show');
        }

        function editJadwal(id) {        
            $.get("{{ URL::to('admin/data/proposal/get/jadwal-sidang') }}/" + id,
                function(data) {
                    $("#modalSetJadwal").modal('show');
                    $("#jadwalsidang").val(data.awal);
                    $("#lokasi").val(data.lokasi);                    
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
