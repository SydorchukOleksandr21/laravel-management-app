<?php

namespace App\Http\Controllers\base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use ReflectionClass;

abstract class ResourceController extends Controller
{
    /**
     * Save or update a model.
     * @param Model $model
     * @param Request $request
     * @param array $validationRules
     * @param bool $isSave
     * @return Model
     * @throws ValidationException
     */
    protected function save(Model $model, Request $request, array $validationRules = [], bool $isSave = true): Model
    {
        $data = $request->only($this->getModelPublicProperties($model));

        if (!empty($validationRules)) {
            $validator = Validator::make($data, $validationRules);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        }

        $model->fill($data);

        if($isSave) {
            $model->save();
        }

        return $model;
    }

    /**
     * Delete a model and optionally its image.
     *
     * @param Model $model
     * @return JsonResponse
     */
    protected function delete(Model $model): JsonResponse
    {
        $model->delete();

        return response()->json([
            'message' => class_basename($model) . ' deleted successfully.'
        ]);
    }

    /**
     * Get all public fillable properties of a model.
     *
     * @param Model $model
     * @return array
     */
    private function getModelPublicProperties(Model $model): array
    {
        return $model->getFillable();
    }
}
