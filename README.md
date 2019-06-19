# prev
Path to redirect.csv file: html/framework/modules/redirect/web

Yandex Robots component files:
* interfaces:
    * IArrayData
    * IRobots
    * IRobotsParam
    * IRobotsCleanParam
    * IRobotsParamRemove
* models:
    * ArrayData
* components:
    * Robots
    * RobotsFile
    * RobotsUserAgent
    * RobotsAllow
    * RobotsDisallow
    * RobotsSitemap
    * RobotsCleanParam
    * RobotsCrawlDelay
    
## Example:
```
/** @var \app\components\Robots $robots */
$robots = Yii::$app->robots; // or $robots = new \app\components\Robots();

$robots->userAgent->addYandex();
$robots->allow->add('/site');
$robots->disallow->add('/site/map');
$robots->sitemap->add('https://example.com/site_structure/my_sitemaps1.xml');
$robots->cleanParam->add('query', '/site');
$robots->crawlDelay->add('2.0');
$robots->file->text(); // or $robots->file->append();
```

##### robots.txt:
```
User-agent: Yandex
Allow: /site
Disallow: /site/map
Sitemap: https://example.com/site_structure/my_sitemaps1.xml
Clean-param: query /site
Crawl-delay: 2.0
```

## API

### \app\components\Robots:

|Property  |Type                            |Description                        |
|----------|--------------------------------|-----------------------------------|
|file      |\app\components\RobotsFile      |Для записи в файл robots.txt       |
|userAgent |\app\components\RobotsUserAgent |Для работы с параметром User-agent |
|allow     |\app\components\RobotsAllow     |Для работы с параметром Allow      |
|disallow  |\app\components\RobotsDisallow  |Для работы с параметром Disallow   |
|sitemap   |\app\components\RobotsSitemap   |Для работы с параметром Sitemap    |
|cleanParam|\app\components\RobotsCleanParam|Для работы с параметром Clean-param|
|crawlDelay|\app\components\RobotsCrawlDelay|Для работы с параметром Crawl-delay|

|Method         |Returns                    |Description                                              |
|---------------|---------------------------|---------------------------------------------------------|
|getFile()      |\app\components\RobotsFile |Тоже самое что и file                                    |
|getUserAgent() |\app\components\UserAgent  |Тоже самое что и userAgent                               |
|getAllow()     |\app\components\Allow      |Тоже самое что и allow                                   |
|getDisallow()  |\app\components\Disallow   |Тоже самое что и disallow                                |
|getSitemap()   |\app\components\Sitemap    |Тоже самое что и sitemap                                 |
|getCleanParam()|\app\components\Clean-param|Тоже самое что и cleanParam                              |
|getCrawlDelay()|\app\components\CrawlDelay |Тоже самое что и crawlDelay                              |
|list()         |array                      |Возвращает массив, содержащий все параметры и их значения|
|clear()        |void                       |Удаляет все параметры                                    |
|disableAll()   |void                       |Добавляет параметр, запрещающий ботам доступ к сайту     |

### \app\components\RobotsFile:

|Method  |Returns|Description                                                                           |
|--------|-------|--------------------------------------------------------------------------------------|
|text()  |bool   |Записивает параметры и их значения Robots в файл robots.txt предварительно его очистив|
|append()|bool   |Записивает параметры и их значения Robots в конец файла robots.txt                    |
|clear() |bool   |Очищает файл robots.txt                                                               |

### \app\components\RobotsUserAgent:

