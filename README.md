# Назначение каталогов и файлов

* `/archetypes/default.md` - заготовка нового поста
* `/assets/` - сss+js файлы
* `/content/` - страницы с текстом
* `/data/` - содержит файл `month.yaml` с массивом месяцев для вызова `$.Site.Data.month`
* `/layouts/` - шаблоны:
  * `./404/` - шаблон 404 ошибки
  * `./_default/` - базовые шаблоны:
    * `../_markup/` - содержит `render-heading.html` для `<h1>-<h6>`, `render-image.html` для `<img>`, `render-link.html` для `<a>`
    * `../baseof.html` - корневой шаблон, отсюда всё начинается
    * `../list.html` - шаблон индексного файла контента, имя которого начинается с подчеркивания: `_index.md`
    * `../rss.xml` - шаблон rss-ленты
    * `../single.html` - шаблон одиночного файла: `index.md`
    * `../taxonomy__.html` - ?
    * `../term.html` - ?
    * `../terms.html` - ?
  * `./blog/` - шаблоны страниц `/blog`
  * `./media/` - шаблоны страниц `/media`
  * `./my-routes/` - шаблоны страниц `/my-routes`
  * `./partials/` - компоненты шаблонов, пример вызова: `{{ partial "get-title" . }}`
  * `./shortcodes/` - шаблоны коротких вставок в файлы контента `*.md`, пример вызова: `{{< youtube-thumb "T2VpOYXu3vQ" >}}`
  * `./index.html` - шаблон корневого индексного файла
  * `./robots.txt` - файл `robots.txt` в его конечном виде
* `/static/` - содержит статичные файлы, в том числе вся media. При сборке корневая папка `/static` из пути удаляется
* `README.md` - этот файл
* `config.yaml` - конфиг `hugo`
* `index.html` - индексная страница github.pages
* `netlify.toml` - конфиг `netlify`


# Среда локальной разработки

## Hugo для Windows

1. Скачать последнюю версию `hugo` для `windows`: https://github.com/gohugoio/hugo/releases/latest (0.83.1 на 2021-06-02)
2. Переместить `hugo.exe` из распакованного архива в `C:\Windows\System32`
3. Проверить: `hugo version`

## Git для Windows

1. Скачать последнюю версию `git` для `windows`: https://git-scm.com/download/win (2.31.1 на 2021-06-02)
2. Установить с параметрами по умолчанию
3. Перезагрузиться
4. Проверить: `git version`


# Тестирование

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

## Отправка правок на github

1. Перейти в локальный рабочий каталог: `cd c:\www\kir.com`
2. Индексировать внесенные правки: `git add .`
3. Создать коммит: `git commit`
4. В открывшемся окне добавить описание правки, сохранить и закрыть окно
5. Отправить правку на github: `git push` (однократно при первом запуске авторизоваться на `github.com`)

## Публикация на netlify

1. Правка отправляется в https://github.com/kirillaristov/kirillaristov.github.io (через `git push` или веб-версию), затем:
2. Копируется автоматически в https://app.netlify.com/sites/aristov
3. Собирается автоматически (автоматическую сборку можно отключить) с параметрами, перечисленными в `config.yaml` и `netlify.toml`
4. Публикуется автоматически на https://aristov.netlify.app.
