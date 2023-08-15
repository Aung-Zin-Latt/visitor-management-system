<?php

namespace App\DB_CRUD\Core;

use Carbon\Carbon;
use illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class Crud
{
    public function __construct(
        private Model $model,
        private ?array $data,
        private ?int $id,
        private $editMode,
        private $deleteMode,
    ) {
        $this->model = $model;
        $this->data = $data;
        $this->id = $id;
        $this->editMode = $editMode;
        $this->deleteMode = $deleteMode;
        $this->tableName = $model->getTable();
    }

    private string $imageDirectory = 'images';
    private string $tableName = '';
    private ?Model $record = null;

    public function setImageDirectory(string $directoryPath, string $tablename)
    {
        $this->imageDirectory = $directoryPath;
        $this->tableName = $tablename;
    }

    public function getData(string $model, string $id)
    {
        $modelInstance = new $model;
        return $modelInstance->findOrFail($id);
    }


    public function execute(): mixed
    {
        try {
            if ($this->id != null) {
                if (get_class($this->model) == 'App\Models\Image') {
                    $this->record = $this->model->where('link_id', $this->id)->first();
                } else {
                    $this->record = $this->model->findOrFail($this->id);
                }
            }

            if ($this->deleteMode) {
                if (get_class($this->model) == 'App\Models\Image') {
                    if ($this->record) {
                        $old_image = $this->record->upload_url;
                        Storage::delete($old_image);
                    }
                }

                if (!$this->record->delete()) {
                    return response()->json(['error' => 'Updating error!'], Response::HTTP_NO_CONTENT);
                }
                return $this->record;
            }

            if ($this->data) {
                foreach ($this->data as $column => $value) {

                    $savableField = $this->model->saveableFields()[$column];

                    switch ($savableField) {
                        case 'datetime':
                            if (!empty($value)) {
                                if ($this->editMode) {
                                    $this->record->{$column} = Carbon::parse($value)->toDateTimeString();
                                } else {
                                    $this->model->{$column} = Carbon::parse($value)->toDateTimeString();
                                }
                            }
                            break;
                        case 'image':
                            if ($this->model->getTable() === $this->tableName && !empty($value)) {
                                $imageName = Carbon::now()->timestamp . '.' . $value->extension();
                                $finalImagePath = $this->imageDirectory . $imageName;
                                if ($this->editMode) {
                                    $old_image = $this->record->{$column};
                                    Storage::delete($old_image);
                                    $value->storeAs($this->imageDirectory, $imageName);
                                    $this->record->{$column} = $finalImagePath;
                                } else {
                                    $value->storeAs($this->imageDirectory, $imageName);
                                    $this->model->{$column} = $finalImagePath;
                                }
                            }
                            break;
                        default:
                            if ($this->editMode) {
                                $this->record->{$column} = $value;
                            } else {
                                $this->model->{$column} = $value;
                            }
                    }
                }
            }
            if ($this->editMode) {
                if (!$this->record->save()) {
                    return response()->json(null, Response::HTTP_NO_CONTENT);
                }
                return $this->record;
            }

            if (!$this->model->save()) {
                return response()->json(null, Response::HTTP_NO_CONTENT);
            }
            return $this->model;
        } catch (QueryException $e) {
            //abort(404);
            return response($e->getMessage());
        }
    }
}
