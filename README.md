# Response cache

Package is a middleware for client calls. It makes cache of current
response that is reused for all other reapeatable calls.

Library is mainly dedicated for development of web scrapers or api clients.

Package extends Guzzle6 Client

## HOW TO USE

- Register Hopinspace\Service\CacheableClient as a service, or use as a new object.
- CacheableClient injects $config thorugh constructor likewise Guzzle Client, but
it has a parameter called `requestCacheDirectory` that defaults to `/var/www/html/var/cache/responseCache`.
