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

<form class="row" action="{{ isset($article) ? route('articles.update', $article) : route('articles.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group col-12 mb-3">
        <input name="name" id="name" class="form-control" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', isset($article) ? $article->name : null) }}" />
        @error('name')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-12 mb-3">
        <textarea name="content" id="content" class="form-control" cols="30" rows="10" placeholder="{{ __('Content') }}">{{ old('content', isset($article) ? $article->content : null) }}</textarea>
        @error('content')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-12 mb-5">
        <div>
            @if(request()->has('unsplashImage'))
                <img src="{{ url(sprintf('storage/%s', request()->get('unsplashImage'))) }}" alt="" title="">
                <input type="hidden" value="{{ request()->get('unsplashImage') }}" name="image">
            @else
                <img src="{{ url(sprintf('storage/%s', isset($article) ? $article->image : $image)) }}" alt="" title="">
                <input type="hidden" value="{{ isset($article) ? $article->image : $image }}" name="image">
            @endif

        </div>
        @isset($article)
            <div class="pt-3">
                <a href="{{ request()->fullUrlWithQuery(['refresh' => 'image']) }} " class="btn btn-success">{{ __('Refresh Image') }}</a>
            </div>
        @endisset
    </div>

    <div class="form-group col-12">
        <button type="submit" class="btn btn-primary btn-lg">{{ __('Save') }}</button>
        <a href="{{ route('home') }}" class="btn btn-info btn-lg">{{ __('Cancel') }}</a>
    </div>



</form>
