<?php

namespace App\Entity;

abstract class EntityAbstract
{
    public function __get($name)
    {
        $methodName = $this->toMethod($name, 'get');
        if (!method_exists($this, $methodName)) {
            return $this->$name ?? null;
        }

        return $this->$methodName();
    }

    public function __set($name, $value)
    {
        $methodName = $this->toMethod($name, 'set');
        if (!method_exists($this, $methodName)) {
            return $this->$name = $value;
        }

        return $this->$name = $this->$methodName($value);
    }

    protected function toMethod($name, $prefix)
    {
        $name = str_replace('_', ' ', $name);
        $name = ucwords(strtolower($name));
        $name = str_replace(' ', '', $name);

        return $prefix . $name;
    }
}
