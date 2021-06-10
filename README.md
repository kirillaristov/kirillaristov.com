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

## Локальный запуск сайта

1. Создать локальный каталог: `mkdir c:\www\kir.com`
2. Перейти в него: `cd c:\www\kir.com`
3. Клонировать оригинальный дистрибутив: `git clone https://github.com/kirillaristov/kirillaristov.github.io.git .`
4. Запустить hugo: `hugo server`
5. Открыть в браузере адрес http://localhost:1313

## Внесение правок в локальный дистрибутив и отправка на Github

1. Проверить изменения в основном дистрибутиве на github:
* Перейти в локальный рабочий каталог: `cd c:\www\kir.com`
* Скопировать изменения в локальный рабочий каталог: `git pull`
2. Внести правки в локальные исходники.
3. Индексировать правки: `git add .`
4. Создать коммит: `git commit`
5. В открывшемся окне добавить описание правки, сохранить и закрыть окно
6. Отправить изменения на Github: `git push`
7. Авторизоваться на `github.com` (однократно при первом запуске)

## Публикация на Netlify

1. Изменения отправляются на Github в https://github.com/kirillaristov/kirillaristov.github.io
2. Автоматически копируются на Netlify в https://app.netlify.com/sites/aristov/overview
3. Автоматически собираются с параметрами, перечисленными в `config.yaml` и `netlify.toml` (если автоматическая сборка на Netlify не отключена)
4. Автоматически публикуются на https://aristov.netlify.app.
