# 17_LICENSE_API_SPEC.md

# PROJECT C

License Server + Customer Portal + Admin Panel

Версия: 1.0.0

Статус: REST API Specification

---

# 1. Назначение

Документ определяет REST API платформы лицензирования.

---

Используется:

* PRO Plugin
* Customer Portal
* Admin Panel
* Billing System

---

# 2. Базовый URL

Пример:

```text
https://license.example.com/api/v1
```

---

Все endpoint используют:

```text
/api/v1/
```

---

# 3. Формат запросов

Content-Type:

```text
application/json
```

---

Все данные передаются в JSON.

---

# 4. Формат успешного ответа

```json
{
  "success": true,
  "data": {}
}
```

---

# 5. Формат ошибки

```json
{
  "success": false,
  "error": {
    "code": "LICENSE_EXPIRED",
    "message": "License expired"
  }
}
```

---

# 6. Коды ошибок

Поддерживаются:

```text
INVALID_LICENSE

LICENSE_EXPIRED

LICENSE_BLOCKED

DOMAIN_MISMATCH

PAYMENT_REQUIRED

NOT_FOUND

UNAUTHORIZED

RATE_LIMIT

SERVER_ERROR
```

---

# 7. API Активации лицензии

Endpoint:

```text
POST /activate
```

---

Назначение:

привязка лицензии к домену.

---

Запрос:

```json
{
  "license_key":"OZON-XXXX-XXXX",
  "domain":"example.com",
  "plugin_version":"1.0.0"
}
```

---

Ответ:

```json
{
  "success": true,
  "data": {
    "license_status":"active",
    "expires_at":"2027-06-01"
  }
}
```

---

# 8. Правила активации

Проверяется:

* лицензия существует;
* лицензия активна;
* лицензия не истекла;
* домен не занят.

---

# 9. API Проверки лицензии

Endpoint:

```text
POST /validate
```

---

Используется PRO плагином.

---

Запрос:

```json
{
  "license_key":"OZON-XXXX-XXXX",
  "domain":"example.com"
}
```

---

Ответ:

```json
{
  "success": true,
  "data": {
    "status":"active",
    "expires_at":"2027-06-01"
  }
}
```

---

# 10. Частота проверки лицензии

Плагин проверяет лицензию:

```text
1 раз в сутки
```

---

Локальный кэш:

24 часа.

---

# 11. API Деактивации

Endpoint:

```text
POST /deactivate
```

---

Назначение:

освободить домен.

---

Запрос:

```json
{
  "license_key":"OZON-XXXX-XXXX",
  "domain":"example.com"
}
```

---

Ответ:

```json
{
  "success": true
}
```

---

# 12. Ограничения деактивации

Для версии 1.0:

не более 5 деактиваций в месяц.

---

Защита от передачи лицензий.

---

# 13. API Продления лицензии

Endpoint:

```text
POST /renew
```

---

Вызывается после подтверждения оплаты.

---

Запрос:

```json
{
  "license_id":123,
  "plan":"pro_12_months"
}
```

---

Ответ:

```json
{
  "success": true,
  "data": {
    "expires_at":"2028-06-01"
  }
}
```

---

# 14. API Проверки обновлений

Endpoint:

```text
POST /check-update
```

---

Используется PRO плагином.

---

Запрос:

```json
{
  "license_key":"OZON-XXXX-XXXX",
  "current_version":"1.0.0"
}
```

---

Ответ:

```json
{
  "success": true,
  "data": {
    "update_available": true,
    "latest_version":"1.1.0",
    "changelog":"...",
    "download_url":"..."
  }
}
```

---

# 15. API Скачивания обновлений

Endpoint:

```text
GET /download/{version}
```

---

Требование:

активная лицензия.

---

# 16. API Регистрации клиента

Endpoint:

```text
POST /register
```

---

Запрос:

```json
{
  "name":"John Doe",
  "email":"john@example.com",
  "password":"********"
}
```

