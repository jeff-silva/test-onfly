<?php

namespace App\Traits;

use Illuminate\Support\Fluent;

trait ModelSearchTrait
{
  public function searchParams()
  {
    return [];
  }

  public function searchQuery($query, $params)
  {
    return $query;
  }

  public function scopeSearch($query, array $params = [])
  {
    $params = $this->searchGetParams($params);
    return $query;
  }

  public function scopeSearchPaginate($query, array $params = [])
  {
    $params = $this->searchGetParams($params);
    $query = $this->searchQuery($query, $params);

    list($orderBy, $order) = explode(':', $params->order);
    $query->orderBy($orderBy, $order);
    $paginate = new Fluent($query->paginate($params->per_page)->toArray());

    return [
      'params' => $params,
      'data' => $paginate->data,
      'pagination' => [
        'pages' => $paginate->last_page,
        'results' => $paginate->total,
      ],
    ];
  }

  protected function searchGetParams(array $params = [])
  {
    return new Fluent(array_merge([
      'page' => 1,
      'per_page' => 10,
      'order' => 'id:desc',
    ], $this->searchParams(), $params));
  }
}
