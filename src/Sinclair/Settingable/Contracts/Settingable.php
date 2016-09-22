<?php

namespace Sinclair\Settingable\Contracts;

use Sinclair\Settingable\HasSettings;

/**
 * Class Settable
 * @package Sinclair\Settable
 */
interface Settingable
{
    /**
     * @param $key
     * @param $value
     * @param null $resource
     *
     * @return mixed
     */
    public function set( $key, $value,  $resource = null );

    /**
     * @param $key
     * @param null $resource
     * @param null $default
     *
     * @return null
     */
    public function get( $key,  $resource = null, $default = null );

    /**
     * @param $key
     * @param null $resource
     *
     * @return bool
     */
    public function exists( $key,  $resource = null );
}