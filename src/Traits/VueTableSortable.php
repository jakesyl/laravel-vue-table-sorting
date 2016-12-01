<?php

namespace Riesjart\VueTable\Traits;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Riesjart\VueTable\Scopes\VueTableSortingScope;

trait VueTableSortable
{
    /**
     * @param Builder $query
     * @param Closure|null $default
     * @param string $inputKey
     *
     * @return void
     */
    public function scopeOrderByVueTable(Builder $query, $default = null, $inputKey = 'sort')
    {
        $query->withGlobalScope('vueTableSorting', new VueTableSortingScope($default, $inputKey));
    }
}
