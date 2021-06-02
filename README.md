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

1. Создать каталог `C:\hugo\kir.com`
2. Запустить консоль Win+R -> cmd
3. Перейти в `cd C:\hugo\kir.com`
4. Клонировать оригинальный дистрибутив в `C:\hugo\kir.com`: `git clone https://github.com/kirillaristov/kirillaristov.github.io.git .`
5. Запустить hugo в `C:\hugo\kir.com`: `hugo server`
6. Открыть в браузере адрес http://localhost:1313

## Публикация на Netlify

1. Контент расположен в https://github.com/kirillaristov/kirillaristov.github.io
2. Настройки публикации на Netlify расположены в `netlify.toml`
3. После изменения контента на Github, изменения автоматически копируются и собираются на Netlify (если автоматическая сборка на Netlify не отключена)
