@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="mb-3 text-center">
                @if(isset($article))
                    {{ sprintf('%s: %s', __('Edit'), $article->name) }}
                @else
                    {{ __('Add New Article') }}
                @endif
            </h1>

            @include('partials.articles.articles-form')

        </div>
    </div>
</div>
@endsection
