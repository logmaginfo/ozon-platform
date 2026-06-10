# 29_AUDIT_LOG_AND_ACTIVITY_SYSTEM.md

# OZON PLATFORM v1.1

Audit Log & Activity Tracking System

Версия: 1.0.0

Статус: Security & Compliance Specification

---

# 1. Назначение

Документ определяет:

* систему аудита;
* журнал действий пользователей;
* журнал действий администраторов;
* историю изменений данных;
* журнал безопасности;
* расследование инцидентов.

---

# 2. Главная цель

Любое действие должно быть:

```text
Зафиксировано

Сохранено

Доступно для поиска

Невозможно скрыть
```

---

# 3. Область аудита

Логируются:

```text
Клиенты

Администраторы

Система

API

Платежи

Лицензии

Поддержка
```

---

# 4. Основной принцип

Никакие важные действия не выполняются без записи в Audit Log.

---

# 5. Что считается важным действием

Любое действие которое:

```text
Изменяет данные

Создает данные

Удаляет данные

Влияет на лицензии

Влияет на платежи

Влияет на безопасность
```

---

# 6. Основные типы событий

Используются:

```text
AUTH

LICENSE

PAYMENT

CUSTOMER

SUPPORT

ADMIN

SYSTEM

SECURITY
```

---

# 7. Формат события

Каждое событие содержит:

```text
Event ID

Timestamp

Event Type

Action

Actor

Target

IP Address

User Agent

Result
```

---

# 8. Event ID

Формат:

```text
AUD-2026-000000001
```

---

Уникален.

---

# 9. Timestamp

Используется:

```text
UTC
```

---

# 10. Actor

Кто выполнил действие:

```text
Customer

Admin

System

API
```

---

# 11. Result

Возможные значения:

```text
Success

Failed

Warning
```

---

# 12. AUTH Events

Логируются:

```text
Login

Logout

Password Reset

Password Change

Email Change
```

---

# 13. Login Event

Сохраняются:

```text
IP

Browser

Country

Result
```

---

# 14. Failed Login

Каждая неудачная попытка сохраняется.

---

# 15. LICENSE Events

Логируются:

```text
Activation

Renewal

Expiration

Deactivation

Domain Change
```

---

# 16. License Activation

Сохраняются:

```text
License ID

Domain

Customer ID
```

---

# 17. License Renewal

Сохраняются:

```text
Old Expiration

New Expiration

Payment ID
```

---

# 18. License Expiration

Логируется автоматически.

---

# 19. Domain Change

Сохраняются:

```text
Old Domain

New Domain

Reason
```

---

# 20. PAYMENT Events

Логируются:

```text
Create Payment

Success Payment

Failed Payment

Refund Request

Refund Approved

Refund Rejected
```

---

# 21. Payment Event

Сохраняются:

```text
Payment ID

Amount

Currency

Provider
```

---

# 22. YooKassa Events

Логируются:

```text
Webhook Received

Webhook Error

Webhook Retry
```

---

# 23. CUSTOMER Events

Логируются:

```text
Registration

Profile Update

Email Change

Account Deletion Request
```

---

# 24. SUPPORT Events

Логируются:

```text
Ticket Created

Ticket Updated

Ticket Closed

Internal Note
```

---

# 25. Ticket Event

Сохраняются:

```text
Ticket ID

Customer ID

Agent ID
```

---

# 26. ADMIN Events

Логируются:

```text
Login

Settings Change

License Edit

Payment Edit

Customer Edit
```

---

# 27. Admin Settings Change

Сохраняются:

```text
Parameter

Old Value

New Value
```

---

# 28. SYSTEM Events

Логируются:

```text
Deploy

Migration

Backup

Restore

Update
```

---

# 29. Migration Event

Сохраняются:

```text
Migration Name

Version

Result
```

---

# 30. SECURITY Events

Логируются:

```text
Brute Force

Suspicious Login

Permission Escalation

Token Abuse

API Abuse
```

---

# 31. Suspicious Activity

Автоматически отмечается флагом:

```text
Security Warning
```

---

# 32. API Events

Логируются:

```text
License Check

Update Check

Activation Request

API Error
```

---

# 33. Update Events

Логируются:

```text
Update Request

Update Download

Update Install
```

---

# 34. Email Events

Логируются:

```text
Sent

Delivered

Failed

Opened
```

---

# 35. Queue Events

Логируются:

```text
Job Created

Job Started

Job Completed

Job Failed
```

---

# 36. Audit Database

Используется отдельная таблица:

```text
audit_logs
```

---

# 37. Обязательные поля audit_logs

```text
id

event_type

action

actor_type

actor_id

target_type

target_id

payload_json

ip

user_agent

result

created_at
```

---

# 38. Payload JSON

Хранит дополнительные данные события.

---

Пример:

```json
{
  "old_domain": "shop1.ru",
  "new_domain": "shop2.ru"
}
```

---

# 39. Неизменяемость

Audit записи нельзя редактировать.

---

# 40. Удаление

Удаление Audit Log запрещено.

---

# 41. Soft Delete

Не используется.

---

# 42. Поиск

Поддерживается поиск по:

```text
License ID

Customer ID

Payment ID

Domain

Email

IP
```

---

# 43. Фильтрация

Поддерживаются фильтры:

```text
Date

Event Type

Severity

Result
```

---

# 44. Audit Dashboard

Администратор видит:

```text
Последние события

Ошибки

Предупреждения

Подозрительную активность
```

---

# 45. Экспорт

Поддерживаются:

```text
CSV

XLSX

JSON
```

---

# 46. Хранение данных

Минимальный срок:

```text
5 лет
```

---

# 47. Архивирование

Старые записи:

```text
> 12 месяцев
```

---

Переносятся в архивные таблицы.

---

# 48. Compliance

Audit Log должен позволять:

```text
Расследовать инциденты

Проверять платежи

Проверять лицензии

Подтверждать действия пользователей
```

---

# 49. Definition of Done

Audit System считается завершенной если:

* логируются действия клиентов;
* логируются действия администраторов;
* логируются платежи;
* логируются лицензии;
* логируются обновления;
* логируются события безопасности;
* работает поиск;
* работает экспорт;
* данные невозможно изменить.

---

# 50. Главная цель

В любой момент времени владелец платформы должен иметь возможность восстановить полную историю событий, действий пользователей, изменений лицензий, платежей и административных операций для решения споров, расследования ошибок и обеспечения безопасности системы.
