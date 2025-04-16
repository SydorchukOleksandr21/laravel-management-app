<?php

namespace App\Services\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ModelSearch
{
    private string $modelClass;

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
    }

    /**
     * Universal search for any Eloquent model by fillable or visible fields.
     *
     * @param class-string<Model> $modelClass
     * @param Request $request
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(Request $request, int $perPage = 8): LengthAwarePaginator
    {
        $query = $this->modelClass::query();

        if ($request->filled('search')) {
            $search = $request->input('search');

            /** @var Model $model */
            $model = new $this->modelClass();

            $fields = $model->getFillable() ?: $model->getVisible();

            $query->where(function ($q) use ($fields, $search) {
                foreach ($fields as $field) {
                    $q->orWhere($field, 'LIKE', "%{$search}%");
                }
            });
        }

        return $query->paginate($perPage)->appends(['search' => $request->input('search')]);
    }
}
