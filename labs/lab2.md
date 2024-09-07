# Лабораторна робота №2
## Тема: Загальні команди роботи з Docker
## Мета: Ознайомитись з основними командами Docker для роботи з контейнерами та образами.

### Теоретичні відомості
**Docker** - це платформа для розробки, розгортання та управління контейнерами. 
**Контейнери** - це ізольовані середовища, які містять усі необхідні залежності для виконання програмного забезпечення, включаючи бібліотеки, код та конфігурацію. Docker дозволяє упаковувати програми та їх залежності в контейнери, що забезпечує ізольоване та переносиме середовище для розробки та розгортання додатків.

Загальні команди Docker:
- **run** - Створити і запустити новий контейнер з образу 
- **exec** - Виконати команду в запущеному контейнері
- **ps** - Перелічити контейнери
- **build** - Побудувати образ з Dockerfile
- **pull** - Завантажити образ з реєстру
- **push** - Завантажити образ до реєстру
- **images** - Перелічити образи
- **login** - Увійти до реєстру
- **logout** - Вийти з реєстру
- **search** - Шукати образи на Docker Hub
- **version** - Показати інформацію про версію Docker
- **info** - Відобразити загальну інформацію про систему
- **inspect** - Показати детальну інформацію про контейнер або образ
- **stop** - Зупинити запущений контейнер
- **start** - Запустити зупинений контейнер
- **rm** - Видалити один або кілька контейнерів (можна використовувати з `-f` для примусового видалення)
- **prune** - Видалити невикористовувані об'єкти (контейнери, образи, томи, мережі)
- **rmi** - Видалити один або кілька образів

Опції -i та -t використовуються разом у команді docker run, щоб надати інтерактивний термінал всередині контейнера. Ось що вони означають:

- -i (інтерактивний режим): Ця опція дозволяє підтримувати стандартний ввід (STDIN) контейнера відкритим. Це означає, що ви зможете вводити команди в контейнер, навіть якщо ви не підключені до нього через термінал.

- -t (термінал): Ця опція створює псевдо-TTY (термінал). Вона забезпечує формати виходу (наприклад, кольоровий текст) і дозволяє відображати текстовий інтерфейс у термінальному вигляді.

Коли ви використовуєте обидві ці опції разом (-it), Docker надає вам інтерактивний термінал для вашого контейнера. 
Це дозволяє вам взаємодіяти з контейнером так, ніби ви працюєте безпосередньо з фізичною або віртуальною машиною через командний рядок.

Опція -d **(detached mode)** - Запускає контейнер у фоновому режимі (detached mode). Контейнер запускається у фоновому режимі і не відображає стандартний вихід (STDOUT) та стандартний помилковий вихід (STDERR) у вашому терміналі. Замість цього ви отримуєте ID контейнера.
**Приклад використання:**
```shell
docker run -d ubuntu sleep infinity
```

