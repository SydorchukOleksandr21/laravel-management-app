<?php

namespace App\Http\Controllers;

use App\Http\Controllers\base\Controller;
use App\Interfaces\ImageModelInterface;
use App\Services\Core\ImageModelService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ImageController extends Controller
{
    /**
     * @param string $modelName
     * @param int $modelId
     * @param string $property
     * @return BinaryFileResponse
     */
    public function show(string $modelName, int $modelId, string $property): BinaryFileResponse
    {
        // Resolve model class name (e.g. 'room-sample' -> 'App\Models\RoomSample')
        $class = 'App\\Models\\' . Str::studly($modelName);

        // Ensure the class exists and is a subclass of Model
        if (!class_exists($class) || !is_subclass_of($class, ImageModelInterface::class)) {
            abort(404, "Model '$modelName' not found.");
        }

        // Retrieve the model or fail
        $model = $class::findOrFail($modelId);

        // Check if the property exists and is accessible
        if (!array_key_exists($property, $model->getAttributes())) {
            abort(404, "Property '$property' does not exist on model '$modelName'.");
        }

        $filePath = (new ImageModelService($model))->getModelImageViewPath($property);

        return response()->file(storage_path($filePath));
    }
}
