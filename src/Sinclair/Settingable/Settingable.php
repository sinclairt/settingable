<?php

namespace Sinclair\Settingable;

use Sinclair\Settingable\Contracts\Setting;

/**
 * Class Settingable
 * @package Sinclair\Settingable
 */
class Settingable implements Contracts\Settingable
{
    /**
     * @var Setting
     */
    private $setting;

    /**
     * Settable constructor.
     *
     * @param Setting $setting
     */
    public function __construct( Setting $setting )
    {
        $this->setting = $setting;
    }

    /**
     * @param $key
     * @param $value
     * @param mixed|null $resource
     *
     * @return mixed
     */
    public function set( $key, $value, $resource = null )
    {
        $setting = $this->save($key, $value, $resource);

        return $setting->exists;
    }

    /**
     * @param $key
     * @param null $resource
     * @param null $default
     *
     * @return null
     */
    public function get( $key, $resource = null, $default = null )
    {
        $result = $this->getRow($key, $resource);

        if ( is_null($result) )
            return $default;

        $value = $result->value;

        if ( is_callable($value) )
            return call_user_func($value);

        return sizeof($value) > 1 ? $value : head($value);
    }

    /**
     * @param $key
     * @param null $resource
     *
     * @return bool
     */
    public function exists( $key, $resource = null )
    {
        return !is_null($this->getRow($key, $resource));
    }

    /**
     * @param $key
     * @param null $resource
     *
     * @return mixed
     */
    private function getRow( $key, $resource = null )
    {
        return $this->setting->key($key)
                             ->type($resource)
                             ->first();
    }

    /**
     * @param $key
     * @param $value
     * @param $resource
     *
     * @return mixed
     */
    protected function save( $key, $value, $resource = null )
    {
        $setting = $this->getRow($key, $resource);

        $value = is_array($value) ? $value : [ $value ];

        return is_null($setting) ? $this->create($key, $value, $resource) : $this->update($value, $setting);
    }

    /**
     * @param $key
     * @param $value
     * @param null $resource
     *
     * @return mixed
     */
    protected function create( $key, $value, $resource = null )
    {
        $attributes = compact('key', 'value');

        if ( !is_null($resource) )
        {
            $attributes[ 'settingable_type' ] = get_class($resource);
            $attributes[ 'settingable_id' ] = $resource->id;
        }

        return $this->setting->create($attributes);
    }

    /**
     * @param $value
     * @param Setting $setting
     *
     * @return mixed
     */
    protected function update( $value, Setting $setting )
    {
        $setting->update(compact('value'));

        return $setting;
    }
}