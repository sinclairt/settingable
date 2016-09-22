<?php

if ( !function_exists('setting') )
{
    /**
     * @param $args
     *
     * @return \Sinclair\Settingable\Contracts\Settingable|bool|mixed
     */
    function setting( $args = null )
    {
        if ( is_string($args) )
            return app('Settingable')->get($args);

        if ( is_array($args) && sizeof($args) >= 2 )
            return app('Settingable')->set(array_get($args, 0), array_get($args, 1), array_get($args, 2));

        return app('Settingable');
    }
}