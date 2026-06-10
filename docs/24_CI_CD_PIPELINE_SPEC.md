# 24_CI_CD_PIPELINE_SPEC.md

# OZON PLATFORM v1.1

CI/CD Pipeline Specification

Версия: 1.0.0

Статус: DevOps Specification

---

# 1. Назначение

Документ описывает:

* процессы сборки;
* тестирования;
* релизов;
* публикации;
* деплоя.

---

# 2. Главная цель

Любое изменение кода должно автоматически проходить:

```text
Build
↓
Test
↓
Package
↓
Deploy
```

---

Без ручных действий.

---

# 3. Инструмент CI/CD

Используется:

```text
GitHub Actions
```

---

# 4. Репозитории

PROJECT A

```text
ozon-plugin-free
```

---

PROJECT B

```text
ozon-plugin-pro
```

---

PROJECT C

```text
ozon-platform
```

---

# 5. Основные ветки

```text
main
develop
feature/*
hotfix/*
```

---

# 6. Правило веток

main

```text
только стабильный код
```

---

develop

```text
текущая разработка
```

---

feature/*

```text
новая функция
```

---

hotfix/*

```text
критическое исправление
```

---

# 7. Pull Request Policy

Любая доработка:

```text
feature/*
↓
Pull Request
↓
develop
```

---

Прямые commit в main запрещены.

---

# 8. Pipeline FREE Plugin

Запускается при:

```text
push
pull_request
```

---

# 9. Этапы FREE Pipeline

```text
Checkout
↓
Composer Install
↓
PHP Lint
↓
PHPStan
↓
Unit Tests
↓
Build ZIP
```

---

# 10. Результат FREE Pipeline

Создается:

```text
ozon-plugin-free.zip
```

---

# 11. Pipeline PRO Plugin

Запускается:

```text
push
pull_request
```

---

# 12. Этапы PRO Pipeline

```text
Checkout
↓
Composer Install
↓
Lint
↓
PHPStan
↓
Tests
↓
Version Check
↓
Build ZIP
```

---

# 13. Результат PRO Pipeline

Создается:

```text
ozon-plugin-pro.zip
```

---

# 14. Pipeline Platform

PROJECT C

---

Запускается:

```text
push
pull_request
```

---

# 15. Этапы Platform Pipeline

```text
Checkout
↓
Install Dependencies
↓
Lint
↓
Static Analysis
↓
Tests
↓
Build
```

---

# 16. Минимальное покрытие тестами

Версия 1.0:

```text
70%
```

---

Цель:

```text
85%
```

---

# 17. Запрет релиза

Релиз запрещается если:

```text
Не проходят тесты
```

или

```text
Есть ошибки линтера
```

---

# 18. Семантическое версионирование

Используется:

```text
MAJOR.MINOR.PATCH
```

---

Пример:

```text
1.0.0
1.1.0
1.1.1
```

---

# 19. MAJOR

Изменения:

```text
ломающие совместимость
```

---

# 20. MINOR

Изменения:

```text
новый функционал
```

---

# 21. PATCH

Изменения:

```text
исправления ошибок
```

---

# 22. Автоматическая проверка версии

Перед релизом:

```text
version.php
```

или

```text
plugin header
```

должны содержать новую версию.

---

# 23. Release Branch

Создается:

```text
release/*
```

---

Пример:

```text
release/1.2.0
```

---

# 24. Release Pipeline

После создания тега:

```text
v1.2.0
```

запускается релиз.

---

# 25. Автоматическая сборка ZIP

Релиз обязан создавать:

```text
ZIP архив
```

---

Без ручной упаковки.

---

# 26. GitHub Release

Автоматически создается:

```text
Release
```

---

Содержит:

```text
ZIP

Version

Changelog
```

---

# 27. Changelog

Файл:

```text
CHANGELOG.md
```

---

Обязателен.

---

# 28. Формат Changelog

Разделы:

```text
Added

Changed

Fixed

Removed
```

---

# 29. Update Server Integration

После релиза PRO:

```text
Release
↓
Upload ZIP
↓
Update Server
```

---

# 30. Проверка ZIP

Перед публикацией:

```text
ZIP Integrity Check
```

---

# 31. SHA256

Для каждого релиза:

```text
SHA256 Hash
```

---

Сохраняется в системе.

---

# 32. Deployment Stage

Merge в develop:

```text
Deploy STAGE
```

---

Автоматически.

---

# 33. Deployment Production

Merge в main:

```text
Deploy PROD
```

---

После прохождения проверок.

---

# 34. Blue-Green Deployment

Версия 1.0:

не используется.

---

Планируется позже.

---

# 35. Rollback

Должна существовать команда:

```text
Rollback Previous Release
```

---

# 36. Автоматический Backup

Перед PROD deploy:

```text
Backup Database
Backup Files
```

---

# 37. Проверка миграций

Перед запуском:

```text
Migration Dry Run
```

---

# 38. Database Migration Policy

Каждая миграция:

```text
в отдельном файле
```

---

Запрещено:

```text
ручное изменение структуры БД
```

---

# 39. Secrets Management

Используются:

```text
GitHub Secrets
```

---

Запрещено:

```text
API Keys в коде
```

---

# 40. Хранимые секреты

```text
SSH_KEY

DB_PASSWORD

JWT_SECRET

YOOKASSA_SECRET

SMTP_PASSWORD
```

---

# 41. Уведомления о релизе

После успешного релиза:

```text
Email Admin
```

---

В будущем:

```text
Telegram
```

---

# 42. Автоматическое создание артефактов

Pipeline сохраняет:

```text
ZIP

Logs

Reports

Coverage
```

---

# 43. Контроль качества

Каждый PR обязан проходить:

```text
Lint

Static Analysis

Tests
```

---

# 44. OpenHands Integration

OpenHands обязан:

```text
Работать только через PR
```

---

Запрещено:

```text
Прямой commit в main
```

---

# 45. OpenHands Release Policy

OpenHands не имеет права:

```text
Создавать Production Release
```

---

Без подтверждения владельца.

---

# 46. Контроль версий документации

Изменение функционала:

```text
Код
+
Документация
```

---

Одновременно.

---

# 47. Documentation Pipeline

Проверяется наличие:

```text
README

CHANGELOG

API DOCS
```

---

# 48. Monitoring Deploy

После релиза проверяется:

```text
API Health

Database Health

Queue Health
```

---

# 49. Definition of Done

CI/CD считается завершенным если:

* каждый commit проходит проверки;
* автоматически запускаются тесты;
* автоматически собираются ZIP;
* автоматически создаются релизы;
* автоматически обновляется STAGE;
* автоматически обновляется PROD;
* работает rollback;
* работают backup.

---

# 50. Главная цель

Любой релиз OZON PLATFORM должен выпускаться предсказуемо, воспроизводимо и безопасно без ручной сборки, ручной упаковки архивов и ручного копирования файлов на сервер.
