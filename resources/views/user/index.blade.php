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
            {{-- START DAFTAR PROPOSAL --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Pengguna</h5>
                </div>
                <div class="card-body">
                    <a href="javascript:(0)" class="btn btn-sm btn-primary mb-4" id="addUser"><i
                            class="fa-solid fa-user-plus"></i> Tambah
                        Pengguna</a>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="myTable">
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

    {{-- Modal Add User --}}
    <div class="modal fade" id="crudModalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="crud-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">No Induk/Username</label>
                            <input type="text" class="form-control" id="no_induk" name="no_induk"
                                placeholder="UH.XXX.XXX">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Febry San">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Prodi</label>
                            <select class="form-select mb-3 js-example-basic-multiple" id="prodi" name="prodi[]"
                                style="width: 100%" multiple="multiple">
                                @foreach ($prodiList as $item)
                                    <option value="{{ $item->kode_prodi }}">{{ $item->prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="password-form">
                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Minimal 8 karakter">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Prodi</label>
                            <select class="form-select mb-3 js-example-basic-multiple" id="roles" name="roles[]"
                                style="width: 100%" multiple="multiple">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">Simpan</button>
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

    {{-- Data Tables --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap4.css"></script> --}}

    {{-- Swal --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                    url: "{{ URL::to('setting/users') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'no_induk',
                        name: 'no_induk'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'prodi',
                        name: 'prodi',
                        className: 'text-center'
                    },
                    {
                        data: 'roles',
                        name: 'roles',

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
                        targets: [1, 3, 4, 5]
                    },
                ],
            });
        });
    </script>
    <script>
        $("#addUser").click(function() {
            $("#password-form").show();
            $('.js-example-basic-multiple').select2({
                dropdownParent: $('#crudModalUser'),
                placeholder: "Pilih",
                theme: "classic",
            });
            $("#modalTitle").html('Tambah Pengguna');
            $("#crudModalUser").modal('show');
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).data('id');
            $.get("{{ URL::to('setting/users') }}/" + id,
                function(data) {
                    $('.js-example-basic-multiple').select2({
                        dropdownParent: $('#crudModalUser'),
                        placeholder: "Pilih",
                        theme: "classic",
                    });
                    $("#modalTitle").html('Tambah Pengguna');
                    $("#crudModalUser").modal('show');
                    $("#id").val(data.user.id);
                    $("#no_induk").val(data.user.no_induk);
                    $("#name").val(data.user.nama);
                    $("#prodi").val(data.prodi).change();
                    $("#roles").val(data.roles).change();
                    $("#password-form").hide();
                });
        });

        $(document).on('click', '.login-as', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            Swal.fire({
                title: "Login As",
                text: "Apakah Anda ingin login sebagai " + name + "?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya, login!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('login-as') }}",
                        data: {
                            id: id,
                            name: name
                        },
                        dataType: "JSON",
                        success: function(response) {
                            window.location.href = "{{ URL::to('/') }}";
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

        });


        if ($("#crud-form").length > 0) {
            $("#crud-form").validate({
                submitHandler: function(form) {
                    $('#saveBtn').html('Menyimpan . .');

                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('setting/users/store') }}",
                        data: $('#crud-form').serializeArray(),
                        dataType: 'json',
                        success: function(data) {
                            if (data == true) {
                                $('#crud-form').trigger("reset");
                                $('#crudModalUser').modal("hide");
                                $('#saveBtn').html('Simpan');
                                table.ajax.reload(null, false);

                                iziToast.success({
                                    title: 'Berhasil',
                                    message: 'Proposal tersimpan.',
                                    position: 'topRight'
                                });
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
    </script>
@endpush
