<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        SIMONTASI-<strong>UNHASY</strong>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="{{ URL::to('/') }}">
                <i class="fa-solid fa-house mr-2 nav-icon"></i> Beranda </a></li>
        <li class="nav-title">Pendaftaran Proposal/Sidang</li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <i class="fa-solid fa-right-to-bracket nav-icon"></i> Pendaftaran</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="forms/form-control.html"><i
                            class="fa-solid fa-book nav-icon"></i> Proposal</a></li>
                <li class="nav-item"><a class="nav-link" href="forms/form-control.html"><i
                            class="fa-solid fa-book nav-icon"></i> Sidang</a></li>
            </ul>
        </li>
        <li class="nav-title">Monitoring</li>
        <li class="nav-item"><a class="nav-link" href="javascript:void(0)">
                <i class="fa-regular fa-rectangle-list nav-icon"></i> Log Bimbingan </a></li>
        @role('superadmin')
            <li class="nav-title">Setting</li>
            <li class="nav-item"><a class="nav-link" href="{{ URL::to('setting/users') }}">
                    <i class="fa-solid fa-users nav-icon"></i> User</a></li>
        @endrole
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
