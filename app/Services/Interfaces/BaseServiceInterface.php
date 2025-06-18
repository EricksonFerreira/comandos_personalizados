<?php

namespace App\Services\Interfaces;

interface BaseServiceInterface
{
    public function getAll();
    public function getById($id);
    public function getAllWithFiltersAndPagination($filters, $perPage = 15);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
