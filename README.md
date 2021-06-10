# Структура каталогов

* `/archetypes/default.md` - шаблон нового поста
* `/assets` - сss+js файлы
* `/content` - страницы с текстом
* `/data` - содержит файл `month.yaml` с массивом месяцев для вызова `$.Site.Data.month`
* `/layouts/404` - шаблон 404 ошибки
  * `/layouts/_default/_markup/` - шаблоны для элементов разметки: `render-heading.html` для заголовков `<h1>-<h6>`, `render-image.html` для изображений img, `render-link.html` для ссылок `<a>`
  * `/layouts/_default/baseof.html` - отсюда все начинается, корневой шаблон
  * `/layouts/_default/list.html` - шаблон для индексного файла контента, имя которого начинается с подчеркивания: `_index.md`
* `/layouts/_default/rss.xml` - шаблон для rss-ленты
* `/layouts/_default/single.html` - шаблон для одиночного файла: `index.md`
* `/layouts/_default/taxonomy__.html` - ?
* `/layouts/_default/term.html` - ?
* `/layouts/_default/terms.html` - ?
* `/layouts/blog/` - шаблоны для страниц `/blog`
* `/layouts/media/` - шаблоны для страниц `/media`
* `/layouts/my-routes/` - шаблоны для страниц `/my-routes`
* `/layouts/partials/` - компоненты шаблонов, например: `{{ partial "get-title" . }}`
* `/layouts/shortcodes/` - шаблоны для коротких вставок в файлы контента `*.md`, например: `{{< youtube-thumb "T2VpOYXu3vQ" >}}`
* `/layouts/index.html` - шаблон для корневого индексного файла
* `/layouts/robots.txt` - файл `robots.txt` в его конечном виде
* `/static` - содержит статичные файлы, в том числе вся media. При сборке корневая папка `/static` из пути удаляется
* `README.md` - этот файл
* `config.yaml` - конфиг `hugo`
* `index.html` - индексная страница для github.pages
* `netlify.toml` - конфиг `netlify`


# Среда для локальной разработки

## Hugo для Windows

1. Скачать последнюю версию `hugo` для `windows`: https://github.com/gohugoio/hugo/releases/latest (0.83.1 на 2021-06-02)
2. Переместить `hugo.exe` из распакованного архива в `C:\Windows\System32`
3. Проверить: `hugo version`

## Git для Windows

1. Скачать последнюю версию `git` для `windows`: https://git-scm.com/download/win (2.31.1 на 2021-06-02)
2. Установить с параметрами по умолчанию
3. Перезагрузиться
4. Проверить: `git version`


# Локальное тестирование

## Первый запуск локальной копии сайта

1. Создать локальный каталог: `mkdir c:\www\kir.com`
2. Перейти в него: `cd c:\www\kir.com`
3. Клонировать оригинальный дистрибутив: `git clone https://github.com/kirillaristov/kirillaristov.github.io.git .`
4. Запустить hugo: `hugo server`
5. Проверить доступность сайта на адресе http://localhost:1313

## Внесение правок в локальную копию и тестирование

1. Проверить наличие правок в основном дистрибутиве на github:
  * Перейти в локальный рабочий каталог: `cd c:\www\kir.com`
  * Скопировать правки: `git pull`
2. Запустить hugo: `hugo server`
3. Внести правки в локальные исходники
4. Hugo автоматически произведет сборку - успешно или с ошибками
5. Протестировать правки на адресе http://localhost:1313


#  Публикация

## Отправка проверенных правок на github

1. Перейти в локальный рабочий каталог: `cd c:\www\kir.com`
2. Индексировать внесенные правки: `git add .`
3. Создать коммит: `git commit`
4. В открывшемся окне добавить описание правки, сохранить и закрыть окно
5. Отправить правку на github: `git push`
* Авторизоваться на `github.com` (однократно при первом запуске)

## Автоматическая публикация на netlify

1. Правка отправляется в https://github.com/kirillaristov/kirillaristov.github.io (через `git push` или веб-версию), затем:
2. Копируется автоматически в https://app.netlify.com/sites/aristov
3. Собирается автоматически (автоматическую сборку можно отключить) с параметрами, перечисленными в `config.yaml` и `netlify.toml`
4. Публикуется автоматически на https://aristov.netlify.app.
