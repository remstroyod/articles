@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="mb-3 text-center">{{ sprintf('%s, %s', __('Hello'), $user->name) }}</h1>

            @if(session()->has('success'))
                <div class="alert alert-success mt-4">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger mt-4">
                    {{ session()->get('error') }}
                </div>
            @endif

            <form class="row" action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-6 mb-3">
                    <input name="name" id="name" class="form-control" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}" />
                    @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-6 mb-3">
                    <input name="email" id="email" class="form-control" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}" />
                    @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <input name="password" id="password" class="form-control" type="password" placeholder="{{ __('*******') }}" value="" />
                    @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!--Avatar-->
                <div class="mb-5">
                    <div class="d-flex justify-content-center mb-4">
                        @if($user->avatar && Storage::disk('public')->exists(sprintf('%s/%s', 'avatars', $user->avatar)))
                            <img id="selectedAvatar" src="{{ url(sprintf('storage/avatars/%s', $user->avatar)) }}"
                                 class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                        @else
                        <img id="selectedAvatar" src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg"
                             class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                        @endif
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="btn btn-primary btn-rounded">
                            <label class="form-label text-white m-1" for="avatar">{{ __('Choose File') }}</label>
                            <input type="file" class="form-control d-none" id="avatar" onchange="displaySelectedImage(event, 'selectedAvatar')" name="image" />
                        </div>
                    </div>
                </div>

                <div class="form-group col-12 text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('Save') }}</button>
                </div>
            </form>

            <div class="text-center pt-5">
                <a href="javascript:;" class="btn btn-danger btn-lg" onclick="event.preventDefault();document.getElementById('destroy-user-{{ $user->id }}').submit();">
                    {{ __('Remove Account') }}
                </a>
                <form id="destroy-user-{{ $user->id }}" action="{{ route('user.destroy', $user) }}" class="d-none" method="post">
                    @csrf
                    @method('delete')
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@push('custom-js')
    <script>
        function displaySelectedImage(event, elementId) {
            const selectedImage = document.getElementById(elementId);
            const fileInput = event.target;

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
@endpush
