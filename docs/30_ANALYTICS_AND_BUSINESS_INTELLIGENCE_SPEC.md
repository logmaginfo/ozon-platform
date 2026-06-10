# 30_ANALYTICS_AND_BUSINESS_INTELLIGENCE_SPEC.md

# OZON PLATFORM v1.1

Analytics & Business Intelligence Specification

Версия: 1.0.0

Статус: Business Analytics Specification

---

# 1. Назначение

Документ определяет:

* систему аналитики;
* финансовую отчетность;
* аналитику клиентов;
* аналитику лицензий;
* аналитику продаж;
* KPI платформы.

---

# 2. Главная цель

Администратор должен понимать:

```text
Что происходит

Почему происходит

Что приносит прибыль

Что требует улучшения
```

---

# 3. Уровни аналитики

Используются:

```text
Financial Analytics

Customer Analytics

License Analytics

Product Analytics

Support Analytics

System Analytics
```

---

# 4. Analytics Dashboard

Главная страница аналитики содержит:

```text
MRR

ARR

Revenue

Customers

Licenses

Renewals

Churn
```

---

# 5. Временные периоды

Поддерживаются:

```text
Сегодня

7 дней

30 дней

90 дней

12 месяцев

Все время
```

---

# 6. Финансовые показатели

Контролируются:

```text
Revenue

MRR

ARR

Refunds

Average Order Value
```

---

# 7. Revenue

Общий доход платформы.

---

Формула:

```text
Все успешные платежи
-
Возвраты
```

---

# 8. MRR

Monthly Recurring Revenue

---

Формула:

```text
Активные лицензии
с пересчетом в месячный доход
```

---

# 9. ARR

Annual Recurring Revenue

---

Формула:

```text
MRR × 12
```

---

# 10. Average Order Value

Формула:

```text
Revenue
/
Количество заказов
```

---

# 11. Продажи по тарифам

Отдельно отображаются:

```text
1 месяц

6 месяцев

12 месяцев
```

---

# 12. Конверсия тарифов

Показывается:

```text
Количество продаж

Доход

Средний чек
```

---

# 13. Customer Analytics

Контролируются:

```text
Регистрации

Активные клиенты

Новые клиенты

Потерянные клиенты
```

---

# 14. New Customers

Количество новых клиентов за период.

---

# 15. Active Customers

Клиенты с активной лицензией.

---

# 16. Returning Customers

Клиенты совершившие повторную покупку.

---

# 17. License Analytics

Контролируются:

```text
Активные лицензии

Истекающие лицензии

Продленные лицензии

Просроченные лицензии
```

---

# 18. License Distribution

Показывается распределение:

```text
1 месяц

6 месяцев

12 месяцев
```

---

# 19. Renewal Rate

Формула:

```text
Продленные лицензии
/
Истекшие лицензии
```

---

# 20. Churn Rate

Формула:

```text
Не продлившие лицензии
/
Истекшие лицензии
```

---

# 21. Customer Lifetime Value

LTV

---

Формула:

```text
Средний чек
×
Среднее число продлений
```

---

# 22. Top Customers

Отображаются:

```text
ТОП клиентов по доходу
```

---

# 23. Product Analytics

Контролируются:

```text
FREE Downloads

PRO Purchases

Conversions
```

---

# 24. FREE → PRO Conversion

Формула:

```text
PRO Покупки
/
FREE Установки
```

---

# 25. Upgrade Analytics

Отображается:

```text
Количество переходов FREE → PRO
```

---

# 26. Источники продаж

Поддерживаются:

```text
Direct

Organic

Referral

Campaign
```

---

# 27. UTM Tracking

Поддерживаются:

```text
utm_source

utm_medium

utm_campaign
```

---

# 28. Campaign Analytics

Показывает:

```text
Клики

Регистрации

Продажи

Доход
```

---

# 29. Refund Analytics

Контролируются:

```text
Количество возвратов

Сумма возвратов

Процент возвратов
```

---

# 30. Refund Rate

Формула:

```text
Refunds
/
Sales
```

---

# 31. Support Analytics

Контролируются:

```text
Тикеты

Время ответа

Время решения

Оценка поддержки
```

---

# 32. Support KPI

Показываются:

```text
Среднее время ответа

Среднее время решения

Просроченные тикеты
```

---

# 33. System Analytics

Контролируются:

```text
API Requests

Errors

Queue Jobs

Deployments
```

---

# 34. License API Analytics

Показываются:

```text
Проверки лицензий

Активации

Ошибки
```

---

# 35. Update Analytics

Контролируются:

```text
Проверки обновлений

Скачивания

Установки
```

---

# 36. Geographic Analytics

Отображаются:

```text
Страны

Регионы

Города
```

---

По клиентам.

---

# 37. Domain Analytics

Показываются:

```text
Количество уникальных доменов
```

---

# 38. Revenue Forecast

Строится прогноз:

```text
30 дней

90 дней

12 месяцев
```

---

На основе текущих данных.

---

# 39. Executive Dashboard

Показывает владельцу:

```text
MRR

ARR

Revenue

Customers

Renewals

Churn

Support Score
```

---

На одной странице.

---

# 40. Отчеты

Поддерживаются:

```text
Daily

Weekly

Monthly

Yearly
```

---

# 41. Автоматическая отправка отчетов

Отправляются:

```text
Email Administrator
```

---

# 42. Экспорт отчетов

Поддерживаются:

```text
CSV

XLSX

PDF
```

---

# 43. Historical Data

Хранятся:

```text
Все показатели
```

---

Без удаления.

---

# 44. Data Retention

Минимум:

```text
5 лет
```

---

# 45. KPI системы

Целевые показатели:

```text
Renewal Rate > 70%

Refund Rate < 5%

Support Score > 4.5

Uptime > 99.9%
```

---

# 46. Dashboard Refresh

Обновление данных:

```text
Каждые 15 минут
```

---

# 47. Analytics Permissions

Доступ имеют:

```text
Owner

Admin
```

---

# 48. Definition of Done

Analytics System считается завершенной если:

* считаются продажи;
* считаются лицензии;
* считается MRR;
* считается ARR;
* считается Churn;
* считается LTV;
* считается конверсия FREE → PRO;
* работают отчеты;
* работает экспорт.

---

# 49. Ограничение MVP

Внешние BI системы:

```text
Power BI

Looker

Tableau
```

---

Не интегрируются в версии 1.0.

---

# 50. Главная цель

Владелец платформы должен иметь возможность принимать решения на основе реальных данных о продажах, лицензиях, клиентах и доходности продукта, а не на основе предположений.
