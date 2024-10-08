# Лабораторна робота №4. Робота з Docker Volumes

## Мета: Ознайомитися з томами Docker та їх використанням.

### Теоритичні відомості

У Docker є кілька типів зберігання, які використовуються для роботи з даними в контейнерах (рис 4.1). Основні типи включають:
- **Volumes** - найпоширеніший спосіб зберігання даних у Docker. Томи керуються Docker і зберігаються в спеціальній директорії на хості, що робить їх незалежними від життєвого циклу контейнерів. Дозволяють зберігати дані між перезапусками або знищенням контейнерів. Вони використовуються для зберігання даних баз даних або конфігурацій, які потребують довготривалого зберігання.
- **Bind mounts** -  тип зберігання, де ви вказуєте конкретну директорію на вашому хості, яку Docker монтує всередину контейнера. У порівнянні з томами, це забезпечує більше контролю над тим, де зберігаються дані. Використовується для доступу до файлів на хості, що корисно при розробці, коли необхідно взаємодіяти з локальними файлами.
- **tmpfs mounts** - тимчасове зберігання, яке використовується лише під час роботи контейнера. Дані зберігаються в оперативній пам'яті та видаляються після завершення роботи контейнера й виикористовується для зберігання тимчасових даних, наприклад, при роботі з кешем або даними, які не потребують довготривалого зберігання.

![img.png](/labs/assets/img.png)

Рисунок 4.1 - Типи зберігання в Docker

Незалежно від того, який тип монтування ви виберете, дані виглядатимуть однаково всередині контейнера. Він доступний або як каталог, або як окремий файл у файловій системі контейнера.

### Docker volumes

**Docker Volumes** — це зручний і продуктивний спосіб управління даними, що допомагає їх зберігати між перезапусками контейнерів.
Існують два типи volumes:
 - **Анонімні** - томи, які створюються без явної вказівки імені. Вони автоматично видаляються після видалення контейнера, якщо не використовуються іншими контейнерами.
 - **Іменовані** - томи, які явно мають назву і можуть бути повторно використані в інших контейнерах. Іменованими томами легко керувати, оскільки є вожливість звертатися до них за іменем.

Для керування іменованими томами використовуются наступні консольні команди:

| **Команда**     | **Опис**                                                    |
|-----------------|-------------------------------------------------------------|
| `create`        | Створення тому                                               |
| `inspect`       | Виведення детальної інформації про один або кілька томів     |
| `ls`            | Виведення списку томів                                       |
| `prune`         | Видалення невикористовуваних локальних томів                 |
| `rm`            | Видалення одного або кількох томів                           |

Напрриклад, створення іменованого тому виконується командою:
```shell
docker volume create mysql-data
docker volume inspect mysql-data
[
    {
        "CreatedAt": "2024-09-29T05:24:49Z",
        "Driver": "local",
        "Labels": null,
        "Mountpoint": "/var/lib/docker/volumes/mysql-data/_data",
        "Name": "mysql-data",
        "Options": null,
        "Scope": "local"
    }
]
```

### Bind mounts

Bind mounts існує з перших днів Docker та маэ обмежену функціональність порівняно з томами. Коли використовуєтся Bind mounts, файл або каталог на головній машині монтується в контейнер.
На файл або каталог посилається його абсолютний шлях на головній машині.
Файл або каталог не обов’язково повинні існувати на хості Docker. Він створюється на вимогу, якщо його ще немає. Bind mounts дуже продуктивне, але воно залежить від файлової системи хост-машини, яка має певну структуру каталогів. 
Якщо каталог монтуэться до непорожнього каталогу в контейнері, існуючий вміст каталогу буде приховано монтуванням прив’язки. 
Це може бути корисним, наприклад, коли ви хочете протестувати нову версію програми без створення нового образу. Однак це також може бути несподіваним, і така поведінка відрізняється від поведінки томів.

### Параметри для монтування -v та --mount

Для використанння томів в Docker можна використовувати параметри команди `run` -v (--volume) або --mount. Обидва параметри використовуються для монтування томів, але мають різний синтаксис та функціональність.
Загалом, --mount більш відвертий і багатослівний. Найбільша різниця між ними полягає в тому, що -v синтаксис об’єднує всі параметри в одному полі, тоді як --mount синтаксис розділяє їх.

