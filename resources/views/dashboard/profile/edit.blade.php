@extends('dashboard.layouts.app')


@section('title'){{ __('dashboard/profile/edit.title') }}
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{ __('dashboard/profile/edit.breadcrumb_1') }} /</span> {{ __('dashboard/profile/edit.breadcrumb_2') }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <!-- Profile Details -->
                <div class="card mb-4">
                    @include('dashboard.profile.partials.update-profile-information-form')
                </div>
                <!-- /Profile Details -->

                <!-- Update Password -->
                <div class="card mb-4">
                    @include('dashboard.profile.partials.update-password-form')
                </div>
                <!-- /Update Password -->


                <!-- Delete Account -->
                <div class="card">
                    @include('dashboard.profile.partials.delete-user-form')
                </div>
                <!-- /Delete Account -->
            </div>
        </div>
    </div>

    @include('dashboard.partials.toast')

@endsection

@push('js')

    @if(session()->has('msg'))
        <!-- Toast JS -->
        <script src="{{ asset('assets/dashboard/vendor/libs/toastr/toastr.js') }}"></script>

        <script src="{{ asset('assets/dashboard/js/ui-toasts.js') }}"></script>

        <script>
            const toastAnimationExample = document.querySelector('.toast-ex');
            // let toastAnimation;
            // if (toastAnimation) {
            //     toastDispose(toastAnimation);
            // }
            selectedType = 'bg-primary';
            selectedAnimation = 'animate__toda';

            toastAnimationExample.classList.add(selectedType, selectedAnimation);
            toastAnimation = new bootstrap.Toast(toastAnimationExample);
            toastAnimation.show();
        </script>
    @endif
@endpush

