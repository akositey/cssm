<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ImageHandler
{

    /**
     * resize, store, and optimize image
     *
     * @param string $imageData
     * @param string $folder
     * @param string $filename
     * @param int|null $width
     * @return void
     */
    public function create(string $imageData, string $folder, string $filename, int $width = null): void
    {
        $storagePath = Storage::path($folder . '/' . $filename);

        # make image data
        $image = Image::make($imageData);
        # resize
        $image->resize($width ?: 150, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        # store file
        $image->save($storagePath);
        # optimize image
        $this->optimize($storagePath);

    }

    /**
     * optimize image
     *
     * @param $filePath
     * @return void
     */
    protected function optimize($filePath): void
    {
        ImageOptimizer::optimize($filePath);
    }
}
