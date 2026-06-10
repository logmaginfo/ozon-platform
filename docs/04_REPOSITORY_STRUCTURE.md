# 04_REPOSITORY_STRUCTURE.md

# OZON_PLATFORM

Версия: 1.1

Статус: Approved Draft

---

# 1. Назначение документа

Документ определяет:

* структуру репозиториев;
* структуру директорий;
* правила размещения файлов;
* правила веток Git;
* правила релизов.

Все участники проекта обязаны соблюдать данный документ.

---

# 2. Общая структура платформы

Платформа состоит из трех независимых проектов.

PROJECT A

WordPress Plugin FREE

---

PROJECT B

WordPress Plugin PRO

---

PROJECT C

License Portal

---

Каждый проект имеет собственный репозиторий.

---

# 3. Репозитории

Используются следующие репозитории.

---

Repository 1

ozon-plugin-free

---

Repository 2

ozon-plugin-pro

---

Repository 3

ozon-license-portal

---

Запрещено смешивать код разных проектов в одном репозитории.

---

# 4. Репозиторий FREE

Структура:

```text
ozon-plugin-free/

├── assets/
│
├── includes/
│
├── admin/
│
├── templates/
│
├── languages/
│
├── uninstall.php
│
├── readme.txt
│
└── ozon-plugin-free.php
```

---

# 5. Структура FREE

assets

Статика.

---

admin

Все административные страницы.

---

includes

Бизнес-логика.

---

templates

HTML-шаблоны.

---

languages

Локализация.

---

Запрещено создавать новые директории без необходимости.

---

# 6. Репозиторий PRO

Структура:

```text
ozon-plugin-pro/

├── assets/
│
├── includes/
│
├── admin/
│
├── templates/
│
├── languages/
│
├── uninstall.php
│
├── readme.txt
│
└── ozon-plugin-pro.php
```

---

PRO обязан максимально повторять структуру FREE.

---

# 7. Репозиторий PORTAL

Структура:

```text
ozon-license-portal/

├── app/
│
├── public/
│
├── storage/
│
├── database/
│
├── resources/
│
├── routes/
│
├── config/
│
└── docs/
```

---

# 8. Документация

Каждый репозиторий содержит папку:

```text
/docs
```

В ней хранятся:

* Product Docs
* API Docs
* Release Notes
* Changelog

---

# 9. Правило файлов

Запрещено создавать файлы:

```text
test2.php
new.php
helper2.php
temp.php
```

---

Название файла должно отражать назначение.

Примеры:

```text
class-ozon-client.php
class-license-client.php
class-product-export.php
```

---

# 10. Правило классов

Один файл = один основной класс.

---

Разрешено:

```text
class-ozon-client.php

class Ozon_Client
```

---

Запрещено:

```text
10 классов в одном файле
```

---

# 11. Правило функций

Запрещено создавать:

```text
utils.php
functions.php
helpers.php
```

как место хранения всего подряд.

---

Каждая функция должна относиться к конкретному модулю.

---

# 12. Разделение ответственности

FREE отвечает только за:

* Ozon API
* Категории
* Атрибуты
* Публикацию

---

PRO отвечает только за:

* Очереди
* Автоматизацию
* Массовые операции
* Лицензионные функции

---

PORTAL отвечает только за:

* Лицензии
* Платежи
* Пользователей
* Обновления

---

# 13. Git Flow

Используются ветки:

main

production-код.

---

develop

текущая разработка.

---

feature/*

отдельные задачи.

Пример:

```text
feature/product-export
feature/license-check
feature/order-import
```

---

# 14. Коммиты

Каждая задача = отдельный коммит.

Примеры:

```text
Add Ozon categories sync

Add license validation

Fix task status check
```

---

Запрещено:

```text
fix

update

changes

test
```

---

# 15. Pull Requests

Каждая новая функция:

feature
↓
review
↓
merge

---

Прямые коммиты в main запрещены.

---

# 16. Релизы

Используется схема:

```text
MAJOR.MINOR.PATCH
```

Пример:

```text
1.0.0
1.1.0
1.1.1
```

---

# 17. CHANGELOG

Каждый релиз обязан содержать:

```text
Added
Changed
Fixed
Removed
```

---

# 18. Документация изменений

Перед реализацией новой функции необходимо обновить:

* Product Docs
* Roadmap
* Changelog

---

После реализации документация обновляется повторно.

---

# 19. Запрещено

Запрещено:

* перемещать файлы без причины;
* переименовывать файлы ради красоты;
* создавать новые директории без необходимости;
* дублировать код между FREE и PRO;
* хранить временные файлы в репозитории.

---

# 20. Общая стратегия развития

Сначала:

FREE v1.0

---

Затем:

PRO v1.0

---

Затем:

PORTAL v1.0

---

Любое отклонение требует отдельного архитектурного решения.

---

# 21. Definition of Success

Репозиторий считается правильно организованным если:

* новый разработчик понимает структуру за 15 минут;
* OpenHands способен находить нужные файлы без поиска по всему проекту;
* каждая функция имеет очевидное место расположения;
* структура остается понятной через несколько лет развития проекта.
