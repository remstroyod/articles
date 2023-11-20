<?php
namespace App\Queries;

use Illuminate\Database\Eloquent\Builder;

class ArticlesQuery extends Builder
{

    public function filter(): self
    {

        if( request()->has('user') && request()->filled('user') )
        {
            $this->where('user_id', request()->get('user'));
        }

        return $this;

    }

}
