#Settable

###Installation
* Make sure you have access to the WTBI team inside Bitbucket. 
* Make sure your have this code block inside your `composer.json` file:
```
"repositories": [
    {
      "type": "composer",
      "url": "http://satis.wtbidev.co.uk"
    }
  ]
```
* Run `composer require sinclair/settable`.
* Register `Sinclair\Settable\SettableServiceProvider::class` in `config\app.php` inside the `providers` array.
* Run `composer dump-autoload`
* Run `php artisan vendor:publish`. This wil publish the migration for the settings.
* Run `php artisan migrate`

###Usage

Settings can be global or resource specific, for global settings, the `$myObject` in the examples below can be omitted or set to null, otherwise include the object whose setting you need.

#####Get
Shorthand: `settable('some_key')` *will return the 'some_key' value. This will only return global settings, use the alternative method for resource settings*

Alternative: `app('Settable')->get('some_key', $myObject, 'my_default')`

It will check whether the value is a callback and return the value of the callback. 

#####Set
Shorthand: `settable(['some_key', 'some_value'])` *will set the 'some_key' key to 'some_value' and return boolean. This will only return global settings, use the alternative method for resource settings*

Alternative: `app('Settable')->set('some_key', 'my_value', $myObject)`

#####Exists
`app('Settable')->exists('some_key', $myObject)` *returns boolean*

