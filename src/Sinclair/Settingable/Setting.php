<?php

namespace Sinclair\Settingable;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @package Sinclair\Settable
 */
class Setting extends Model implements Contracts\Setting
{
    /**
     * @var array
     */
    protected $fillable = [ 'key', 'value', 'settingable_id', 'settingable_type' ];

    /**
     * @var array
     */
    protected $casts = [
        'value' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function settingable()
    {
        return $this->morphTo();
    }

    /**
     * @param $query
     * @param $key
     *
     * @return mixed
     */
    public function scopeKey( $query, $key )
    {
        return $query->where('key', $key);
    }

    /**
     * @param $query
     * @param null $resource
     *
     * @return mixed
     */
    public function scopeType( $query, $resource = null )
    {
        return is_null($resource) ? $this->scopeGlobal($query) : $this->scopeResource($query, $resource);
    }

    /**
     * @param $query
     * @param $resource
     *
     * @return mixed
     */
    public function scopeResource( $query, $resource )
    {
        return $query->where('settingable_type', get_class($resource))
                     ->where('settingable_id', $resource->id);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeGlobal( $query )
    {
        return $query->whereNull('settingable_type')
                     ->whereNull('settingable_id');
    }
}