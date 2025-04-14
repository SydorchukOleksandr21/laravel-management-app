<?php

namespace App\Services\Core;

use App\Interfaces\ImageModelInterface;
use Exception;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;

class ImageModelService
{
    /**
     * @var ImageModelInterface
     */
    private ImageModelInterface $imageModel;

    /**
     * @param ImageModelInterface $imageModel
     */
    public function __construct(ImageModelInterface $imageModel)
    {
        $this->imageModel = $imageModel;
    }

    /**
     * @return Repository|Application|mixed|object|null
     */
    private function getPrefixPath(): mixed
    {
        return config('filesystems.paths.prefix');
    }

    /**
     * @param string $imagePropertyName
     * @throws Exception
     */
    private function checkProperty(string $imagePropertyName): void
    {
        if (!array_key_exists($imagePropertyName, $this->imageModel->getImageProperties())) {
            throw new Exception("Image property '$imagePropertyName' not found");
        }
    }

    /**
     * Returns a full path to load an image on frontend.
     * @param string $imagePropertyName
     * @return string
     */
    public function getModelImageViewPath(string $imagePropertyName): string
    {
        return $this->getPrefixPath() .
            DIRECTORY_SEPARATOR .
            $this->imageModel->getDirectoryPath() .
            DIRECTORY_SEPARATOR .
            $this->imageModel->$imagePropertyName;
    }

    /**
     * Returns a path where image will be saved.
     * @param string $imagePropertyName
     * @return string
     * @throws Exception
     */
    public function getModelImageSavePath(string $imagePropertyName): string
    {
        $this->checkProperty($imagePropertyName);

        return
            $this->imageModel->getDirectoryPath() .
            DIRECTORY_SEPARATOR .
            $this->imageModel->getImageProperties()[$imagePropertyName]["name"];
    }

    /**
     * Returns the name of image that were saved.
     * Name should be put into the database row with sake key name.
     * @param string $imagePropertyName
     * @param string $base64Image
     * @return string|null
     * @throws Exception
     */
    public function storeBase64Image(string $imagePropertyName, string $base64Image): ?string
    {
        $this->checkProperty($imagePropertyName);

        try {
            // Extract the file extension
            preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches);

            if (!isset($matches[1])) {
                return null;
            }

            $extension = $matches[1];
            $imageData = substr($base64Image, strpos($base64Image, ',') + 1);
            $imageData = base64_decode($imageData);

            // Generate unique filename
            $fileName = $this->imageModel->getImageProperties()[$imagePropertyName]["name"] . '.' . $extension;

            // Store the image
            Storage::put($this->imageModel->getDirectoryPath() . DIRECTORY_SEPARATOR . $fileName, $imageData);

            return $fileName;
        } catch (\Exception $e) {
            return null;
        }
    }
}
