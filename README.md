# kirillaristov.github.io

# Подготовка среды

## Hugo для Windows 7/10

1. Открыть страницу с последней версией Hugo: https://github.com/gohugoio/hugo/releases/latest (на 2 июня 2021 года последняя версия 0.83.1/64bit)
2. Скачать версию для windows (32 или 64-битную)
3. Скопировать файл hugo.exe из скачанного архива в папку `C:\Windows\System32`
4. Проверить: Win+R -> cmd -> `hugo version`

## Git для Windows 7/10

1. Скачать последнюю версию git: https://git-scm.com/download/win (https://github.com/git-for-windows/git/releases/latest) (на 2 июня 2021 года последняя версия 2.31.1/64bit)
2. Установить с параметрами по умолчанию
3. Перезагрузиться
4. Проверить: Win+R -> cmd -> `git version`

## Запуск Hugo

1. Создать каталог C:\hugo\kir.com
2. Запустить консоль Win+R -> cmd
3. Перейти в каталог hugo: `cd C:\hugo\kir.com`
4. Клонировать оригинальный дистрибутив `git clone https://github.com/kirillaristov/kirillaristov.github.io.git .`
5. Запустить hugo из текущего каталога C:\hugo\kir.com: `hugo server`
6. Открыть браузер на адресе http://localhost:1313
