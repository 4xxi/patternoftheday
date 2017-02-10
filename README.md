# Pattern of The Day #

The app parses programming pattern catalogue and sends one of them to subscribers daily.

## Badges
![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/4xxi/patternoftheday/badges/quality-score.png?b=master)
![Code Coverage](https://scrutinizer-ci.com/g/4xxi/patternoftheday/badges/coverage.png?b=master)
![Build Status](https://scrutinizer-ci.com/g/4xxi/patternoftheday/badges/build.png?b=master)

## Requirements
* PHP 7.0 and up.

## Installation ##

1. Clone repo:
```git clone https://pluseg@github.com/4xxi/patternoftheday.git .```

2. Install dependencies via composer:
```composer install```

3. Copy config file and configure it:
```cp .env.dist .env```
  Where `slack_hook_url` is an url from Slack integrations admin panel and `slack_channel` — personal, private or public chat: `@john.doe`, `#developers`, `@general`.

4. Run application:
```php application.php```

5. Or you can add a rule in crontab. F.e. daily rule in `crontab -e`:
```0 7 * * * cd /var/www/patternoftheday && php application.php```

## License ##
MIT
