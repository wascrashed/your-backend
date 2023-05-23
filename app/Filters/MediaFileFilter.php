<?php

namespace App\Filters;

class MediaFileFilter extends QueryFilter
{
    public function orderByDate($orderBy = 'desc')
    {
        return $this->builder->orderBy('created_at', $orderBy);
    }

    public function fileType($fileType = '')
    {
        if ($fileType) {
            $this->builder->whereFileType($fileType);
        }
    }
}
