<?php

namespace App\Repositories;

use App\DB_CRUD\Core\Crud;
use App\Contracts\CheckinInterface;
use App\Models\CheckIn;

class CheckinRepository implements CheckinInterface
{
    protected CheckIn $model;
    public function __construct(CheckIn $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model::paginate(10);
    }

    public function store(array $data)
    {
        return (new Crud($this->model, $data, null, false, false))->execute();
    }

    public function update(array $data, int $id)
    {
        return (new Crud($this->model, $data, $id, true, false))->execute();
    }

    public function delete(int $id)
    {
        return (new Crud($this->model, null, $id, false, true))->execute();
    }
}
