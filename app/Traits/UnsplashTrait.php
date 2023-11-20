<?php
namespace App\Traits;

use Illuminate\Support\Facades\Log;
use MarkSitko\LaravelUnsplash\Facades\Unsplash;

trait UnsplashTrait
{

    /**
     * @return string|null
     */
    public function getUnsplashImage(): ?string
    {

        try {

            $image = Unsplash::randomPhoto()
                ->orientation('landscape')
                ->term('articles')
                ->randomPhoto()
                ->store();

            return $image ? sprintf('%s.%s', $image, 'jpg') : null;

        } catch (\Throwable $e) {

            Log::error(sprintf('File - %s Line - %s | Unsplash Error: %s', __FILE__, __LINE__, $e->getMessage()));
            return null;
        }

    }

}
