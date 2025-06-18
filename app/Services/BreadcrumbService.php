<?php

namespace App\Services;

use App\Helpers\BreadcrumbHelper;
use App\DTO\BreadcrumbItem;

class BreadcrumbService
{
    public function prepararBreadcrumb(array $items)
    {
        return BreadcrumbHelper::generate($items);
    }

    public function prepararBreadcrumbUnico(string $indexName)
    {
        $items = $this->buildBreadcrumbItems([
            [$indexName, null],
        ]);
        return $this->prepararBreadcrumb($items);
    }
    public function prepararBreadcrumbIndex(string $indexName)
    {
        $items = $this->buildBreadcrumbItems([
            ['Home', route('home')],
            [$indexName, null],
        ]);
        return $this->prepararBreadcrumb($items);
    }

    public function prepararBreadcrumbCreate(string $indexName, string $routeName, string $createName)
    {
        $items = $this->buildBreadcrumbItems([
            ['Home', route('home')],
            [$indexName, route($routeName)],
            [$createName, null],
        ]);
        return $this->prepararBreadcrumb($items);
    }

    public function prepararBreadcrumbEdit( string $indexName,string $routeName, string $editName)
    {
        $items = $this->buildBreadcrumbItems([
            ['Home', route('home')],
            [$indexName, route($routeName)],
            [$editName, null],
        ]);
        return $this->prepararBreadcrumb($items);
    }

    private function buildBreadcrumbItems(array $itemsData)
    {
        $items = [];
        foreach ($itemsData as $itemData) {
            $items[] = new BreadcrumbItem($itemData[0], $itemData[1] ?? null);
        }
        return $items;
    }
}
