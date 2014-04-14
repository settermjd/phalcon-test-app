#!/bin/bash

##
## A simple script to install Phalcon and the Phalcon devtools.
##
## Written by: Matthew Setter <matthew@maltblue.com>
##
## I've tried a number of options, but have not found any of them
## to always work. So this one was written for users to run themselves
## manually, installing the phalcon extension and the phalcon devtools
## in a running Debian or Ubuntu based virtual machine.
##

if [ -d cphalcon ]; then
    echo Updating Phalcon Working Copy
    # update the working copy, if it already exists
    cd cphalcon; git pull; cd -;
else
    echo Cloning Phalcon Repository
    git clone --depth=1 https://github.com/phalcon/cphalcon.git
fi;

if [ -d cphalcon ]; then

    # check if Phalcon's already available

    echo Installing Phalcon
    cd cphalcon/build
    sudo ./install
    cd -;

    PHALCON_CONFIG=/etc/php5/mods-available/20-phalcon.ini;

    if [ ! -e $PHALCON_CONFIG ]; then
        sudo bash -c 'echo extension=phalcon.so > /etc/php5/mods-available/20-phalcon.ini';
    fi;

    if [ ! -e /etc/php5/apache2/conf.d/20-phalcon.ini ]; then
        sudo ln -s $PHALCON_CONFIG /etc/php5/apache2/conf.d/20-phalcon.ini
    fi;

    if [ ! -e /etc/php5/cli/conf.d/20-phalcon.ini ]; then
        sudo ln -s $PHALCON_CONFIG /etc/php5/cli/conf.d/20-phalcon.ini
    fi;

fi;

echo Restarting Apache
sudo /etc/init.d/apache2 restart
echo

## Run composer because it has support for the Phalcon devtools
echo Installing Phalcon devtools support
composer install
echo

echo done. Exiting
exit;