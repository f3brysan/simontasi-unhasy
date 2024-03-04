<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="assets/brand/coreui.svg#full"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="assets/brand/coreui.svg#signet"></use>
        </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="{{ URL::to('/') }}">
                <i class="fa-solid fa-house mr-2 nav-icon"></i> Beranda </a></li>
        {{-- <li class="nav-title">Theme</li> --}}

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
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
