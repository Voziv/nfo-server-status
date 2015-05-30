NFO Server Status/Query Page Parser
===================================

NFO Server Status is a project designed to parse query pages on NFO servers so that you can add your own server statuses on your site or manipulate/track the data.

Installation
------------
Install using [Composer](https://getcomposer.org):

```php
{
    "require": {
        "lrobert/nfo-server-status": "0.1.*"
    }
}
```

### Note On Specifying Versions
The project is still in it's developmental stage, hence the major version
number remaining at 0.  The rules of [semantic versioning](http://semver.org/)
state that changes to the minor number should not break backwards
compatibility, however, during these early stages that cannot be guaranteed.
But changes to the patch number _will_ remain backwards compatible.  As such it is
recommended to specify version numbers where the minor number remains a
constant.  If in doubt, just use the version number specified in the example
above.

Once the project reaches a stable 1.0.0, the regular rules of semantic
versioning will come into play.

Usage
-----
```php
use lrobert\NFOServerStatus\Murmur\MurmurStatusService;

$murmurStatusService = new MurmurStatusService();

$status = $murmurStatusService->getStatus("example_identifier");

echo $status->getOnline(); // false since example_identifier does not exist

/**
  * See MurmurStatusModel, MurmurChannelModel, and MurmurClientModel on how you can get access to the data
  */
```