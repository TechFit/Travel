# Travel

> Developed on Symfony 4

## **How to start locally:**

1. Run composer
composer install

2. Run migrations
php bin/console doctrine:migrations:migrate

3. Start server
php bin/console server:run


## **Available routes:** 

- http://……./activities/
Will return all activities

- http://……./activities/popular/1/
Will return only the activities that have “popular = 1” 

- http://……./activities/category/music/
Will return all activities that are in category “music” 

- http://……./activities/maxprice/30/
Will return all activities that their maximum price is 30

- All requests above support pagination /20/0 
- All requests above support ordering information /priceOrder/asc or desc 
- Default is price desc. 

