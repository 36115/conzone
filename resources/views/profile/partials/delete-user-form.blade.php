<div class="card">
    <div class="card-header">{{ __('Delete Account') }}</div>

    <div class="card-body">
        <div class="mb-3">
            {{ __('Deleting your account is a permanent action and cannot be undone. If you are sure you want to proceed with the deletion, please select the button below.') }}
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteAccountModalLabel">
            {{ __('Are you sure you want to delete your account?') }}
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
        </div>
        <form id="deleteAccountForm" method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <input type="password" class="form-control fw-lighter @error('password', 'userDeletion') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required>

            @error('password', 'userDeletion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            {{ __('Cancel') }}
        </button>
        <button type="submit" class="btn btn-danger" form="deleteAccountForm">
            {{ __('Delete Account') }}
        </button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
    @php $shouldOpenModal = $errors->userDeletion->isNotEmpty(); @endphp

    <script>
        let shouldOpenModal = {{ Js::from($shouldOpenModal) }};

        if (shouldOpenModal) {
            window.addEventListener('load', function() {
                let deleteAccountModal = new bootstrap.Modal('#deleteAccountModal');
                deleteAccountModal.toggle();
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-password').forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    let passwordInput = this.closest('.input-group').querySelector('input');
                    let icon = this.querySelector('i');
                    
                    if(passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('bi-eye-slash');
                        icon.classList.add('bi-eye');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('bi-eye');
                        icon.classList.add('bi-eye-slash');
                    }
                });
            });
        });
    </script>
@endPush