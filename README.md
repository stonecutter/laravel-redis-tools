# Laravel Redis Tools

scan and delete redis keys by prefix(match).

## install

```
composer require stonecutter/laravel-redis-tools
```

## usage

```
php artisan redis:scan --match=user:*
php artisan redis:scan-and-delete --match=user:* --count=100
```
