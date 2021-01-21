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
php -S localhost:8181
```

Now visit **http://localhost:8181** in your web browser.

**_Enjoy!!!_**

### References
- [UtiClass](http://github.com/Ahmard/uticlass)
- [QuickRoute](https://github.com/Ahmard/quick-route)

### Licence
**UtiWeb** is _MIT_ licenced.