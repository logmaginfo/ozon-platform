# 23_DEPLOYMENT_INFRASTRUCTURE.md

# OZON PLATFORM v1.1

Infrastructure & Deployment Specification

Версия: 1.0.0

Статус: Infrastructure Specification

---

# 1. Назначение

Документ описывает:

* инфраструктуру проекта;
* серверную архитектуру;
* окружения;
* деплой;
* резервное копирование;
* мониторинг.

---

# 2. Основной принцип

Система должна быть:

* простой;
* дешевой в обслуживании;
* легко масштабируемой;
* понятной новому разработчику.

---

# 3. Компоненты платформы

Система состоит из трех проектов:

```text
PROJECT A

WordPress Free Plugin
```

```text
PROJECT B

WordPress PRO Plugin
```

```text
PROJECT C

License Platform
```

---

# 4. Состав PROJECT C

License Platform включает:

```text
License API

Customer Portal

Admin Panel

Billing System

Update Server
```

---

# 5. Окружения

Используются:

```text
DEV

STAGE

PROD
```

---

# 6. DEV

Назначение:

локальная разработка.

---

Домен:

```text
dev.local
```

---

# 7. STAGE

Назначение:

тестирование перед релизом.

---

Пример:

```text
stage.ozon-platform.ru
```

---

# 8. PROD

Продакшен.

---

Пример:

```text
app.ozon-platform.ru
```

---

# 9. Серверная архитектура v1.0

Для старта используется:

```text
1 VPS
```

---

На одном сервере работают:

```text
Nginx

Backend

PostgreSQL

Redis

Scheduler
```

---

# 10. Рекомендуемый VPS

Минимум:

```text
4 CPU

8 GB RAM

80 GB SSD
```

---

Рекомендуется:

```text
8 CPU

16 GB RAM

160 GB SSD
```

---

# 11. Операционная система

Поддерживается:

```text
Ubuntu Server LTS
```

---

Версия:

```text
24.04 LTS
```

---

# 12. Веб-сервер

Используется:

```text
Nginx
```

---

Apache не используется.

---

# 13. Backend

Рекомендуется:

```text
Laravel
```

---

Причины:

* зрелая экосистема;
* хорошая работа с API;
* очереди;
* миграции;
* безопасность.

---

# 14. База данных

Используется:

```text
PostgreSQL
```

---

Минимальная версия:

```text
16
```

---

# 15. Redis

Используется для:

```text
Cache

Queues

Sessions

Rate Limit
```

---

# 16. Очереди

Используется:

```text
Redis Queue
```

---

Обрабатывает:

```text
Email

Webhooks

License Checks

Updates

Reports
```

---

# 17. Docker

Все сервисы запускаются через:

```text
Docker
```

---

# 18. Docker Compose

Используется:

```text
docker-compose.yml
```

---

Для локальной разработки.

---

# 19. Контейнеры

Минимальный набор:

```text
nginx

app

postgres

redis
```

---

# 20. Структура доменов

```text
app.ozon-platform.ru
```

Customer Portal

---

```text
admin.ozon-platform.ru
```

Admin Panel

---

```text
api.ozon-platform.ru
```

License API

---

```text
downloads.ozon-platform.ru
```

Update Server

---

# 21. SSL

Все домены используют:

```text
Let's Encrypt
```

---

Автообновление сертификатов обязательно.

---

# 22. Environment Variables

Секреты хранятся только в:

```text
.env
```

---

Запрещено хранить:

```text
API Keys

Passwords

JWT Secret

YooKassa Secret
```

в коде.

---

# 23. Git Repository

Используется:

```text
Git
```

---

Основная ветка:

```text
main
```

---

# 24. Ветки

Поддерживаются:

```text
main

develop

feature/*
```

---

# 25. CI/CD

Используется:

```text
GitHub Actions
```

---

# 26. Автоматический деплой

После merge:

```text
develop
↓
STAGE
```

---

После merge:

```text
main
↓
PROD
```

---

# 27. Резервное копирование

Каждый день:

```text
Database Backup
```

---

Каждый день:

```text
Files Backup
```

---

# 28. Срок хранения резервных копий

```text
7 дней

30 дней

90 дней
```

---

Политика ротации обязательна.

---

# 29. Место хранения backup

Рекомендуется:

```text
S3 Storage
```

---

Или совместимое хранилище.

---

# 30. Disaster Recovery

Максимальная потеря данных:

```text
24 часа
```

---

# 31. Monitoring

Используется:

```text
Uptime Monitor
```

---

Контролируются:

```text
API

Database

Website

Downloads
```

---

# 32. Alert System

Уведомления отправляются:

```text
Email
```

---

В будущем:

```text
Telegram
```

---

# 33. Application Logs

Логируются:

```text
Errors

Payments

Licenses

Updates

API Calls
```

---

# 34. Централизованные логи

Рекомендуется:

```text
Loki
```

---

или аналог.

---

# 35. Метрики

Отслеживаются:

```text
CPU

RAM

Disk

Network

DB Load
```

---

# 36. Обновления платформы

Деплой:

```text
Zero Downtime
```

---

По возможности.

---

# 37. Масштабирование v2

При росте системы:

```text
APP Server

DB Server

Redis Server
```

разделяются.

---

# 38. Масштабирование v3

Добавляются:

```text
Load Balancer

Multiple APP Nodes
```

---

# 39. Производительность

Система должна поддерживать:

```text
100 000 клиентов

500 000 лицензий

1 000 000+ проверок лицензий
```

---

# 40. Инфраструктурная безопасность

Обязательно:

```text
Firewall

Fail2Ban

HTTPS

SSH Key Auth
```

---

Парольный SSH запрещен.

---

# 41. Доступ разработчиков

Используются:

```text
SSH Keys
```

---

Общие аккаунты запрещены.

---

# 42. Тестирование восстановления

Не реже:

```text
1 раз в месяц
```

---

Проверяется восстановление из backup.

---

# 43. Документация инфраструктуры

Должны существовать:

```text
Deployment Guide

Backup Guide

Recovery Guide

Server Setup Guide
```

---

# 44. Definition of Done

Infrastructure считается готовой если:

* работает DEV;
* работает STAGE;
* работает PROD;
* настроен CI/CD;
* работают backup;
* работает мониторинг;
* работает SSL;
* работает License API.

---

# 45. Главная цель

Любой разработчик должен иметь возможность развернуть всю платформу с нуля по документации менее чем за один рабочий день, а система должна оставаться стабильной, безопасной и масштабируемой по мере роста количества клиентов и лицензий.
