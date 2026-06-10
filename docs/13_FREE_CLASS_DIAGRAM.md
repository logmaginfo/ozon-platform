# 13_FREE_CLASS_DIAGRAM.md

# PROJECT A

WordPress Plugin FREE

Версия: 1.0.0

Статус: Class Architecture Specification

---

# 1. Назначение документа

Документ определяет полный список классов FREE версии.

---

Цели:

* исключить архитектурный хаос;
* исключить дублирование ответственности;
* ограничить количество классов;
* обеспечить понятную структуру.

---

# 2. Главный принцип

Один класс = одна ответственность.

---

Запрещено:

* дублировать функциональность;
* создавать классы без необходимости;
* создавать классы "на будущее".

---

# 3. Карта классов

```text
Ozon_Plugin
│
├── Ozon_Admin
│
├── Ozon_Client
│
├── Ozon_Category_Manager
│
├── Ozon_Attributes_Manager
│
├── Ozon_Product_Meta_Box
│
├── Ozon_Product_Exporter
│
└── Ozon_Status_Checker
```

---

# 4. Ozon_Plugin

Главный загрузчик системы.

---

Файл:

```text
includes/class-ozon-plugin.php
```

---

Ответственность:

* запуск системы;
* регистрация хуков;
* инициализация классов.

---

Разрешено:

```text
add_action
add_filter
autoload
```

---

Запрещено:

* API запросы;
* работа с товарами;
* бизнес-логика.

---

# 5. Ozon_Admin

Административный интерфейс.

---

Файл:

```text
admin/class-ozon-admin.php
```

---

Ответственность:

* меню WooCommerce;
* страница настроек;
* сохранение настроек.

---

Разрешено:

```text
render settings page
save settings
admin notices
```

---

Запрещено:

* API запросы напрямую;
* экспорт товаров.

---

# 6. Ozon_Client

Единая точка работы с Seller API.

---

Файл:

```text
includes/class-ozon-client.php
```

---

Ответственность:

* HTTP запросы;
* авторизация;
* обработка ответов;
* обработка ошибок.

---

Методы:

```text
test_connection()

get_categories()

get_attributes()

get_dictionary()

export_product()

check_status()
```

---

Запрещено:

* вывод HTML;
* работа с интерфейсом.

---

# 7. Ozon_Category_Manager

Работа с категориями.

---

Файл:

```text
includes/class-ozon-category-manager.php
```

---

Ответственность:

* загрузка категорий;
* построение индекса;
* сохранение категорий.

---

Методы:

```text
sync_categories()

build_type_index()

get_categories()
```

---

Запрещено:

* работа с товарами;
* экспорт.

---

# 8. Ozon_Attributes_Manager

Работа с характеристиками.

---

Файл:

```text
includes/class-ozon-attributes-manager.php
```

---

Ответственность:

* получение атрибутов;
* кэширование;
* сохранение атрибутов.

---

Методы:

```text
get_attributes()

save_attributes()

validate_attributes()
```

---

# 9. Ozon_Product_Meta_Box

Метабокс товара.

---

Файл:

```text
admin/class-ozon-product-meta-box.php
```

---

Ответственность:

* отображение блока OZON;
* загрузка формы атрибутов;
* отображение статуса.

---

Разрешено:

```text
render html
ajax handlers
```

---

Запрещено:

* API запросы напрямую.

---

# 10. Ozon_Product_Exporter

Отправка товаров.

---

Файл:

```text
includes/class-ozon-product-exporter.php
```

---

Ответственность:

* подготовка данных;
* формирование payload;
* запуск выгрузки.

---

Методы:

```text
prepare_product()

build_payload()

export()
```

---

Использует:

```text
Ozon_Client
```

---

# 11. Ozon_Status_Checker

Проверка статусов.

---

Файл:

```text
includes/class-ozon-status-checker.php
```

---

Ответственность:

* получение статуса;
* обновление метаполей;
* сохранение ошибок.

---

Методы:

```text
check_status()

update_status()
```

---

Использует:

```text
Ozon_Client
```

---

# 12. Взаимодействие классов

```text
Admin
↓
Meta Box
↓
Exporter
↓
Client
↓
Ozon API
```

---

Проверка статуса:

```text
Meta Box
↓
Status Checker
↓
Client
↓
Ozon API
```

---

# 13. Работа с категориями

```text
Admin
↓
Category Manager
↓
Client
↓
API
```

---

# 14. Работа с атрибутами

```text
Meta Box
↓
Attributes Manager
↓
Client
↓
API
```

---

# 15. Разрешенные зависимости

### Ozon_Plugin

Может использовать:

```text
все классы
```

---

### Ozon_Admin

Может использовать:

```text
Ozon_Category_Manager
```

---

### Ozon_Product_Meta_Box

Может использовать:

```text
Ozon_Attributes_Manager
Ozon_Product_Exporter
Ozon_Status_Checker
```

---

### Ozon_Product_Exporter

Может использовать:

```text
Ozon_Client
```

---

### Ozon_Status_Checker

Может использовать:

```text
Ozon_Client
```

---

### Ozon_Category_Manager

Может использовать:

```text
Ozon_Client
```

---

### Ozon_Attributes_Manager

Может использовать:

```text
Ozon_Client
```

---

# 16. Запрещенные зависимости

Запрещено:

```text
Exporter → Admin

Client → Admin

Client → Meta Box

Status Checker → Admin

Category Manager → Exporter
```

---

# 17. Создание новых классов

Новый класс разрешается только если:

* невозможно расширить существующий;
* новая ответственность полностью независима.

---

Создание нового класса требует обновления:

```text
13_FREE_CLASS_DIAGRAM.md
```

---

# 18. Ограничение количества классов

FREE 1.0

Максимум:

```text
8 основных классов
```

---

Дополнительные классы запрещены без отдельного решения.

---

# 19. Подготовка к PRO

PRO обязан переиспользовать:

```text
Ozon_Client

Ozon_Category_Manager

Ozon_Attributes_Manager

Ozon_Product_Exporter

Ozon_Status_Checker
```

---

Запрещено дублировать эти классы в PRO.

---

# 20. Definition of Success

Архитектура считается успешной если:

* каждый класс имеет одну ответственность;
* отсутствует дублирование;
* код легко читается;
* OpenHands не создает лишние сущности;
* FREE остается компактным и понятным.

---

# 21. Главный закон архитектуры

Если новый функционал можно реализовать внутри существующего класса без нарушения его ответственности — новый класс создавать запрещено.
