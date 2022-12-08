<?php
namespace App\Repositories;

use App\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    protected $relations;

    public function __construct(Model $model, array $relations = [])
    {
        $this->model = $model;
        $this->relations = $relations;
    }
    public function all()
    {
        $query = $this->model;
        if (!empty($this->relations)) {
            $query = $query->with($this->relations);
        }
        return $query->get();
    }

    public function get(int $id)
    {
        return $this->model->find($id);
    }

    public function save(Model $model)
    {
        $model->save();
        return $model;
    }

    public function delete(Model $model)
    {
        $model->delete();
        return $model;
    }
}