---

Ответ:

```json
{
  "success": true
}
```

---

# 17. API Авторизации

Endpoint:

```text
POST /login
```

---

Запрос:

```json
{
  "email":"john@example.com",
  "password":"********"
}
```

---

Ответ:

```json
{
  "success": true,
  "access_token":"...",
  "refresh_token":"..."
}
```

---

# 18. JWT Авторизация

Используется:

```text
Bearer Token
```

---

Пример:

```text
Authorization: Bearer TOKEN
```

---

# 19. API Обновления токена

Endpoint:

```text
POST /refresh-token
```

---

Позволяет получить новый access token.

---

# 20. API Выхода

Endpoint:

```text
POST /logout
```

---

Отзывает refresh token.

---

# 21. API Профиля

Endpoint:

```text
GET /profile
```

---

Возвращает:

* имя;
* email;
* дату регистрации.

---

# 22. API Лицензий клиента

Endpoint:

```text
GET /licenses
```

---

Возвращает:

список лицензий пользователя.

---

# 23. API Деталей лицензии

Endpoint:

```text
GET /licenses/{id}
```

---

Возвращает:

* ключ;
* тариф;
* статус;
* домен;
* срок действия.

---

# 24. API Доменов

Endpoint:

```text
GET /domains
```

---

Возвращает:

список доменов клиента.

---

# 25. API Платежей

Endpoint:

```text
GET /payments
```

---

Возвращает историю оплат.

---

# 26. API Загрузок

Endpoint:

```text
GET /downloads
```

---

Возвращает историю скачиваний.

---

# 27. API Создания платежа

Endpoint:

```text
POST /payments/create
```

---

Запрос:

```json
{
  "plan":"pro_12_months"
}
```

---

Ответ:

```json
{
  "success": true,
  "data": {
    "payment_url":"https://..."
  }
}
```

---

# 28. API Webhook ЮKassa

Endpoint:

```text
POST /webhooks/yookassa
```

---

Источник:

только ЮKassa.

---

Проверяется:

* подпись;
* источник;
* тип события.

---

# 29. Поддерживаемые события Webhook

```text
payment.succeeded

payment.waiting_for_capture

payment.canceled

refund.succeeded
```

---

# 30. Административный API

Префикс:

```text
/api/v1/admin
```

---

Требуется роль:

```text
admin
```

---

# 31. Admin API Лицензии

Поддерживает:

```text
GET

POST

PUT

DELETE
```

---

Для лицензий.

---

# 32. Admin API Клиенты

Поддерживает:

```text
GET

POST

PUT

DELETE
```

---

Для клиентов.

---

# 33. Admin API Платежи

Позволяет:

* просматривать;
* фильтровать;
* экспортировать.

---

# 34. Admin API Версии

Управление:

```text
update_versions
```

---

Добавление новых релизов.

---

# 35. Rate Limiting

Публичный API:

```text
60 запросов в минуту
```

---

После превышения:

HTTP 429.

---

# 36. Логирование API

Каждый запрос сохраняется:

```text
api_requests
```

---

Фиксируется:

* IP;
* endpoint;
* код ответа;
* время.

---

# 37. Безопасность

Все запросы:

HTTPS only.

---

TLS 1.2+

---

# 38. Хранение ключей

License Key никогда не возвращается полностью.

---

Пример:

```text
OZON-AB12-****-****-GH78
```

---

# 39. Версионирование API

Версия:

```text
v1
```

---

Изменение контракта:

только через:

```text
v2
```

---

# 40. Definition of Done

API считается завершенным если:

* работает активация;
* работает проверка лицензии;
* работает деактивация;
* работает продление;
* работает обновление PRO;
* работает кабинет клиента;
* работает административная панель;
* работает интеграция ЮKassa.

---

# 41. Главный принцип

Любой компонент платформы должен иметь возможность работать исключительно через REST API без прямого доступа к базе данных.
