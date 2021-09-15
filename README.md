# Astral

![Docker Compose Build Status](https://github.com/pascalallen/Astral/workflows/Docker%20Compose/badge.svg)
![PHP Build Status](https://github.com/pascalallen/Astral/workflows/PHP/badge.svg)

Minimal PHP web development starter kit. Designed from scratch following the SOLID principles, CQRS, and DDD. Features include:

- Fully containerized application
- Build Pipelines for GitHub and BitBucket
- Shell scripts for Composer, Doctrine, Docker, PHP, Logs, and PHPUnit
- Command Bus
- Event Dispatcher
- Doctrine ORM
- Logger w/ streams to Papertrail and php://stdout
- (Coming Soon) Queue
- DI Container
- Sample repository and interface
- Sample command and handler
- Sample event and listener
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

### Tail Logs

$ `bin/logs -f`

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
