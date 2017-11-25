<?php

namespace App\Engine;

class Store
{
    private $bag = [];

    public function put($result, $index = false)
    {
        if ($index) {
            $this->bag[$index] = $result;
        } else {
            $this->bag[] = $result;
        }

        return $this;
    }

    public function all()
    {
        return $this->bag;
    }

    public function fetch()
    {
        return next($this->bag);
    }

    public function get($index)
    {
        return (isset($this->bag[$index]) ? $this->bag[$index] : null);
    }

    public function first()
    {
        $bag = $this->bag;
        return array_shift(array_slice($bag, 0, 1));
    }

    public function last()
    {
        $bag = $this->bag;
        return end($bag);
    }
}