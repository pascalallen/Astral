# Astral

![Docker Compose Build Status](https://github.com/pascalallen/Astral/workflows/Docker%20Compose/badge.svg)
![PHP Build Status](https://github.com/pascalallen/Astral/workflows/PHP/badge.svg)

Minimal PHP web development starter kit. Designed following the SOLID principles, CQRS, and DDD. Features include:

- Build Pipelines for GitHub and BitBucket
- Shell scripts for Composer, Doctrine, Docker, PHP, and PHPUnit
- Command Bus
- Doctrine ORM
- (Coming Soon) Logger
- DI Container
- Sample repository and interface
- Sample command and handler
- (Coming Soon) Sample query service dependency
- Sample aggregates
- (Coming Soon) API
- (Coming Soon) React/TypeScript frontend
- Code style config file
- EditorConfig file

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
