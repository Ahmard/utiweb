# UtiWeb
A web-based version of [UtiClass](http://github.com/Ahmard/uticlass)

# Installation
Make sure that you have [composer](https://getcomposer.org) installed in your machine

Clone this repository
```bash
git clone https://github.com/Ahmard/utiweb.git
```
Navigate to the project directory and run below command
```bash
composer install
```
Now, install database table for saving messages
```bash
php migrate.php
```

Start the server
```bash
php -S localhost:8181 -t public
```

Now visit **http://localhost:8181** in your web browser.

You can also see [how the project works](HOW_IT_WORKS.md).

Help keep this project alive by adding new features or fixing bugs.

**_Enjoy 😉_**

### References
- [UtiClass](http://github.com/Ahmard/uticlass)
- [QuickRoute](https://github.com/Ahmard/quick-route)

### Licence
**UtiWeb** is _MIT_ licenced.