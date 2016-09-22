<?php

class Dummy extends \Illuminate\Database\Eloquent\Model
{
    use \Sinclair\Settingable\HasSettings;

    protected $fillable = [ 'name' ];

    public function someCallBack()
    {
        return 'Hooray!';
    }
}