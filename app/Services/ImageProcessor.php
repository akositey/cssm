<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ImageProcessor
{
    /**
     * @var mixed
     */
    private $image;

    /**
     * @var mixed
     */
    private $image_data;

    /**
     * @var mixed
     */
    private $folder;

    /**
     * @var mixed
     */
    private $storagePath;

    /**
     * resize image to this width
     * @var int
     */
    private $width = 150;

    /**
     * @var mixed
     *
     */
    public function __construct(String $image_data, String $folder, string $filename, String $width = null)
    {
        $this->image_data = $image_data;
        $this->folder = $folder;
        $this->storagePath = Storage::path($folder . '/' . $filename);
        $this->width = $width ?? $this->width;

    }

    /**
     * process the image and store the file
     *
     * @return void
     */
    public function save()
    {
        $this->resize();
        $this->store();
        $this->optimize();
    }

    public function store()
    {
        //create directory
        Storage::makeDirectory($this->folder);

        $this->image->save($this->storagePath);
    }

    /**
     * resize width
     * then store image
     *
     * @return \Intervention\Image\Image
     */
    public function resize()
    {
        $image = Image::make($this->image_data);
        $image->resize($this->width, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $this->image = $image;
    }

    /**
     * optimize image
     *
     * @return void
     */
    public function optimize()
    {
        ImageOptimizer::optimize($this->storagePath);
    }
}
