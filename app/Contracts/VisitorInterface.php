<?php

namespace App\Contracts;
interface VisitorInterface
{
    /* Contracts or Interface is some kind of restricting standard format */
    /* This is called magic signature */

    public function all();
    public function store(array $data);
    public function update(array $data, int $id);
    public function delete(int $id);
    // public function find(array $data, int $id);
}
