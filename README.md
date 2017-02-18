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
#if you just want an empty database
php app/console doctrine:database:create
php app/console doctrine:schema:update

#We also created a command to initialise a little work database :
php app/console app:initialise:db

# Launch the server : will sync assets and lauch symfony server
gulp sync

#Just the symfony server
php app/console server:run

#Just the assets
gulp watch
```
# Front End
The project works sass and gulp. The views are in Resources/views and the scss files are in Resources/scss.
After running `gulp sync`, scss files with compile automatically.

For views, public site views are in Resources/views/default. All views extends scss/base.html.twig, which contains header and footer.
A folder by page is done, with a main file page/page.html.twig, and optionnal other views. This other views of /page must be included in the main file.

# Commits
Commit messages must follow this guide : [gitmoji | An emoji guide for your commit messages](https://gitmoji.carloscuesta.me/)
with in addtion :pray: for merge conflict commits.

you can also add brackets to precise the subject of the commit.
exemple : `git commit -m ":lipstick: [maid-page] made css for search bar"`

# Branches
Call uour branches with clear, short names. You can add a 'flag' to indicate the purpose of the branch :
-New : new feature
-Fix : fixing a bug
-Hotfix : critical quick fix

exemple : `git checkout -b New-Maid_entity`

# Test Users
The command `php app/console app:initialise:db` creates two test users.

username : testUser
email : test@user.com
password : testpass

username : adminUser
email : adminUser@user.com
password : adminpass

# Custom commands

Here is a list of custom commands we made to create/list our DB items easily :

```bash
# Create a Maid
php app/console app:maid:add

# Listing Maids
php app/console app:maid:list

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