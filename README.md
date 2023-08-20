## MINTOS Home assignment

### Setup

1. Clone repository
2. Create `.env` file from `.env.example` and fill important values, specially DB connection and RSS configuration
```
RSS_URL=https://www.delfi.lv/rss/?channel=delfi
RSS_CACHE_LENGTH=60
RSS_ITEMS_COUNT=20
```
3. Run `composer install`
4. Run `./vendor/bin/sail up -d' to start docker container
5. Run `./vendor/bin/sail artisan migrate' to create DB structure
6. Run `npm run dev' to start vite
7. Project is ready to start by opening http://localhost

### Tests

To run tests use `./vendor/bin/sail artisan test`
Tests expect vite is running
