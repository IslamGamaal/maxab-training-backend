<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class Repository implements IRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->query()->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    // show the record with the given id
    public function find($id)
    {
        return $this->model->query()->find($id);
    }
}