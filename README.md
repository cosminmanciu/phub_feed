## Task
- You will need to write a program that downloads all the items in https://www.pornhub.com/files/json_feed_pornstars.json (the feed is updated daily) and cache images within each asset. To make it efficient, it is desired to only call the URLs in the JSON file only once. Demonstrate, by using a framework of your choice, your software architectural skills. How you use the framework will be highly important in the evaluation.

- How you display the feed and how many layers/pages you use is up to you, but please ensure that we can see the complete list and the details of every item. You will likely hit some road blocks and errors along the way, please use your own initiative to deal with these issues, it’s part of the test.

- Please ensure all code is tested before sending it back, it would be good to also see unit tests too. "The code base should be provided as a zip package or git repository url . Ideally, the application must be deployable using Docker, otherwise we cannot guarantee the successful run of the application.
## Requirements:
- mysql:8.0.33
- php:8.2
- redis:latest
- nginx:1.21

## Features
- Symfony App 6.1.12
- One Import command for storing data in db .
- 2 related Entities, One for Actors and one for Images
- A service with Redis for caching images.
- Pagination bundle added also.
- 2 Unit Tests

## How to run the project

- Open git terminal
- `git clone https://github.com/cosminmanciu/phub_feed.git`
- `cd .docker`
- `docker-compose up -d`
- Connect to Docker PHP container 
- `composer install`
- `php bin/console doctrine:schema:update --force`
- `php bin/console app:feed-import`
- Go to route http://127.0.0.1/actors

- To run Unit Tests
- `php -d memory_limit=2048M vendor/bin/phpunit --no-coverage`

