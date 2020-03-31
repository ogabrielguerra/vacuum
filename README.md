# VACUUM
Db-less website framework based on json files. Vacuum is different from static generated websites. You can treat it like static files and still counting with some conveniences like template cache and flexible routing.

Powered by a template system (Twig) and a routing system (Fast Route), Vacuum can be fast and extremely versatile.
You can, for example extend it with a Control Panel or generating json content from other CMS's.

## WORDPRESS TO STATIC
If you would like to turn your Wordpress into Json files, please take a look at this project: https://github.com/ogabrielguerra/wordpress-to-static-files 

## FEATURES

Vacuum supports almost all the features a regular blog woud do.
* Categories
* Pages
* Posts
* Tags
* Media
 

## DOCKERIZED
Give it a shot with Docker. Just run: 
```
docker-compose up -d
```
In your browser go to http://localhost/public_html/

## TESTS
We have a couple of basic tests. 

```
docker exec app-vacuum appVacuum/vendor/bin/phpunit appVacuum/tests/
```
