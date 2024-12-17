@extends('layouts.main')

@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item active"><span>Master Indikator Penilaian</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Master Indikator Penilaian</h5>
                </div>
                <div class="card-body">
                    <div class="example">
                        <a href="javascript:void(0)" class="btn btn-primary" id="addIndikator"><i
                                class="fa-solid fa-plus"></i> Tambah</a>
                    </div>
                    <div class="example">
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1005">
                                <div class="row">
                                    <div class="col-lg-12 table table-responsive">
                                        <table class="table table-sm table-bordered table-hover" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Aksi</th>
                                                    <th class="text-center" style="">Nama Komponen</th>
                                                    <th class="text-center" style="">Nama Indikator</th>
                                                    <th class="text-center" style="">Range Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="crudModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="crudForm">
                    <input type="text" id="id" name="id" style="display: none">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Komponen</label>
                            <select name="id_komponen" id="id_komponen" class="form-control form-select">
                                <option value="">-- Pilih Komponen --</option>
                                @foreach ($msKomponen as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Indikator</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Kualitas . . .">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Batas Minimum Nilai</label>
                            <input type="text" class="form-control" id="min_score" name="min_score" placeholder="Contoh: 80"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Batas Maksimum Nilai</label>
                            <input type="text" class="form-control" id="max_score" name="max_score" placeholder="Contoh: 80"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal --}}
@endsection

@push('js')
    {{-- Data Tables --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
    {{-- JQ Validate --}}

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="{{ asset('js/jquery-validate-additional-methods.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ URL::to('setting/indikator-penilaian') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_komponen',
                        name: 'nama_komponen'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'range_nilai',
                        name: 'range_nilai'
                    },
                ],
                order: [
                    [1, 'asc']
                ],
            });

            $(document).on("click", "#addIndikator", function() {
                $("#crudModal").modal('show');
                $("#modalTitle").html("Tambah Indikator Penilaian");
                $("#crudForm").trigger('reset');

            });

            if ($("#crudForm").length > 0) {
                $("#crudForm").validate({
                    submitHandler: function(form) {
                        $('#saveBtn').html('Menyimpan . .');

                        $.ajax({
                            type: "POST",
                            url: "{{ URL::to('setting/komponen-penilaian/store') }}",
                            data: $('#crudForm').serializeArray(),
                            dataType: 'json',
                            success: function(data) {
                                if (data == true) {
                                    $('#crudForm').trigger("reset");
                                    $('#crudModal').modal("hide");
                                    $('#saveBtn').html('Simpan');
                                    iziToast.success({
                                        title: 'Berhasil',
                                        message: 'Komponen penilaian berhasil tersimpan.',
                                        position: 'topRight'
                                    });
                                    table.ajax.reload(null, false);
                                }
                            },
                            error: function(data) {
                                console.log('Error', data);
                                $('#saveBtn').html('Simpan');
                            }
                        });
                    }
                });
            }

            $(document).on("click", ".edit", function() {
                var id = $(this).data("id");
                $.get("{{ URL::to('setting/komponen-penilaian/get') }}/" + id,
                    function(data) {
                        $("#crudModal").modal('show');
                        $("#modalTitle").html("Edit Komponen Penilaian");
                        $("#id").val(data.id);
                        $("#nama").val(data.nama);
                    });
            });

            $(document).on("click", ".delete", function() {
                var id = $(this).data("id");
                $.get("{{ URL::to('setting/komponen-penilaian/get') }}/" + id,
                    function(data) {
                        Swal.fire({
                            title: "Apakah Anda yakin?",
                            text: 'Akan menghapus komponen "' + data.nama + '".',
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Iya, hapus!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "DELETE",
                                    url: "{{ URL::to('setting/komponen-penilaian/delete') }}/" +
                                        id,
                                    success: function(response) {
                                        iziToast.success({
                                            title: 'Berhasil',
                                            message: 'Komponen penilaian berhasil dihapus.',
                                            position: 'topRight'
                                        });
                                        table.ajax.reload(null, false);
                                    }
                                });

                            }
                        });
                    });
            });

        })
    </script>
@endpush
