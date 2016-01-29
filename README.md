PhilipsHueWebApp
================

A Symfony project created on January 27, 2016, 2:45 pm.

## Setting Up The Development Environment ##

This project uses Vagrant (http://www.vagrantup.com) to crete a virtual server and configure it for you... so get vagrant!

* Clone the repo...
* Run `vagrant up` to build the virtual server and have it configured.
* When it's done, you get into the box by running `vagrant ssh`
* The first time you run vagrant up... you'll want to run this to install the required dependencies

```
    cd /vagrant
    composer install
```

    
* After this point, you may just need to run `vagrant provision` at later points to have your environment fully setup with new content/etc

You can now access your environment at `http://localhost:8080/app_dev.php`