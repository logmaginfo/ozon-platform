# 16_LICENSE_DATABASE_SCHEMA.md

# PROJECT C

License Server + Customer Portal + Admin Panel

Версия: 1.0.0

Статус: Database Schema Specification

---

# 1. Назначение документа

Документ определяет структуру базы данных для:

* License Server
* Customer Portal
* Admin Panel
* Billing System

---

# 2. Основной принцип

База данных является единственным источником истины.

---

Источник истины:

```text
Database
```

---

Не допускается хранение критичных данных:

* в памяти;
* в файлах;
* в кэше.

---

# 3. СУБД

Рекомендуется:

```text
PostgreSQL
```

---

Допускается:

```text
MySQL 8+
```

---

# 4. Общая схема

```text
users
│
├── licenses
│
├── domains
│
├── payments
│
├── downloads
│
├── email_log
│
├── audit_log
│
└── update_versions
```

---

# 5. Таблица users

Клиенты системы.

---

Поля:

```text
id

uuid

name

email

password_hash

status

created_at

updated_at
```

---

Статусы:

```text
active

blocked

deleted
```

---

Email:

уникальный.

---

# 6. Таблица licenses

Все лицензии.

---

Поля:

```text
id

license_key

user_id

product

plan

status

expires_at

created_at

updated_at
```

---

Пример:

```text
OZON-AB12-CD34-EF56-GH78
```

---

Статусы:

```text
active

expired

blocked

suspended
```

---

Планы:

```text
pro_month

pro_6_months

pro_12_months
```

---

# 7. Таблица domains

Привязанные домены.

---

Поля:

```text
id

license_id

domain

activated_at

last_check_at

created_at
```

---

Пример:

```text
example.com
```

---

Ограничение:

один домен на одну лицензию.

---

# 8. Таблица payments

Все платежи.

---

Поля:

```text
id

payment_id

user_id

license_id

amount

currency

status

provider

provider_payment_id

created_at
```

---

Provider:

```text
yookassa
```

---

Статусы:

```text
pending

paid

canceled

refunded

failed
```

---

# 9. Таблица downloads

История скачивания PRO.

---

Поля:

```text
id

user_id

license_id

version

ip_address

downloaded_at
```

---

# 10. Таблица email_log

История email.

---

Поля:

```text
id

user_id

template

subject

status

sent_at
```

---

Статусы:

```text
queued

sent

failed
```

---

# 11. Таблица audit_log

Журнал безопасности.

---

Поля:

```text
id

user_id

event_type

event_data

ip_address

created_at
```

---

События:

```text
login

logout

license_activate

license_deactivate

payment_success

payment_failed

download
```

---

# 12. Таблица update_versions

Версии PRO.

---

Поля:

```text
id

version

release_date

download_url

changelog

is_latest
```

---

Пример:

```text
1.0.0

1.1.0

1.2.0
```

---

# 13. Таблица products

Продукты системы.

---

Поля:

```text
id

code

name

status

created_at
```

---

Пример:

```text
ozon_pro
```

---

Это позволит в будущем продавать:

* Ozon PRO
* Wildberries PRO
* Яндекс Маркет PRO

---

# 14. Таблица plans

Тарифы.

---

Поля:

```text
id

product_id

code

name

duration_days

price

currency

is_active
```

---

Примеры:

```text
pro_month

30

---

pro_6_months

180

---

pro_12_months

365
```

---

# 15. Таблица refresh_tokens

Для API авторизации.

---

Поля:

```text
id

user_id

token_hash

expires_at

created_at
```

---

# 16. Таблица password_resets

Сброс пароля.

---

Поля:

```text
id

user_id

token_hash

expires_at

created_at
```

---

# 17. Таблица webhook_log

История webhook ЮKassa.

---

Поля:

```text
id

provider

event_type

payload

processed

created_at
```

---

# 18. Таблица api_requests

Контроль API лицензий.

---

Поля:

```text
id

license_key

endpoint

ip_address

response_code

created_at
```

---

Используется для:

* Rate Limit;
* диагностики;
* расследования ошибок.

---

# 19. Индексы

Обязательные индексы:

---

users.email

---

licenses.license_key

---

licenses.status

---

domains.domain

---

payments.payment_id

---

payments.status

---

update_versions.version

---

# 20. Внешние ключи

```text
users
    ↓
licenses

licenses
    ↓
domains

users
    ↓
payments

licenses
    ↓
payments
```

---

# 21. Удаление клиента

Физическое удаление запрещено.

---

Используется:

```text
status = deleted
```

---

# 22. Хранение лицензий

License Key хранится:

```text
encrypted
```

---

Полный ключ не отображается.

---

Пример:

```text
OZON-AB12-****-****-GH78
```

---

# 23. Хранение паролей

Используется:

```text
bcrypt
```

---

Хранение паролей в открытом виде запрещено.

---

# 24. История платежей

Никогда не удаляется.

---

Даже после удаления клиента.

---

# 25. История лицензий

Никогда не удаляется.

---

Используется для аудита.

---

# 26. Резервное копирование

Ежедневно:

* база данных;
* лицензии;
* платежи;
* пользователи.

---

# 27. Подготовка к масштабированию

База должна поддерживать:

```text
100 000+ клиентов

500 000+ лицензий

миллионы API запросов
```

---

без изменения структуры.

---

# 28. Definition of Done

Схема считается завершенной если:

* поддерживает лицензии;
* поддерживает домены;
* поддерживает платежи;
* поддерживает обновления;
* поддерживает аудит;
* поддерживает масштабирование.

---

# 29. Главный принцип

Любое действие пользователя должно иметь возможность быть восстановленным через базу данных:

кто,

когда,

что сделал,

какая лицензия использовалась,

какой домен был активирован,

какой платеж был произведен.
