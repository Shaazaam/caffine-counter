<?php

namespace App\Traits;

use ReflectionClass;

trait Reflects
{
    public static function getClassName()
    {
        $fqClass = get_called_class();
        return substr($fqClass, strrpos($fqClass, '\\') + 1);
    }

    private function getReflection()
    {
        return new ReflectionClass($this);
    }

    private static function getReflectionStatic($class)
    {
        return new ReflectionClass($class);
    }

    public function getFillable(): array
    {
        return $this->fillable;
    }

    public function hasAttribute($attribute)
    {
        return in_array($attribute, $this->fillable);
    }

    public function hasMethod($method)
    {
        return $this->getReflection()->hasMethod($method);
    }

    public static function hasMethodStatic($method)
    {
        return self::getReflectionStatic(get_called_class())->hasMethod($method);
    }

    public function hasTrait($trait)
    {
        return in_array($trait, class_uses($this));
    }

    public static function hasTraitStatic($trait)
    {
        return in_array($trait, class_uses(get_class()));
    }

    public function implements($interface)
    {
        return $this->getReflection()->implementsInterface($interface);
    }

    public static function implementsStatic($interface)
    {
        return self::getReflectionStatic(get_called_class())->implementsInterface($interface);
    }
}
