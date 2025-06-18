<?php

namespace App\Helpers;

use App\DTO\BreadcrumbItem;

class BreadcrumbHelper
{
    /**
     * Generate a breadcrumb array.
     *
     * @param BreadcrumbItem[] $items Array of BreadcrumbItem objects.
     * @return array
     */
    public static function generate(array $items): array
    {
        $breadcrumb = [];
        foreach ($items as $item) {
            $breadcrumb[] = [
                'name' => $item->getName(),
                'url' => $item->getUrl()
            ];
        }
        return $breadcrumb;
    }
}
