# Назначение каталогов и файлов

* `archetypes/default.md` - заготовка нового поста
* `assets/` - сss+js файлы
* `content/` - __страницы с текстом в формате markdown__
* `data/` - содержит файл `month.yaml` с массивом месяцев для вызова `$.Site.Data.month`
* `layouts/` - __шаблоны__
  * `404/` - шаблон ошибки 404
  * `_default/` - базовые шаблоны
    * `_markup/` - содержит `render-heading.html` для `<h1>-<h6>`, `render-image.html` для `<img>`, `render-link.html` для `<a>`
    * `baseof.html` - __корневой шаблон, отсюда всё начинается__
    * `list.html` - шаблон индексного файла контента (имя которого начинается с подчеркивания `_index.md`)
    * `rss.xml` - шаблон rss-ленты
    * `single.html` - шаблон одиночного файла `index.md`
  * `blog/` - шаблоны страниц `blog/`
  * `media/` - шаблоны страниц `media/`
  * `my-routes/` - шаблоны страниц `my-routes/`
  * `partials/` - компоненты шаблонов, пример вызова `{{ partial "get-title" . }}`
  * `shortcodes/` - шаблоны коротких вставок в файлы контента `*.md`, пример вызова `{{< youtube-thumb "T2VpOYXu3vQ" >}}`
  * `taxonomy/` - шаблоны категорий и тегов
    * `term.html` - шаблон отдельной категории `(/ru/categories/as-the-first-settlers/)` и отдельного тега `(/ru/tags/2008/)`
    * `terms.html` - шаблон перечисления категорий `/ru/categories/` и перечисления тегов `/ru/tags/`
  * `index.html` - шаблон корневого индексного файла
  * `robots.txt` - файл `robots.txt` в его конечном виде
* `static/` - содержит статичные файлы и директории. При сборке корневая папка `/static` из пути удаляется
  * `dist/images/` - графика для оформления
  * `fonts/` - шрифты
  * `kml-files/` - треки
  * `map/` - __карта__
  * `static/` - неизменяемые большие файлы
    * `media/` - __фотоархив__
    * `my-routes/` - файлы из маршрутов
    * `videos/thumbs/` - превью видео
  * `favicon.ico`
  * `logo.jpg`
* `README.md` - этот файл
* `config.yaml` - конфиг `hugo`
* `index.html` - домашняя страница github pages [kirillaristov.github.io](https://kirillaristov.github.io)
* `netlify.toml` - конфиг `netlify`


# Среда локальной разработки

## Notepad++

1. Установить последнюю версию: [notepad-plus-plus.org/downloads](https://notepad-plus-plus.org/downloads) (8.3.3 на 2022-04-04)

## Git для Windows

1. Скачать последнюю версию `git` для `windows` [git-scm.com/download/win](https://git-scm.com/download/win) (2.35.1 на 2022-04-04)
2. Установить с параметрами по умолчанию
3. Перезагрузиться
4. Проверить `cmd` > `git version` 

## Hugo для Windows

1. Скачать последнюю версию `hugo` для `windows` [github.com/gohugoio/hugo/releases/latest](https://github.com/gohugoio/hugo/releases/latest) (0.96.0 на 2022-04-04)
2. Переместить `hugo.exe` из распакованного архива в `C:\Windows\System32`
3. Проверить `cmd` > `hugo version`

## Создание пустого Hugo-проекта (пропустить при наличии проекта) 

1. Создать рабочий каталог `cmd` > `mkdir d:\www\example.com`
2. Перейти в него `d:` > `cd www\example.com`
3. Сгенерировать базовый набор файлов `hugo new site` или скопировать имеющийся базовый набор
4. `git init`
5. `git add .`
6. `git commit`
7. `hugo server`
8. Внести необходимые правки
9. `git add .`
10. `git commit`
11. Создать новый публичный репозиторий на `github`
12. `git remote add origin https://github.com/example-user/example-repo.git`
13. `git branch -M main`
14. `git push -u origin main`

# Тестирование

## Клонировать оригинальный дистрибутив

1. Создать рабочий каталог `cmd` > `mkdir d:\www\kir.com`
2. Перейти в него `d:` > `cd www\kir.com`
3. Клонировать оригинальный дистрибутив<br>
`git clone https://github.com/kirillaristov/kirillaristov.com.git .`<br>
`git clone https://github.com/kirillaristov/nationaltrails.ru.git .`
4. Запустить hugo из рабочего каталога `hugo server`
5. Проверить доступность сайта на адресе [localhost:1313](http://localhost:1313)

## Внесение правок в локальную копию и тестирование

1. Проверить наличие правок в основном дистрибутиве на github:
  * Перейти в локальный рабочий каталог `cmd` > `d:` > `cd www\kir.com`
  * Скопировать правки `git pull`
2. Запустить hugo в рабочем каталоге `hugo server`
3. Внести правки в локальные исходники
4. Hugo автоматически произведет сборку - успешно или с ошибками
5. Протестировать правки на адресе [localhost:1313](http://localhost:1313)


#  Публикация

## Отправка правок на github

1. Перейти в локальный рабочий каталог `cmd` > `d:` > `cd www\kir.com`
2. Индексировать внесенные правки `git add .`
3. Создать коммит `git commit`
4. В открывшемся окне добавить описание правки, сохранить и закрыть окно
5. Отправить правку на github `git push` (однократно при первом запуске авторизоваться на `github`)

## Публикация на netlify

1. Разместить правку в [github.com/kirillaristov/kirillaristov.com](https://github.com/kirillaristov/kirillaristov.com) (через `git push` или веб-версию), затем:
2. Копируется автоматически в [app.netlify.com/sites/aristov](https://app.netlify.com/sites/aristov)
3. Собирается автоматически с параметрами, перечисленными в `config.yaml` и `netlify.toml`, расположенными в корне репозитория
4. Публикуется автоматически на [aristov.netlify.app](https://aristov.netlify.app)

## Смена источника публикаций на netlify

1. `Netlify` > `kir.com` > [`Deploys`](https://app.netlify.com/sites/aristov/deploys) > `Deploy settings` > секция `Build settings` > `Edit settings` > `Link to a different repository`

## Отключение автоматической сборки

1. `Netlify` > `kir.com` > [`Deploys`](https://app.netlify.com/sites/aristov/deploys) > `Deploy settings` > секция `Build settings` > `Edit settings` > `Stop builds`
2. На подключенную почту придет оповещение о том, что автоматическая сборка отключена

## Включение автоматической сборки

1. `Netlify` > `kir.com` > [`Deploys`](https://app.netlify.com/sites/aristov/deploys) > `Activate builds`
2. На подключенную почту придет оповещение о том, что автоматическая сборка включена и будет запущена после обновления репозитория
3. Для немедленного запуска сборки `Netlify` > `kir.com` > `Deploys` > `Trigger deploy` > `Deploy site`

## Публикация сборок

1. Если последняя сборка не опубликована, войти в сборку > `Publish deploy`
2. Включение автоматической публикации сборок `Netlify` > `kir.com` > `Deploys` > `Start auto publishing`

# Редактирование

## Добавление или редактирование пункта меню

1. Открыть файл страницы, на которую должен ссылаться пункт меню
2. Добавить в ее frontmatter:
```
menu:
  main:
    name: Имя пункта меню
    weight: Очередность вывода, цифра
```