|Method                           |Returns|Description                                                                                                           |
|---------------------------------|-------|----------------------------------------------------------------------------------------------------------------------|
|add(string $value)               |int    |Добавляет параметр User-agent со значением $value, возвращает количество параметров Robots                            |
|remove(int $index)               |bool   |Удаляет параметр User-agent под индексом $index, индекс параметра можно получить с помощью метода list() класса Robots|
|change(int $index, string $value)|bool   |Поменяет значение параметра User-agent под индексом $index на $value                                                  |
|addAll()                         |int    |Добавляет параметр User-agent со значением /, возвращает количество параметров Robots                                 |
|addYandex()                      |int    |Добавляет параметр User-agent со значением Yandex, возвращает количество параметров Robots                            |
|addYandexBot()                   |int    |Добавляет параметр User-agent со значением YandexBot, возвращает количество параметров Robots                         |
|addYandexCalendar()              |int    |Добавляет параметр User-agent со значением YandexCalendar, возвращает количество параметров Robots                    |
|addYandexDirect()                |int    |Добавляет параметр User-agent со значением YandexDirect, возвращает количество параметров Robots                      |
|addYandexDirectDyn()             |int    |Добавляет параметр User-agent со значением YandexDirectDyn, возвращает количество параметров Robots                   |
|addYandexDirectFetcher()         |int    |Добавляет параметр User-agent со значением YaDirectFetcher, возвращает количество параметров Robots                   |
|addYandexImages()                |int    |Добавляет параметр User-agent со значением YandexImages, возвращает количество параметров Robots                      |
|addYandexMarket()                |int    |Добавляет параметр User-agent со значением YandexMarket, возвращает количество параметров Robots                      |
|addYandexMedia()                 |int    |Добавляет параметр User-agent со значением YandexMedia, возвращает количество параметров Robots                       |
|addYandexMetrika()               |int    |Добавляет параметр User-agent со значением YandexMetrika, возвращает количество параметров Robots                     |
|addYandexNews()                  |int    |Добавляет параметр User-agent со значением YandexNews, возвращает количество параметров Robots                        |
|addYandexPageChecker()           |int    |Добавляет параметр User-agent со значением YandexPageChecker, возвращает количество параметров Robots                 |

### \app\components\RobotsAllow:

|Method                           |Returns|Description                                                                                                      |
|---------------------------------|-------|-----------------------------------------------------------------------------------------------------------------|
|add(string $value)               |int    |Добавляет параметр Allow со значением $value, возвращает количество параметров Robots                            |
|remove(int $index)               |bool   |Удаляет параметр Allow под индексом $index, индекс параметра можно получить с помощью метода list() класса Robots|
|change(int $index, string $value)|bool   |Поменяет значение параметра Allow под индексом $index на $value                                                  |

### \app\components\RobotsDisallow:

|Method                           |Returns|Description                                                                                                         |
|---------------------------------|-------|--------------------------------------------------------------------------------------------------------------------|
|add(string $value)               |int    |Добавляет параметр Disallow со значением $value, возвращает количество параметров Robots                            |
|remove(int $index)               |bool   |Удаляет параметр Disallow под индексом $index, индекс параметра можно получить с помощью метода list() класса Robots|
|change(int $index, string $value)|bool   |Поменяет значение параметра Disallow под индексом $index на $value                                                  |
|all()                            |void   |Добавляет параметр Disallow со значением /                                                                          |

### \app\components\RobotsSitemap:

|Method                           |Returns|Description                                                                                                        |
|---------------------------------|-------|-------------------------------------------------------------------------------------------------------------------|
|add(string $value)               |int    |Добавляет параметр Sitemap со значением $value, возвращает количество параметров Robots                            |
|remove(int $index)               |bool   |Удаляет параметр Sitemap под индексом $index, индекс параметра можно получить с помощью метода list() класса Robots|
|change(int $index, string $value)|bool   |Поменяет значение параметра Sitemap под индексом $index на $value                                                  |

### \app\components\RobotsCleanParam:

|Method                                          |Returns|Description                                                                                                      |
|------------------------------------------------|-------|-----------------------------------------------------------------------------------------------------------------|
|add(string $param, string $value)               |int    |Добавляет параметр Clean-allow со значением "$param $value", возвращает количество параметров Robots             |
|remove(int $index)                              |bool   |Удаляет параметр Allow под индексом $index, индекс параметра можно получить с помощью метода list() класса Robots|
|change(string $param, int $index, string $value)|bool   |Поменяет значение параметра Allow под индексом $index на "$param $value"                                         |

### \app\components\RobotsCrawlDelay:

|Method                           |Returns|Description                                                                                                      |
|---------------------------------|-------|-----------------------------------------------------------------------------------------------------------------|
|add(string $value)               |int    |Добавляет параметр Crawl-delay со значением $value, возвращает количество параметров Robots                            |
|remove(int $index)               |bool   |Удаляет параметр Crawl-delay под индексом $index, индекс параметра можно получить с помощью метода list() класса Robots|
|change(int $index, string $value)|bool   |Поменяет значение параметра Crawl-delay под индексом $index на $value                                                  |
