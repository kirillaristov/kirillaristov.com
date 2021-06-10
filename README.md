# Структура каталогов

* archetypes - шаблон нового поста
* assets - сss+js файлы
* content - страницы с текстом
* data - содержит файл month.yaml с массивом месяцев для вызова $.Site.Data.month
* layouts - шаблоны
* static - все статичные файлы, в том числе вся media
* README.md - этот файл
* config.yaml - конфиг Hugo
* index.html - страница для github.pages
* netlify.toml - конфиг Netlify

# Среда для локальной разработки

## Hugo для Windows

1. Скачать последнюю версию `hugo` для windows: https://github.com/gohugoio/hugo/releases/latest (0.83.1 на 2021-06-02)
2. Переместить `hugo.exe` из распакованного архива в `C:\Windows\System32`
3. Проверить: `hugo version`

## Git для Windows

1. Скачать последнюю версию `git` для windows: https://git-scm.com/download/win (2.31.1 на 2021-06-02)
2. Установить с параметрами по умолчанию
3. Перезагрузиться
4. Проверить: `git version`

# Локальное тестирование и публикация

## Первый запуск локальной копии сайта

1. Создать локальный каталог: `mkdir c:\www\kir.com`
2. Перейти в него: `cd c:\www\kir.com`
3. Клонировать оригинальный дистрибутив: `git clone https://github.com/kirillaristov/kirillaristov.github.io.git .`
4. Запустить hugo: `hugo server`
5. Проверить доступность сайта на адресе http://localhost:1313

## Внесение правок в локальную копию и их тестирование

1. Проверить наличие правок в основном дистрибутиве на github:
  * Перейти в локальный рабочий каталог: `cd c:\www\kir.com`
  * Скопировать правки: `git pull`
2. Запустить hugo: `hugo server`
3. Внести правки в локальные исходники
4. Протестировать правки на адресе http://localhost:1313

## Отправка протестированных правок на github

1. Индексировать внесенные правки: `git add .`
2. Создать коммит: `git commit`
3. В открывшемся окне добавить описание правки, сохранить и закрыть окно
4. Отправить правку на github: `git push`
5. Авторизоваться на `github.com` (однократно при первом запуске)

## Публикация на Netlify

1. Отправить правки в https://github.com/kirillaristov/kirillaristov.github.io (через веб-версию или `git push`)
2. Копируется автоматически в https://app.netlify.com/sites/aristov
3. Собирается автоматически с параметрами, перечисленными в `config.yaml` и `netlify.toml` (автоматическую сборку можно отключить)
4. Публикуется автоматически на https://aristov.netlify.app.