Аргумент -v або --volume - складається з трьох полів, розділених двокрапкою (:). Поля мають бути в правильному порядку, і значення кожного поля не є очевидним.

 - У випадку **Bind mounts** перше поле — це шлях до файлу або каталогу на головній машині, або джерело а у разі іменованих томів перше поле — це ім’я тому, яке є унікальним на певній головній машині. Для анонімних томів перше поле опускається.
 - Друге поле — це шлях, куди змонтовано файл або каталог у контейнері.
 - Третє поле є необов’язковим і являє собою список параметрів, розділених комами, наприклад ro (readonly).

Аргументи --mount - складається з кількох пар ключ-значення, розділених комами, кожна з яких складається з <key>=<value> кортежу. 
Синтаксис --mount більш детальний, ніж -v або --volume, але порядок ключів не є значущим, і значення прапора легше зрозуміти. 
Найнеохідніші ключі --mount включають:
 - `type` може приймати значення `bind`, `volume` або `tmpfs`.
 - `source` або `src` - шлях до файлу або каталогу на хості, ім’я тому для іменованих томів або залишаэться пустим для анонімних томів.
 - `destination`, `dst` або `target` - шлях монтування або файл або каталог у контейнері.

### Приклади використання параметрів -v та --mount:

Запуск контейнер mysql з використання іменованих томів
```shell
docker volume create mysql-db
docker volume inspect mysql-db
docker run --name mysql -e MYSQL_ROOT_PASSWORD=123456 -e MYSQL_DATABASE=test_db -e MYSQL_USER=mysql -d -p 3306:3306 --mount source=mysql-db,target=/var/lib/mysql mysql:latest
# або
docker run --name mysql -e MYSQL_ROOT_PASSWORD=123456 -e MYSQL_DATABASE=test_db -e MYSQL_USER=mysql -d -p 3306:3306 -v mysql-db:/var/lib/mysql mysql:latest
docker inspect mysql

"Mounts": [                          
     {                                
         "Type": "volume",            
         "Name": "mysql-db",          
         "Source": "/var/lib/docker/vo
         "Destination": "/var/lib/mysq
         "Driver": "local",           
         "Mode": "z",                 
         "RW": true,                  
         "Propagation": ""            
     }                                
 ],                                   
```

## Завдання

1. В робочій директорії створіть нову директорію `html` з вайлом `index.html` який містить інформацію про студента який виконує роботу (Спеціальність, курс, група, ПІБ, назва курсу).
2. Використовуючи **Bind mounts** змонтувати директорію `html` в контейнер вебсерверу `nginx` та `apache` в кореневу директорію вебсерверу за замовченням та відкрити порти 8080 та 8081 відповідно.
3. Протестувати роботу вебсерверів за допомогою браузера (http://localhost:8080 та http://localhost:8081).
4. Змынити вміст файлу `index.html` та перевірити зміни в браузері.
5. Зупинити контейнери та видалити їх.
6. Створити `named volumes` за шаблоном `<скбд>-data` контейнерів СКБД `mysql` та `postgres`.
7. Запустити контейнери СКБД `mysql` та `postgres` з використанням `named volumes` та перевірити що дані зберігаються між перезапусками контейнерів.
8. Проінспектувати `named volumes` та перевірити де зберігаються дані.
9. Зупинити контейнери та видалити їх.
10. Виконати завдання 1-9 використовуючи параметр `--mount` замість `-v` або навпаки.
11. Для образу вебсерверу створенного у попередній роботі оновити dockerfile додавши VOLUMES на кореневу директорію вебсервера за замовченням. 
12. Перебудувати образ та зьерегти його в реєстрі з тегом v2.0.
13. Протестувати роботу вебсерверів з новим образом виконавши дыъ аналогічні крокам 1-5.

## Контрольні питання

1. Що таке Docker Volumes та які основні переваги їх використання?
2. Яка різниця між анонімними та іменованими томами?
3. Для яких типів даних краще використовувати Bind mounts замість Volumes?
4. Чим відрізняються tmpfs mounts від інших типів зберігання в Docker?
5. Який синтаксис використовується для створення та монтування тому за допомогою команди -v?
6. У чому різниця між параметрами -v та --mount для роботи з томами?
7. Який тип монтування дозволяє зберігати дані виключно в оперативній пам’яті контейнера і видаляє їх після завершення роботи контейнера?
8. Які дії виконує команда docker volume prune?
9. Що станеться, якщо монтувати порожній том у каталог контейнера, в якому вже є файли або папки?
10. Як перевірити місцезнаходження змонтованого тому на Docker-хості?


