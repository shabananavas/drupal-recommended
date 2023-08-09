INTRODUCTION
------------
This repo contains the codebase for Gesso's Drupal test environment.
Used for testing and development of Gesso's Drupal integrations.

REQUIREMENTS
------------

- Lando installed

INSTALLATION
------------

Install dependencies
- `composer install`

Start lando
- `lando start`

Install Drupal
  - Import DB from lagoon main environment (The only environment)
    - `lando drush sql-sync @lagoon.main @self`
  - Alternatively, install a fresh Drupal site
    - `lando drush site-install`

CONFIGURATION
-------------
- N/A

LAGOON DEPLOYMENT
-----------------
Deployments are controlled via `main` branch, merges to main will trigger a deploy.

See the docs for [lagoonizing a project](https://git.acromedia.com/acro/code/standards/-/wikis/lagoonize)

### Lagoon Deployment Rollout Tasks

If you created you project using acromedia/drupal-recommended your site will come with rollout tasks setup but commented out.
The reason for this is they will not work until you have setup the DB.


See `.lagoon.yml`
