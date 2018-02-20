# Laravel KillSwitch

As web professionals it's a sad fact that some clients just don't want to pay once your hard-work goes live, you need 
leverage.  In it's basic implementation, KillSwitch is a custom module that will make a HTTP GET request to a 
specified URL, if that request returns `true` in the body of the request then the switch is activated and the site 
placed into maintenance mode.

If for some reason the URL cannot be reached (404, 50x etc) then the plugin will fail silently and assume normal 
website operations, your application is NOT dependant on this URL to function.

### Setup

* Install via composer `composer require bagwaa/killswitch`
* Add `KillSwitch\Providers\KillSwitchServiceProvider::class` to the providers array in  `config\app.php`
* Publish the configuration file with sensible defaults `php artisan vendor:publish` 

### Configuration

After publishing the configuration file you should modify this to your situation, the config file can be found
in `config/killswitch.php`
 
#### url
 
The url that will be queried on each request, if the contents of this URL contain the word 'true' then the kill switch 
is activated and the Laravel application will be put into maintenance mode.
 
#### timeout (seconds)
 
Making a HTTP request to an external server may be something that concerns you, here we can set a sensible timeout
value, if no response is returned within the timeout limit then the request will timeout silently and the application
will continue to function correctly.
 
### What does the end result look like?
 
Whilst it's tempting to present a message stating that a site has been taken offline do to lack of payment, the default
maintenance mode view will be displayed.
  
![KillSwitch Demo](http://i.imgur.com/OUAG8KA.png)


