<?php

namespace GetCandy\Api\Core\Scaffold;

use Traversable;

abstract class AbstractCriteria
{
    /**
     * The id of the category we want to narrow down
     *
     * @var string
     */
    protected $id;

    /**
     * The array of ids to query for
     *
     * @var array
     */
    protected $ids = [];

    /**
     * The eager loaded includes
     *
     * @var array
     */
    protected $includes = [];

    /**
     * Set a limit to the number of resources returned
     */
    protected $limit;

    public function __call($field, $arguments)
    {
        $method = 'set' . ucfirst($field);
        if (method_exists($this, $method)) {
            $this->{$method}(...$arguments);
        } else if (property_exists($this, $field)) {
            if (count($arguments) <= 1) {
                $this->{$field} = $arguments[0] ?? null;
            } else {
                $this->{$field} = $arguments;
            }
        }
        return $this;
    }


    /**
     * Set the includes to eager load
     *
     * @param array|string $arrayOrString
     * @return void
     */
    public function include($arrayOrString = [])
    {
        if (is_string($arrayOrString)) {
            $arrayOrString = array_map('trim', explode(',', trim($arrayOrString)));
        }
        $this->includes = $arrayOrString;
        return $this;
    }

    public function blank($fields)
    {
        if (!$fields instanceof Traversable) {
            $fields = collect([$fields]);
        }

        foreach ($fields as $field) {
            $this->{$field} = null;
        }

        return $this;
    }

    /**
     * Get the first result from the query
     *
     * @return \Illuminate\Support\Collection
     */
    public function first()
    {
        return $this->getBuilder()->first();
    }
}