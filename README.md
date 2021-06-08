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
2. Скопировать файл `hugo.exe` из скачанного архива в `C:\Windows\System32`
3. Проверить: `hugo version`

## Git для Windows

1. Скачать последнюю версию `git` для windows: https://git-scm.com/download/win (2.31.1 на 2021-06-02)
2. Установить с параметрами по умолчанию
3. Перезагрузиться
4. Проверить: `git version`

## Локальный запуск сайта

1. Создать каталог: `mkdir c:\www\kir.com`
2. Перейти: `cd c:\www\kir.com`
3. Клонировать оригинальный дистрибутив: `git clone https://github.com/kirillaristov/kirillaristov.github.io.git .`
4. Запустить hugo: `hugo server`
5. Открыть в браузере адрес http://localhost:1313

## Внесение правок в локальный дистрибутив и отправка на github

1. Перейти: `cd c:\www\kir.com`
2. Проверить изменения: `git pull`
3. Внести правки и сохранить
4. Индексировать правки: `git add .`
5. `git commit`
6. В открывшемся окне добавить описание правки, сохранить и закрыть окно
7. Отправить изменения: `git push`
8. Авторизоваться на `github.com` (однократно при первом запуске)

## Публикация на Netlify

1. Контент расположен в https://github.com/kirillaristov/kirillaristov.github.io
2. После изменения контента на Github, изменения автоматически копируются и собираются на Netlify (если автоматическая сборка на Netlify не отключена)
3. Настройки публикации на Netlify расположены в `netlify.toml`
