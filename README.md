# Pattern of The Day #

The app parses programming pattern catalogue and sends one of them to subscribers daily.

## Requirements
* PHP 7.0 and up.

## Installation ##

1. Clone repo:
```git clone https://pluseg@bitbucket.org/4xxi/patternoftheday.git patternoftheday```
2. Install dependencies via composer:
```composer install```
3. Copy config file and configure it:
```cp .env.dist .env```
  Where `slack_hook_url` is an url from Slack integrations admin panel and `slack_channel` — personal, private or public chat: `@john.doe`, `#developers`, `@general`.
3. Run application:
```php application.php```
4. Or you can add a rule in crontab. F.e. daily rule
```crontab -e
0 7 * * * cd /var/www/patternoftheday && php application.php
```