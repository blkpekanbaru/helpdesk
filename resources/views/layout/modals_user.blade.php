<div class="modal fade" id="modalAkun" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('UpdatePassword') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Update Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Password Lama</label>
                        <input type="password" name="current_password"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password Baru</label>
                        <input type="password" name="password"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation"
                            class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit"
                        class="btn btn-primary"><i class="mdi mdi-content-save-check-outline"></i>Update</button>
                </div>

            </form>

        </div>
    </div>
</div>