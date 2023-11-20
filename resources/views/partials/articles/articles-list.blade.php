@can('isAdmin')
    @include('partials.articles.articles-admin-panel')
@endcan

@if( $articles->count() )
    <table class="table mt-5">
        <thead>
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Image') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Content') }}</th>
            @can('isAdmin')
                <th>{{ __('Operations') }}</th>
            @endcan
        </tr>
        </thead>
        <tbody>
        @foreach( $articles as $item )
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    @if($item->image && Storage::disk('public')->exists( $item->image ))
                        <img src="{{ url(sprintf('storage/%s', $item->image)) }}" alt="" width="100">
                    @endif
                </td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->content }}</td>
                @can('isAdmin')
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('articles.edit', $item) }}" class="btn btn-info">
                                {{ __('Edit') }}
                            </a>
                            <a href="javascript:;" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('destroy-article-{{ $item->id }}').submit();">
                                {{ __('Remove') }}
                            </a>
                            <form id="destroy-article-{{ $item->id }}" action="{{ route('articles.destroy', $item) }}" class="d-none" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                    </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $articles->withQueryString()->links('pagination::bootstrap-5') !!}

@else
    <p class="pt-5">{{ __('No articles have been created yet') }}</p>
@endif
