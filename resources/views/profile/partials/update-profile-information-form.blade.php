<div class="card mt-3">
    <div class="card-body p-0">
        <div class="position-relative">
            <div class="position-relative">
                <img id="profile-banner" src="@if ($user->profile_banner) {{ asset($user->profile_banner) }} @else {{ asset('profile-banners/default.png') }} @endif" class="img-fluid user-select-none border rounded-4 w-100" style="height: 200px; object-fit: cover; border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important; background-color: var(--bs-card-bg);">
                <div class="position-absolute rounded-4 top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.65) 100%); border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important;"></div>
                <div class="position-absolute d-flex top-0 end-0 p-3">
                    @if ($user->profile_banner)
                        <form action="{{ route('banner.remove') }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger mx-1 p-2 py-1" onclick="return confirm('Do you want to remove your profile banner?')">
                                <i class="bi bi-trash-fill"></i> Remove
                            </button>
                        </form>
                    @endif

                    <button @click="document.getElementById('profile_banner').click()" class="btn btn-primary p-2 mx-1 py-1" x-data="imgPreviewB()">
                        <i class="bi bi-cloud-upload-fill"></i> Upload
                    </button>
                </div>
            </div>
                <div class="position-absolute bottom-0 start-0 p-3 d-flex align-items-end">
                    <div class="position-relative">
                        <img id="profile-img" src="@if ($user->profile_image) {{ asset($user->profile_image) }} @else {{ 'https://ui-avatars.com/api/?name='. urlencode($user->displayname) .'&background=random&bold=true' }} @if (!str_contains($user->displayname, ' ')) &length=1 @endif @endif" class="rounded-circle user-select-none border border-3 border-white" style="width: 100px; height: 100px; object-fit: cover; background-color: var(--bs-card-bg);">
                        <div class="position-absolute top-50 start-50 translate-middle rounded-circle" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.65) 100%); width: 100px; height: 100px;">
                            {{-- <p class="text-muted fw-light mt-2 position-absolute top-50 start-50 bottom-100 translate-middle">Upload</p> --}}

                            @if ($user->profile_image)
                                <div class="btn-group position-absolute d-flex justify-content-center align-items-center position-absolute top-50 start-50 translate-middle">
                                    <form class="border-end rounded-0 pe-2" action="{{ route('profile.remove') }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn p-0 border-0" onclick="return confirm('Do you want to remove your profile image?')">
                                            <i class="bi bi-trash-fill text-danger fs-4 opacity-75"></i>
                                        </button>
                                    </form>
                                    
                                    <button @click="document.getElementById('profile_image').click()" class="btn p-0 ps-2 border-0" x-data="imgPreviewA()">
                                        <i class="bi bi-pencil-fill fs-4 opacity-75"></i>
                                    </button>
                                </div>
                            @else
                                <button @click="document.getElementById('profile_image').click()" class="btn p-0 border-0" x-data="imgPreviewA()">
                                    <i class="bi bi-pencil-fill position-absolute top-50 start-50 translate-middle fs-3 opacity-75"></i>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="ms-3 text-white">
                        <div class="d-flex">
                            <h3 class="mb-0 d-flex overflow-x-scroll overflow-y-hidden" id="edit_displayname">
                                {{ $user->displayname }}
                            </h3>
                            <button class="btn ps-1 border-0" id="edit_displayname_btn">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                        </div>

                        <div class="d-flex text-white-50">
                            <span>@</span>
                            <small class="d-flex overflow-x-scroll overflow-y-hidden" id="edit_username">
                                {{ $user->username }}
                            </small>
                            <button class="btn p-0 ps-1 border-0" id="edit_username_btn">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <form
                    id="send-verification"
                    class="d-none"
                    method="post"
                    action="{{ route('verification.send') }}"
                >
                    @csrf
                </form>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" onsubmit="return getContent()">
                    @csrf
                    @method('patch')

                    <input @change="showPreviewA(event)" class="d-none @error('profile_image') is-invalid @enderror" name="profile_image" id="profile_image" type="file" accept="image/*" x-data="imgPreviewA()">
                    <input @change="showPreviewB(event)" class="d-none @error('profile_banner') is-invalid @enderror" name="profile_banner" id="profile_banner" type="file" accept="image/*" x-data="imgPreviewB()">

                    <input id="displayname" type="text" class="d-none @error('displayname') is-invalid @enderror" name="displayname" value="{{ old('displayname', $user->displayname) }}">
                    <input id="username" type="text" class="d-none @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" required>
                        
                    <div class="mt-2 mb-3">
                        <label for="bio" class="form-label">
                            {{ __('About') }}
                        </label>

                        <textarea id="bio" type="text" maxlength="250" rows="5" class="form-control fw-lighter" name="bio" placeholder="Enter your Info" autocomplete="bio">{{ old('bio', $user->bio) }}</textarea>

                        @if ($errors->has('bio'))
                            <p class="text-danger mt-2">{{ $errors->first('bio') }}</p>
                        @endif
                    </div>

                    <div class="mb-3">

                        <label for="email" class="form-label">
                            {{ __('Your Email') }}
                        </label> <span class="text-danger">*</span>

                        <div class="mt-2">
                            <input id="email" type="email" class="form-control fw-lighter @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter your Email Address" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="mb-0">
                                        {{ __('Your email address is unverified.') }}

                                        <button form="send-verification" class="btn btn-link p-0">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <div class="alert alert-success mt-3 mb-0" role="alert">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    @error('profile_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    @error('banner_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    @error('displayname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="text-end mb-2">
                        <button type="submit" name="profileSubmit" class="btn btn-primary" {{-- onclick="return confirm('Do you want to update your profile info?')" --}}>
                        <i class="bi bi-floppy-fill"></i> {{ __('Save') }}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">Social Media</div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.socialupdate') }}">
                @csrf
                @method('patch')

                <div class="row mb-2 g-3">
                    <div class="col-lg-6">
                        <label for="social_website" class="form-label">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe2" viewBox="0 0 16 16">
                                    <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855q-.215.403-.395.872c.705.157 1.472.257 2.282.287zM4.249 3.539q.214-.577.481-1.078a7 7 0 0 1 .597-.933A7 7 0 0 0 3.051 3.05q.544.277 1.198.49zM3.509 7.5c.036-1.07.188-2.087.436-3.008a9 9 0 0 1-1.565-.667A6.96 6.96 0 0 0 1.018 7.5zm1.4-2.741a12.3 12.3 0 0 0-.4 2.741H7.5V5.091c-.91-.03-1.783-.145-2.591-.332M8.5 5.09V7.5h2.99a12.3 12.3 0 0 0-.399-2.741c-.808.187-1.681.301-2.591.332zM4.51 8.5c.035.987.176 1.914.399 2.741A13.6 13.6 0 0 1 7.5 10.91V8.5zm3.99 0v2.409c.91.03 1.783.145 2.591.332.223-.827.364-1.754.4-2.741zm-3.282 3.696q.18.469.395.872c.552 1.035 1.218 1.65 1.887 1.855V11.91c-.81.03-1.577.13-2.282.287zm.11 2.276a7 7 0 0 1-.598-.933 9 9 0 0 1-.481-1.079 8.4 8.4 0 0 0-1.198.49 7 7 0 0 0 2.276 1.522zm-1.383-2.964A13.4 13.4 0 0 1 3.508 8.5h-2.49a6.96 6.96 0 0 0 1.362 3.675c.47-.258.995-.482 1.565-.667m6.728 2.964a7 7 0 0 0 2.275-1.521 8.4 8.4 0 0 0-1.197-.49 9 9 0 0 1-.481 1.078 7 7 0 0 1-.597.933M8.5 11.909v3.014c.67-.204 1.335-.82 1.887-1.855q.216-.403.395-.872A12.6 12.6 0 0 0 8.5 11.91zm3.555-.401c.57.185 1.095.409 1.565.667A6.96 6.96 0 0 0 14.982 8.5h-2.49a13.4 13.4 0 0 1-.437 3.008M14.982 7.5a6.96 6.96 0 0 0-1.362-3.675c-.47.258-.995.482-1.565.667.248.92.4 1.938.437 3.008zM11.27 2.461q.266.502.482 1.078a8.4 8.4 0 0 0 1.196-.49 7 7 0 0 0-2.275-1.52c.218.283.418.597.597.932m-.488 1.343a8 8 0 0 0-.395-.872C9.835 1.897 9.17 1.282 8.5 1.077V4.09c.81-.03 1.577-.13 2.282-.287z"></path>
                                </svg>
                                {{ __('Website') }}
                            </div>
                        </label>

                        <input id="social_website" type="text" class="form-control fw-lighter @error('social_website') is-invalid @enderror" name="social_website" value="{{ old('social_website', $user->social_website) }}" placeholder="Enter your Website URL" autocomplete="website">

                        @error('social_website')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label for="social_email" class="form-label">
                            <i class="bi bi-envelope-at-fill"></i>
                            {{ __('Show Email on Profile') }}
                        </label>
                        
                        <select id="social_email" class="form-control form-select fw-lighter rounded-pill @error('social_email') is-invalid @enderror" name="social_email" autocomplete="social_email">
                            <option value="1" @if ($user->social_email == 1) selected @endif>Show</option>
                            <option value="0" @if ($user->social_email == 0) selected @endif>Hide</option>
                        </select>

                        @error('social_email')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label for="social_x" class="form-label">
                            <i class="bi bi-twitter-x"></i>
                            {{ __('X (Twitter)') }}
                        </label>

                        <div class="input-group">
                            <span class="input-group-text border bg-body-secondary rounded-start-pill" id="handle">@</span>
                            <input id="social_x" type="text" class="form-control fw-lighter @error('social_x') is-invalid @enderror" name="social_x" value="{{ old('name', $user->social_x) }}" placeholder="Enter your X Handle" autocomplete="twitter">
                        </div>
                        
                        @error('social_x')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label for="social_facebook" class="form-label">
                            <i class="bi bi-facebook"></i>
                            {{ __('Facebook') }}
                        </label>

                        <div class="input-group">
                            <span class="input-group-text border bg-body-secondary rounded-start-pill" id="handle">@</span>
                            <input id="social_facebook" type="text" class="form-control fw-lighter @error('social_facebook') is-invalid @enderror" name="social_facebook" value="{{ old('name', $user->social_facebook) }}" placeholder="Enter your Facebook Handle" autocomplete="facebook">
                        </div>
                        
                        @error('social_facebook')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label for="social_instagram" class="form-label">
                            <i class="bi bi-instagram"></i>
                            {{ __('Instagram') }}
                        </label>

                        <div class="input-group">
                            <span class="input-group-text border bg-body-secondary rounded-start-pill" id="handle">@</span>
                            <input id="social_instagram" type="text" class="form-control fw-lighter @error('social_instagram') is-invalid @enderror" name="social_instagram" value="{{ old('name', $user->social_instagram) }}" placeholder="Enter your instagram Handle" autocomplete="instagram">
                        </div>
                        
                        @error('social_instagram')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label for="social_youtube" class="form-label">
                            <i class="bi bi-youtube"></i>
                                {{ __('Youtube') }}
                        </label>

                        <div class="input-group">
                            <span class="input-group-text border bg-body-secondary rounded-start-pill" id="handle">@</span>
                            <input id="social_youtube" type="text" class="form-control fw-lighter @error('social_youtube') is-invalid @enderror" name="social_youtube" value="{{ old('name', $user->social_youtube) }}" placeholder="Enter your Youtube Handle" autocomplete="youtube">
                        </div>
                        
                        @error('social_youtube')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" name="profileSocial" class="btn btn-primary w-100 mt-4" {{-- onclick="return confirm('Do you want to update your profile info?')" --}}>
                        {{ __('Save Changes') }}
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    limitContentEditable(document.getElementById('edit_displayname'), 30);
    limitContentEditable(document.getElementById('edit_username'), 20);

    function getContent(){
        document.getElementById("displayname").value = document.getElementById("edit_displayname").innerHTML;
        document.getElementById("username").value = document.getElementById("edit_username").innerHTML;
    }

    function imgPreviewA() {
        return {
            showPreviewA: (event) => {
                if (event.target.files.length > 0) {
                    var src = URL.createObjectURL(event.target.files[0]);
                    document.getElementById('profile-img').src = src;
                }
            }
        }
    }

    function imgPreviewB() {
        return {
            showPreviewB: (event) => {
                if (event.target.files.length > 0) {
                    var src = URL.createObjectURL(event.target.files[0]);
                    document.getElementById('profile-banner').src = src;
                }
            }
        }
    }

    document.querySelectorAll('[contenteditable="true"]').forEach(element => {
        element.addEventListener('keydown', e => e.key === 'Enter' && e.preventDefault());
        
        element.addEventListener('input', () => {
            const text = element.textContent.replace(/[\r\n]/g, '');
            if (element.textContent !== text) {
            element.textContent = text;
            }
        });
    });

    function limitContentEditable(element, maxLength) {
        element.addEventListener('input', function() {
            if (this.innerText.length > maxLength) {
                const selection = window.getSelection();
                const position = selection.getRangeAt(0).startOffset;

                this.innerText = this.innerText.substring(0, maxLength);
                
                try {
                    const range = document.createRange();
                    const textNode = this.firstChild || this;
                    range.setStart(textNode, Math.min(position, maxLength));
                    range.collapse(true);
                    selection.removeAllRanges();
                    selection.addRange(range);
                } catch(e) {
                    const range = document.createRange();
                    range.selectNodeContents(this);
                    range.collapse(false);
                    selection.removeAllRanges();
                    selection.addRange(range);
                }
            }
        });

        element.addEventListener('paste', function(e) {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text');
            const remainingLength = maxLength - this.innerText.length;
            if (remainingLength > 0) {
                document.execCommand('insertText', false, text.substring(0, remainingLength));
            }
        });
    }

    // Function to handle edit buttons
    document.addEventListener('DOMContentLoaded', function() {
        // Add click handlers for both displayname and username edit buttons
        setupEditButton('edit_displayname_btn', 'edit_displayname');
        setupEditButton('edit_username_btn', 'edit_username');

        function setupEditButton(buttonId, editableId) {
            const editButton = document.getElementById(buttonId);
            if (!editButton) return;

            editButton.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Find the editable element
                const editableElement = document.getElementById(editableId);
                
                if (editableElement) {
                    // Make the element editable
                    editableElement.contentEditable = true;
                    
                    // Add width style
                    editableElement.style.width = '8rem';
                    
                    // Hide the edit button
                    this.style.display = 'none';
                    
                    // Focus on the element
                    editableElement.focus();
                    
                    // Optional: Place cursor at the end of the content
                    const range = document.createRange();
                    const selection = window.getSelection();
                    range.selectNodeContents(editableElement);
                    range.collapse(false);
                    selection.removeAllRanges();
                    selection.addRange(range);
                    
                    // Add blur event listener to handle when user clicks away
                    editableElement.addEventListener('blur', function() {
                        this.contentEditable = false;
                        // Remove width style
                        this.style.width = '';
                        // Show the edit button again
                        document.getElementById(buttonId).style.display = '';
                    }, { once: true }); // Use once: true to ensure the event listener is removed after first use
                    
                    // Add keypress event listener to handle Enter key
                    editableElement.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            this.blur();
                        }
                    });
                }
            });
        }
    });
</script>