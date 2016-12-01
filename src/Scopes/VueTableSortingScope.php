<?php

namespace Riesjart\VueTable\Scopes;

use Closure;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class VueTableSortingScope implements Scope
{
    /**
     * @var Closure|null
     */
    protected $default;

    /**
     * @var string
     */
    protected $inputKey;


    /**
     * Create a new VueTableSortingScope instance.
     *
     * @param Closure|null $default
     * @param string $inputKey
     */
    public function __construct($default = null, $inputKey = 'sort')
    {
        $this->default = $default;

        $this->inputKey = $inputKey;
    }


    /**
     * @inheritdoc
     */
    public function apply(Builder $query, Model $model)
    {
        $input = $this->input();

        $query->when($input, function (Builder $query) use ($input) {

            $sortings = array_filter(explode(',', $input));

            foreach ($sortings as $sorting) {

                list($column, $direction) = explode('|', $sorting);

                if ( ! (Str::contains($column, '.') || Str::startsWith($column, '_'))) {

                    $column = $query->getModel()->getTable() . '.' . $column;
                }

                $query->orderBy($column, $direction);
            }

            if ($this->default) {

                call_user_func($this->default, $query);
            }
            
            return $query;

        }, $this->default);
    }


    /**
     * @return mixed
     */
    protected function input()
    {
        $request = Container::getInstance()->make('request');

        return $request->input($this->inputKey);
    }
}
