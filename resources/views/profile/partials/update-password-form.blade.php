@if (session('status') === 'password-updated')
    <div class="alert alert-success alert-dismissible text-body-emphasis fade show rounded-pill" role="alert">
        <span class="bi bi-check-circle-fill"></span>
        {{ __('Changed Password Success!') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">{{ __('Update Password') }}</div>

    <div class="card-body">
        <div class="mb-3">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </div>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">
                    {{ __('Current Password') }}
                </label>

                <div class="col-md-6">
                    <div class="input-group">
                        <input id="current_password" type="password" class="form-control fw-lighter @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password" required autocomplete="current-password">
                    
                        <div class="input-group-append">
                            <span class="input-group-text border bg-body-secondary rounded-start-0 rounded-end-pill">
                                <a class="toggle-password link-body-emphasis" href=""><i class="bi bi-eye-slash text-body-emphasis" aria-hidden="true"></i></a>
                            </span>
                        </div>

                        @error('current_password', 'updatePassword')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">
                    {{ __('New Password') }}
                </label>

                <div class="col-md-6">
                    <div class="input-group">
                        <input id="password" type="password" class="form-control fw-lighter rounded-end-0 @error('password', 'updatePassword') is-invalid @enderror" name="password" required autocomplete="new-password">

                        <div class="input-group-append">
                            <span class="input-group-text border bg-body-secondary rounded-start-0 rounded-end-pill">
                                <a class="toggle-password link-body-emphasis" href=""><i class="bi bi-eye-slash text-body-emphasis" aria-hidden="true"></i></a>
                            </span>
                        </div>

                        @error('password', 'updatePassword')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">
                    {{ __('Confirm Password') }}
                </label>

                <div class="col-md-6">
                    <div class="input-group">
                        <input id="password_confirmation" type="password" class="form-control fw-lighter @error('password_confirmation', 'updatePassword') is-invalid @enderror" name="password_confirmation" required>

                        <div class="input-group-append">
                            <span class="input-group-text border bg-body-secondary rounded-start-0 rounded-end-pill">
                                <a class="toggle-password link-body-emphasis" href=""><i class="bi bi-eye-slash text-body-emphasis" aria-hidden="true"></i></a>
                            </span>
                        </div>

                        @error('password_confirmation', 'updatePassword')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Change Password') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>