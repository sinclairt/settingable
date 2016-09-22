<?php

namespace Sinclair\Settingable\Contracts;

/**
 * Interface Setting
 * @package Sinclair\Settable\Contracts
 */
interface Setting
{
    /**
     * @return mixed
     */
    public function settingable();

    /**
     * @param $query
     * @param $key
     *
     * @return mixed
     */
    public function scopeKey( $query, $key );

    /**
     * @param $query
     * @param null $resource
     *
     * @return mixed
     */
    public function scopeType( $query, $resource = null );

    /**
     * @param $query
     * @param $resource
     *
     * @return mixed
     */
    public function scopeResource( $query, $resource );

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeGlobal( $query );
}