# Среда для локальной разработки

## Hugo для Windows

1. Скачать последнюю версию hugo для windows: https://github.com/gohugoio/hugo/releases/latest (0.83.1 на 2021-06-02)
2. Скопировать файл hugo.exe из скачанного архива в `C:\Windows\System32`
3. Проверить работоспособность: Win+R -> cmd -> `hugo version`

## Git для Windows

1. Скачать последнюю версию git для windows: https://git-scm.com/download/win (2.31.1 на 2021-06-02)
2. Запустить скаченный *.exe
3. Установить с параметрами по умолчанию
4. Перезагрузиться
5. Проверить: Win+R -> cmd -> `git version`

## Локальный запуск сайта

1. Создать каталог `C:\www\kir.com`
2. Открыть консоль и перейти в `cd C:\www\kir.com`
3. Клонировать оригинальный дистрибутив: `git clone https://github.com/kirillaristov/kirillaristov.github.io.git .`
4. Запустить hugo в `C:\www\kir.com`: `hugo server`
5. Открыть в браузере адрес http://localhost:1313

## Публикация на Netlify

1. Контент расположен в https://github.com/kirillaristov/kirillaristov.github.io
2. Настройки публикации на Netlify расположены в `netlify.toml`
3. После изменения контента на Github, изменения автоматически копируются и собираются на Netlify (если автоматическая сборка на Netlify не отключена)
