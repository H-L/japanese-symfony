japanese-symfony
================

![Build Status](https://travis-ci.com/H-L/japanese-symfony.svg?token=shXpjoDpc1SDKZQqur1f&branch=master)

# Installation

Requirements:
To make this work you need to use PHP 7.0 and install/launch a mysql server (via Mamp for example).

To install this repo:

```bash
# Install the project locally
git clone git@github.com:H-L/japanese-symfony.git
cd japanese-symfony
composer install

# Installing DB and update it
php app/console doctrine:database:create
php app/console doctrine:schema:update

# Launch the server
php app/console server:run
```

# Custom commands

Here is a list of custom commands we made to create/list our DB items easily :

```bash
# Create an employee
php app/console app:employee:add

# Listing employees
php app/console app:employee:list

# Create a restaurant
php app/console app:restaurant:add

# Create a timeSlot for scheduling
php app/console app:timeSlot:add
```

# Team & Collaborators

Our team is called カワイイTV (KAWAII TV ).
It is composed of 6 members:
- Blas ALVIZ
- Alexandre CHICHPORTICH
- Alexandra COSSID
- Hadrien LEPOUTRE
- Marie-Alix LESELLIER
- Raphaëlle LIMOGES