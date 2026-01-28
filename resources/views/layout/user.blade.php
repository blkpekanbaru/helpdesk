<a class="dropdown-item" href="#">
    <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
<div class="dropdown-divider"></div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<a class="dropdown-item" href="#"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="mdi mdi-logout me-2 text-primary"></i> Signout
</a>