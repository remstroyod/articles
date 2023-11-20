@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1 class="mb-3">{{ __('Home Page') }}</h1>

                @guest
                    @include('auth.login')
                @else

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

                    @include('partials.articles.articles-list')
                @endguest

            </div>
        </div>
    </div>
@endsection
