@if(auth()->user()->role == 'admin')
<li class="nav-item">
    <a class="nav-link" href="{{route('dashAdmin')}}">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('ShowUser')}}">
        <span class="menu-title">Manajemen User</span>
        <i class="mdi mdi-account menu-icon"></i>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('ShowPekerjaan')}}">
        <span class="menu-title">Proyek</span>
        <i class="mdi mdi-briefcase menu-icon"></i>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('ShowLokasi')}}">
        <span class="menu-title">Lokasi</span>
        <i class="mdi mdi-map-marker menu-icon"></i>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('Laporan')}}">
        <span class="menu-title">Laporan</span>
        <i class="mdi mdi-file-check-outline menu-icon"></i>
    </a>
</li>
@elseif(auth()->user()->role == 'teknisi')
<li class="nav-item">
    <a class="nav-link" href="{{ route('dashTeknisi') }}">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('ShowTugas') }}">
        <span class="menu-title">Tugas</span>
        <i class="mdi mdi-clipboard-check menu-icon"></i>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('ShowPelaporan') }}">
        <span class="menu-title">Pelaporan</span>
        <i class="mdi mdi-alert menu-icon"></i>
    </a>
</li>
@endif