#### Деякі популярні образи Docker:
1. **Fedora** - Офіційний образ Fedora, популярної дистрибуції Linux, відомої своєю стабільністю та сучасними технологіями. [Посилання](https://hub.docker.com/_/fedora)

2. **Debian** - Офіційний образ Debian, одного з найстаріших і найбільш стабільних дистрибутивів Linux. [Посилання](https://hub.docker.com/_/debian)

3. **Alpine Linux** - Офіційний образ Alpine Linux, легкого дистрибутива Linux, який зосереджений на розмірі та безпеці. [Посилання](https://hub.docker.com/_/alpine)

4. **CentOS** - Офіційний образ CentOS, стабільного дистрибутива Linux для серверів, заснованого на Red Hat Enterprise Linux. [Посилання](https://hub.docker.com/_/centos)

5. **Ubuntu** - Офіційний образ Ubuntu, одного з найпопулярніших дистрибутивів Linux, відомого своєю простотою і підтримкою. [Посилання](https://hub.docker.com/_/ubuntu)

6. **Nginx** - Офіційний образ Nginx, веб-сервера, відомого своєю високою продуктивністю та низьким використанням ресурсів. [Посилання](https://hub.docker.com/_/nginx)

7. **Apache HTTP Server** - Офіційний образ Apache HTTP Server, одного з найстаріших і найвідоміших веб-серверів. [Посилання](https://hub.docker.com/_/httpd)

8. **LiteSpeed** - Офіційний образ LiteSpeed, високопродуктивного веб-сервера, який пропонує високу швидкість і підтримку безпеки. [Посилання](https://hub.docker.com/r/litespeedtech/litespeed)

9. **Caddy** - Офіційний образ Caddy, сучасного веб-сервера з автоматичним управлінням HTTPS. [Посилання](https://hub.docker.com/_/caddy)

10. **MySQL** - Офіційний образ MySQL, однієї з найбільш популярних реляційних баз даних. [Посилання](https://hub.docker.com/_/mysql)

11. **PostgreSQL** - Офіційний образ PostgreSQL, потужної реляційної бази даних з відкритим кодом. [Посилання](https://hub.docker.com/_/postgres)

12. **MongoDB** - Офіційний образ MongoDB, нереляційної бази даних, що використовує документи в форматі JSON. [Посилання](https://hub.docker.com/_/mongo)

13. **MariaDB** - Офіційний образ MariaDB, форку MySQL з відкритим кодом. [Посилання](https://hub.docker.com/_/mariadb)

14. **Redis** - Офіційний образ Redis, популярної бази даних, що працює в пам’яті та використовується для кешування і черг повідомлень. [Посилання](https://hub.docker.com/_/redis)

15. **Node.js** - Офіційний образ Node.js, популярного середовища виконання JavaScript на сервері. [Посилання](https://hub.docker.com/_/node)

## Завдання

1. Встановити Docker на власний пристрій.
2. Перевірити версію Docker та системну інформацію виконавши команди: 
```shell
docker --version
docker info
```
3. Запустити контейнери з образоів вебсервера та СКБД выдповдно віріанту у режимі демона.
```shell
// Web-server
docker run -d -p 8080:80 --name <firstname>-webserver <webserver-image>
// Database
docker run -d --name <firstname>-database <database-image>
```
4. Перевірити роботу веб-сервера виконавши запит до нього зі свого хостового браузера або за допомогою інструменту curl.
```shell
curl http://localhost:8080 // або відкрити url в браузері
```
5. Відобразити логи контейнеру СКБД.
```shell
docker logs <firstname>-database
```
6. Запустити контейнер ОС у інтерактивному режимі
```shell
docker run -it --name <firstname>-os <os-image> /bin/bash
> ls 
...
> exit
```
7. Запустити ОС у фоновому режимі та підключитися до нього для перегляду структури файлової системи.
```shell
docker run -d --name <firstname>-os-d <os-image> sleep infinity
docker exec -it <firstname>-os-d /bin/bash
> ls
```
8. Вийти з контейнера ОС та відобразити всі запущені контейнери.
```shell
docker ps
```
9. Зупинити контейнер веб-сервера та видалити його.
```shell
docker ps
docker stop <firstname>-webserver
docker rm <firstname>-webserver
```
10. Видалити всі контейнери та образи, які не використовуються.
```shell
docker ps -a
docker ps -a -q | xargs docker stop
docker ps -a -q | xargs docker rmdocker
```
11. Відобразити список всіх образів Docker.
```shell
docker images
```
12. Видалити всі образи Docker.
```shell
docker images -q | xargs docker rmi
```
13. Всі команди та результати виконання відобразити у звті.

## Варіанти завдань

| **№** | **ОС** | **Web-server** | **СКБД** |
|-------|------------------------------|-------------------------------|-------------------------|
| 1     | Fedora (`fedora`)             | Nginx (`nginx`)               | MySQL (`mysql`)         |
| 2     | Debian (`debian`)             | Caddy (`caddy`)               | Redis (`redis`)         |
| 3     | Alpine Linux (`alpine`)       | Caddy (`caddy`)               | MongoDB (`mongo`)       |
| 4     | CentOS (`centos`)             | LiteSpeed (`litespeedtech/litespeed`) | MariaDB (`mariadb`)     |
| 5     | Ubuntu (`ubuntu`)             | Apache (`httpd`)              | PostgreSQL (`postgres`) |
| 6     | Fedora (`fedora`)             | Apache (`httpd`)              | Redis (`redis`)         |
| 7     | Alpine Linux (`alpine`)       | LiteSpeed (`litespeedtech/litespeed`) | MySQL (`mysql`)         |
| 8     | Ubuntu (`ubuntu`)             | Nginx (`nginx`)               | MongoDB (`mongo`)       |
| 9     | CentOS (`centos`)             | Nginx (`nginx`)               | PostgreSQL (`postgres`) |
| 10    | Debian (`debian`)             | LiteSpeed (`litespeedtech/litespeed`) | MariaDB (`mariadb`)     |
| 11    | Fedora (`fedora`)             | Caddy (`caddy`)               | MongoDB (`mongo`)       |
| 12    | CentOS (`centos`)             | Apache (`httpd`)              | MySQL (`mysql`)         |
| 13    | Ubuntu (`ubuntu`)             | Nginx (`nginx`)               | Redis (`redis`)         |
| 14    | Debian (`debian`)             | Nginx (`nginx`)               | MySQL (`mysql`)         |
| 15    | Alpine Linux (`alpine`)       | Apache (`httpd`)              | MariaDB (`mariadb`)     |
| 16    | Fedora (`fedora`)             | LiteSpeed (`litespeedtech/litespeed`) | PostgreSQL (`postgres`) |
| 17    | Ubuntu (`ubuntu`)             | Caddy (`caddy`)               | Redis (`redis`)         |
| 18    | Debian (`debian`)             | Apache (`httpd`)              | MongoDB (`mongo`)       |
| 19    | CentOS (`centos`)             | Caddy (`caddy`)               | Redis (`redis`)         |
| 20    | Alpine Linux (`alpine`)       | Nginx (`nginx`)               | PostgreSQL (`postgres`) |


# Контрольні питання

- Як можна утримати контейнер з образом Ubuntu активним, щоб він не зупинявся одразу після запуску?

- Які опції використовуються в команді `docker run` для запуску контейнера в інтерактивному режимі?

- Як зупинити всі запущені контейнери Docker, використовуючи команду `docker stop`?

- Яка опція командного рядка Docker дозволяє запустити контейнер у фоновому режимі?

- Як ви можете зупинити всі запущені контейнери Docker, використовуючи `grep`?

- Що робить команда `docker inspect` і яку інформацію вона надає?**

- Які команди Docker дозволяють видаляти контейнери та образи?

