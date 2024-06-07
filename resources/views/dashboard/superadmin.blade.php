@extends('layouts.main')

@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item active"><span>Beranda</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Jumlah Pendaftar</h5>
                </div>
                <div class="card-body">
                    <div class="example">
                       <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Prodi</th>
                                <th>Jumlah Sidang Proposal</th>
                                <th>Jumlah TA/Skripsi/Tesis</th>
                            </tr>
                        </thead>
                        <tbody>@if (count($prodi) > 0)                            
                            @foreach ($prodi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->prodi }}</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>                                
                            @endforeach
                        @endif
                        </tbody>
                       </table>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Detail Pendaftar</h5>
                </div>
                <div class="card-body">
                    <div class="example">                        
                    </div>
                </div>
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
@endpush
