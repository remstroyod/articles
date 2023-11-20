<?php
namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadFileTrait
{

    /**
     * @param string $ext
     * @param string $dir
     * @return string
     */
    private function generateFileName(string $ext, string $dir): string
    {

        $hash = strtolower(Str::random(30));

        $file_name = sprintf('%s.%s', $hash, $ext);

        if( Storage::disk('public')->exists(sprintf('%s/%s', $dir, $file_name)) ) return $this->generateFileName($ext, $dir);

        return sprintf('%s.%s', $hash, $ext);
    }

    /**
     * @param $request
     * @param string $dir
     * @param string|null $filename
     * @return string|null
     */
    public function uploadFile($request, string $dir = 'images', string $filename = null): ?string
    {

        try {

            if ($request->hasFile('image'))
            {

                $newFileName = $this->generateFileName($request->file('image')->extension(), $dir);

                $path = Storage::disk('public')->putFileAs(
                    $dir,
                    $request->file('image'),
                    $newFileName
                );

                return $path ? $newFileName : $filename;

            }

            return $filename;

        } catch (\Throwable $e) {

            Log::error(sprintf('File - %s Line - %s | Upload Image Error: %s', __FILE__, __LINE__, $e->getMessage()));
            return null;
        }

    }

}
