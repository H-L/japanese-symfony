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

# Custom Commands

```bash
# Create/import Images from local dir to DB and copy images in web/uploads/images
php app/console app:add_images
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
