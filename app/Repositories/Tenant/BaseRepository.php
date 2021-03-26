<?php

namespace App\Repositories\Tenant;

abstract class BaseRepository
{
    public $model;

    /**
     * @param array $filters
     * @param bool $paginated
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll($filters = [], $paginated = true) {
        $model = $this->model;
        return ($paginated ? $model->paginate(\Config::get('constants.ITEMS_PER_PAGE')) : $model->all());
    }

    /**
     * @param $value
     * @param string $column
     * @param array $filters
     * @param array $with
     * @param string $select
     * @param array $whereIn
     * @return mixed
     */
    public function getOne($value, $column = 'id', $filters = [], $with = [], $select = '*',$whereIn = []) {

        $model = $this->model->where($column, $value);
        foreach ($filters as $col => $val) {
            $model = $model->where($col, $val);
        }

        // WhereIn filters
        foreach ($whereIn as $col => $val) {
            $model = $model->whereIn($col, $val);
        }

        // get specific
        $model = $model->with($with)
            ->select($select)
            ->first();
        return $model;
    }

    /**
     * @param array $info
     * @return mixed
     */
    public function store(array $info) {
        return $this->model->create($info);
    }

    /**
     * @param $params
     * @param $value
     * @param string $column
     * @param array $filters
     * @return mixed
     * @internal param $id
     */

    public function update($params, $value, $column = 'id', $filters = [])
    {
        $model = $this->model->where($column, $value);
        foreach ($filters as $col => $val) {
            $model = $model->where($col, $val);
        }
        return $model->update($params);
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id) {
        return $this->model->destroy($id);
    }

    /**
     * @param array $filters
     * @return int
     * @internal param $params
     */
    public function countAll($filters = []) {
        $model = $this->model->select('id');
        return $model->count();
    }
}
