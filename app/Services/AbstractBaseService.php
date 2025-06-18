<?php

namespace App\Services;

use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

abstract class AbstractBaseService implements BaseServiceInterface
{
    protected Model $model;

    public function getAll($where = [])
    {
        return $this->model->where($where)->get();
    }

    public function getAllForSelect($key = 'id', $value = 'nome')
    {
        return $this->formatArraySelect($this->model->all(), $key, $value);
    }

    public function getAllWithFiltersAndPagination($filters = [], $perPage = 15, $with = [], $orderBy = 'id', $order = 'asc')
    {

        $query = $this->model->with($with);

        if (!empty($filters)) {
            foreach ($filters as $field => $value) {
                if (isset($value['typeWhere']) && $value['typeWhere'] == 'where')
                    $query->where($field, $value['valor']);
                else
                    $query->where($field, 'like', '%' . $value['valor'] . '%');
            }
        }

        $query->orderBy($orderBy, $order);

        return $query->paginate($perPage);
    }

    public function getById($id, $with = [])
    {
        return $this->model->with($with)->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $item = $this->model->find($id);
        if ($item) {
            $item->update($data);
            return $item;
        }
        return null;
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        if ($item) {
            return $item->delete();
        }
        return false;
    }

    // Método abstrato para definir o modelo nas classes filhas
    abstract public function setModel(Model $model): void;

    public function formatArraySelect($data, string $idField = 'id', string $nameField = 'name'): array
    {
        $arrayData = $data->toArray();
        return array_column($arrayData, $nameField, $idField);
    }

    public function getAllAtivosForSelectSubText($id = 'id', $nome = 'nome', $subtitle = '', $orderBy = null, $orderDirection = 'asc')
    {
        if($subtitle == ''){
            throw new \Exception('Subtitle não pode ser vazio');
        }

        $query = $this->model->select($id, $nome, $subtitle)->where('ativo', 'S');

        $query = $query->distinct();

        if (Schema::hasColumn($this->model->getTable(), 'ativo')) {
            $query->where('ativo', 'S');
        }
        if ($orderBy) {
            $query->orderBy($orderBy, $orderDirection);
        }

      return $query->get();

    }
    public function formatArraySelectSubText($data, string $idField = 'id', string $nameField = 'name'): array
    {
        $arrayData = $data->toArray();
        return array_column($arrayData, $nameField, $idField);
    }
    public function getAllAtivos($id = 'id', $nome = 'nome', $orderBy = null, $orderDirection = 'asc')
    {

        $query = $this->model->select($id, $nome)->where('ativo', 'S')->distinct();

        if (Schema::hasColumn($this->model->getTable(), 'ativo')) {
            $query->where('ativo', 'S');
        }
        if ($orderBy) {
            $query->orderBy($orderBy, $orderDirection);
        }

        $data = $query->get();

        return $this->formatArraySelect($data, $id, $nome);
    }
    public function getAllFormatSelect($id = 'id', $nome = 'nome', $orderBy = null, $orderDirection = 'asc')
    {
        $query = $this->model->select($id, $nome)->distinct();

        if ($orderBy) {
            $query->orderBy($orderBy, $orderDirection);
        }

        $data = $query->get();
        return $this->formatArraySelect($data, $id, $nome);
    }
}
