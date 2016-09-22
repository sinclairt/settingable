<?php

require_once 'Models/Dummy.php';

function some_function()
{
    return 'Hooray!';
}

class SettingTest extends DbTestCase
{
    public function testSet()
    {
        $this->assertTrue(setting([ 'my_key', 'my_value' ]));

        $this->assertTrue(app('Settingable')->set('my_key', 'my_value'));

        $dummy = new Dummy([ 'id' => 1 ]);

        $this->assertTrue(app('Settingable')->set('my_key', 'my_value', $dummy));

        $this->assertTrue(app('Settingable')->set('my_key', 'my_value', $dummy));

        $this->assertTrue(app('Settingable')->set('my_array_key', [ 'foo', 'bar' ]));

        $this->assertTrue(setting([ 'my_resource_key', 'my_value', $dummy ]));
    }

    public function testGet()
    {
        setting([ 'my_key', 'my_value' ]);

        $this->assertEquals('my_value', setting('my_key'));

        $this->assertEquals('my_value', app('Settingable')->get('my_key'));

        $dummy = new Dummy([ 'id' => 1 ]);

        app('Settingable')->set('my_other_key', 'my_other_value', $dummy);

        $this->assertEquals('my_other_value', app('Settingable')->get('my_other_key', $dummy));

        $this->assertEquals('my_default_value', app('Settingable')->get('my_non_existent_key', $dummy, 'my_default_value'));

        app('Settingable')->set('my_array_key', [ 'foo', 'bar' ]);

        $this->assertEquals([ 'foo', 'bar' ], setting('my_array_key'));

        $this->assertEquals([ 'foo', 'bar' ], app('Settingable')->get('my_array_key'));

        app('Settingable')->set('my_resource_array_key', [ 'foo', 'bar' ], $dummy);

        $this->assertEquals([ 'foo', 'bar' ], app('Settingable')->get('my_resource_array_key', $dummy));
    }

    public function testExists()
    {
        setting([ 'my_key', 'my_value' ]);

        $this->assertTrue(setting()->exists('my_key'));

        $this->assertFalse(setting()->exists('my_non_existent_key'));

        $dummy = new Dummy([ 'id' => 1 ]);

        setting(['my_resource_key', 'my_value', $dummy]);

        $this->assertTrue(setting()->exists('my_resource_key', $dummy));

        $this->assertFalse(setting()->exists('my_key', $dummy));
    }
}