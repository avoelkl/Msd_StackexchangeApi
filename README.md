Msd_StackexchangeApi
================
[![Code Climate](https://codeclimate.com/github/avoelkl/Msd_StackexchangeApi/badges/gpa.svg)](https://codeclimate.com/github/avoelkl/Msd_StackexchangeApi)

This extension implements the Stackexchange API for Magento used for [MageStackDay](http://www.magestackday.com).

Facts
-----
- works with Stack Exchange API V2.2

To Do's
-----
* Include update functions for user data (non-statistic)
* Improve error handling
* refactor Msd_StackexchangeApi_Client
* Configure site to track (currently 'magento' hardcoded)


Features
-----------
* Authentication via customer account
* Statistics (updated every 30 min via cronjob): http://yourdomain.com/stackexchange
* View registered user list via http://yourdomain.com/stackexchange/user/list
* Cronjob to update statistics data of authenticated users every 30 min

Description
-----------
tbd

Usage
-----
1. Register your StackApps application at http://stackapps.com/apps/oauth/register
2. Install extension.
3. Configue Stack App-Data via System > Configuration > Magestackday > StackExchange API

Compatibility
-------------
- Tested with Magento 1.9.1.0

Support
-------
If you have any issues with this extension, open an issue on GitHub (see URL above)

Contribution
------------
Any contributions are highly appreciated. The best way to contribute code is to open a
[pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Developer
---------
Anna Völkl  
[http://anna.voelkl.at](http://anna.voelkl.at)  
[@rescueAnn](https://twitter.com/rescueAnn)

Licence
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

Copyright
---------
(c) 2015 Anna Völkl
