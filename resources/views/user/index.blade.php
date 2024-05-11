@extends('layouts.main')

@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item active"><span>Pengguna</span></li>
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
                        <h5>Pengguna</h5></span>
                    </div>
                    <div class="card-body">
                        <a href="javascript:(0)" class="btn btn-sm btn-primary mb-4" id="addUser"><i
                                class="fa-solid fa-user-plus"></i> Tambah
                            Pengguna</a>
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <td class="text-center">No</td>
                                        <td class="text-center">No Induk</td>
                                        <td class="text-center">Nama</td>
                                        <td class="text-center">Prodi</td>
                                        <td class="text-center">Peran</td>
                                        <td class="text-center">Aksi</td>
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

    {{-- Modal Add User --}}
    <div class="modal fade" id="crudModalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">No Induk/Username</label>
                            <input type="no_induk" class="form-control" id="exampleFormControlInput1"
                                placeholder="UH.XXX.XXX">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Prodi</label>
                            <input type="no_induk" class="form-control" id="exampleFormControlInput1"
                                placeholder="UH.XXX.XXX">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Modal Add User --}}
@endsection
@push('js')
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

            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ URL::to('setting/users') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-right'
                    },
                    {
                        data: 'no_induk',
                        name: 'no_induk'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'prodi',
                        name: 'prodi'
                    },
                    {
                        data: 'roles',
                        name: 'roles',
                        className: 'text-center',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                        className: 'text-end',
                        targets: [0]
                    },
                    {
                        className: 'text-center',
                        targets: [1, 3, 4]
                    },
                ],
            });
        });
    </script>
    <script>
        $("#addUser").click(function() {
            $("#modalTitle").html('Tambah Pengguna');
            $("#crudModalUser").modal('show');
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).data('id');

        });
        // STORE DATA
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
@endpush
