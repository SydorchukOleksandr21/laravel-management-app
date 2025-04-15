<?php

namespace App\Http\Controllers;

use App\Interfaces\ImageModelInterface;
use App\Services\Core\ImageModelService;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ImageController extends Controller
{
    /**
     * @param ImageModelInterface $imageModel
     * @param string $property
     * @return BinaryFileResponse
     */
    public function show(ImageModelInterface $imageModel, int $modelId, string $property): BinaryFileResponse
    {
        $filePath = (new ImageModelService($imageModel))->getModelImageViewPath($property);

        return response()->file(storage_path($filePath));
    }
}
