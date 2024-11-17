## Comands

```
docker exec -it stg_wordpress_container wp --info

docker exec -it stg_wordpress_container wp acorn --allow-root

docker exec -it stg_wordpress_container wp acorn package:discover --allow-root

docker exec -it stg_wordpress_container wp acorn cache:clear --allow-root

docker exec -it stg_wordpress_container wp acorn vendor:publish --tag="acf-composer" --allow-root

docker exec -it stg_wordpress_container wp acorn vendor:publish --provider="Log1x\Poet\PoetServiceProvider" --allow-root


```