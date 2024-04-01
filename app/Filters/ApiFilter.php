<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{

    // params that can be queried
    protected $safeParams = [];

    // mapping params to actual db name
    protected $columnMap = [];

    // transform the operators from query string to what eloquent will need
    protected $operatorMap = [];

    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}