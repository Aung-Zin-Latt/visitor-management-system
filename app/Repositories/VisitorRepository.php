<?php

namespace App\Repositories;

use App\DB_CRUD\Core\Crud;
use App\Contracts\VisitorInterface;
use App\Models\Visitor;

class VisitorRepository implements VisitorInterface
{
    protected Visitor $model;
    public function __construct(Visitor $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        // return Visitor::paginate(10);
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
