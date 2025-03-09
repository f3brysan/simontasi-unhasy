@extends('layouts.main')

@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Beranda</span></li>
                <li class="breadcrumb-item active"><span>Ganti Password</span></li>
            </ol>
        </nav>
    </div>
@endsection

@push('css')
    <style>
        .pass_show {
            position: relative
        }

        .pass_show .ptxt {

            position: absolute;

            top: 50%;

            right: 10px;

            z-index: 1;

            color: #f36c01;

            margin-top: -10px;

            cursor: pointer;

            transition: .3s ease all;

        }

        .pass_show .ptxt:hover {
            color: #333333;
        }
    </style>
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg px-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Ganti Password</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <label>Current Password</label>
                        <div class="form-group pass_show mb-4">
                            <input type="password" class="form-control" placeholder="Current Password">
                        </div>
                        <label>New Password</label>
                        <div class="form-group pass_show mb-4">
                            <input type="password" class="form-control" placeholder="New Password">
                        </div>
                        <label>Confirm Password</label>
                        <div class="form-group pass_show mb-4">
                            <input type="password" class="form-control" placeholder="Confirm Password">
                        </div>
                    </form>
                </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="viewDetailModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
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

    <script>
        $(document).ready(function() {
            $('.pass_show').append('<span class="ptxt">Show</span>');
        });


        $(document).on('click', '.pass_show .ptxt', function() {

            $(this).text($(this).text() == "Show" ? "Hide" : "Show");

            $(this).prev().attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });

        });
    </script>
@endpush
