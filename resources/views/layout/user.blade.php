<a class="dropdown-item" href="#"
    data-bs-toggle="modal"
    data-bs-target="#modalAkun">
    <i class="mdi mdi-key me-2 text-success"></i> Akun
</a>
<div class="dropdown-divider"></div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<a class="dropdown-item" href="#"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="mdi mdi-logout me-2 text-primary"></i> Logout
</a>



