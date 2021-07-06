# Astral

TODO: Project description here

## Prerequisites

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## Development Environment Setup

### Clone Repository

$ `cd <projects-parent-directory> && git clone git@github.com:pascalallen/astral.git`

### Copy & Modify .env File

$ `cp .env.dist .env`

### Bring Up Environment

$ `bin/up`

### Install Composer Dependencies

$ `bin/composer install`

### Create Schema

$ `bin/doctrine orm:schema-tool:create`

### Run Unit Tests

$ `bin/phpunit`

### Take Down Environment

$ `bin/down`

#### Code Style

Code style configuration file for PhpStorm is available for import: [CodeStyle.xml](etc/build/CodeStyle.xml)

[Copying Code Style Settings](https://www.jetbrains.com/help/phpstorm/copying-code-style-settings.html)
