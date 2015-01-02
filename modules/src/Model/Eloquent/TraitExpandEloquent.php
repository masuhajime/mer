<?php namespace Mer\Model\Eloquent;

trait TraitExpandEloquent
{
    public static function getValidator($params)
    {
        if (isset(self::$messages)) {
            return \Validator::make($params, self::$rules, self::$messages);
        } else {
            return \Validator::make($params, self::$rules);
        }
    }
    
    public static function firstByAttributesOrFail(array $attributes)
    {
        $app = self::firstByAttributes($attributes);
        if (is_null($app)) {
            throw new \RuntimeException("\Mer\Model\Application not found: " . print_r($attributes, 1));
        }
        return $app;
    }
}
