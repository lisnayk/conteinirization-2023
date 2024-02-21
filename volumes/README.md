# Docker Volumes
Кожний контейнер створюється з визначення образу кожного разу при запуску. 
Хоча контейнери можуть створювати, оновлювати та видаляти файли, 
всі зміни втрачаються, коли видаляєте контейнер, і Docker ізолює 
всі зміни до цього контейнера. За допомогою volumes можливо змінити цю ситуацію.

**Volumes** надають можливість підключати конкретні шляхи файлової системи контейнера 
назад до машини-хоста. Якщо ви монтуєте каталог в контейнері, 
зміни в цьому каталозі також будуть видно на машині-хості. 
Якщо ви монтуєте той самий каталог при перезапуску контейнера, 
ви побачите ті ж самі файли.


## Збереження данних MySql

За замовчуванням mysql зберігає дані в за шляхом /var/lib/mysql.
Якщо зберегти файли данної директорії на хості 
і зробити їх доступним для наступного контейнера, 
то дані не будуть втраченими після зупинки контенеру.
Створивши **Volumes** і прикріпивши його (часто називається "монтуванням") до каталогу,
де ви зберегли дані, ви можете зберегти дані. 
Коли ваш контейнер записує файли удиректорії /var/lib/mysql, 
він зберігає дані на хості в **Volumes**.

## Створення **Volumes** та запуск контейнеру

Створити **Volumes** та запустити контейнер можливо за допомогою командного рядка 
або графічного інтерфейсу Docker Desktop.

### Створіть об'єм за допомогою команди docker volume create.
```
docker volume create mysql-db
docker volume inspect mysql-db
```

Запустіть контейнер mysql та додайте параметр --mount, щоб вказати монтування **Volumes**. 
Надайте **Volumes** ім'я і приєднайте його до каталогу /var/lib/mysql в контейнері, 
який захоплює всі файли, створені за цим шляхом. 

```
docker run --name mysql -e MYSQL_ROOT_PASSWORD=123456 -e MYSQL_DATABASE=test_db -e MYSQL_USER=mysql -d -p 3306:3306 --mount source=mysql-db,target=/var/lib/mysql mysql:latest
```
Якщо ви хочете знати, де Docker зберігає дані, ви можете скористатися командою:
```
docker volume inspect mysql-db
[
    {
        "CreatedAt": "2023-09-28T13:32:35Z",
        "Driver": "local",
        "Labels": null,
        "Mountpoint": "/var/lib/docker/volumes/mysql-db/_data",
        "Name": "mysql-db",
        "Options": null,
        "Scope": "local"
    }
]
```
## Bind mounts

Bind mounts — це ще один тип монтування, який дозволяє надати спільний доступ до каталогу з файлової системи хоста в контейнер. 
рацюючи над програмою, ви можете використовувати Bind mounts, щоб змонтувати вихідний код у контейнер. 
Контейнер одразу бачить зміни, які ви вносите в код, щойно ви зберігаєте файл. 
Це означає, що ви можете запускати процеси в контейнері, які спостерігають за змінами файлової системи та реагують на них.

У наведеній нижче таблиці наведено основні відмінності між volumes та bind mounts.

|     | Named volumes | Bind mounts |
| --- | --- | --- |
| Host location | Docker chooses | You decide |
| Mount example (using `--mount`) | `type=volume,src=my-volume,target=/usr/local/data` | `type=bind,src=/path/to/data,target=/usr/local/data` |
| Populates new volume with container contents | Yes | No  |
| Supports Volume Drivers | Yes | No  |

Для запуску попереднього прикладу використовуйте команду:
```
docker run --name mysql -e MYSQL_ROOT_PASSWORD=123456 -e MYSQL_DATABASE=test_db -e MYSQL_USER=mysql -d -p 3306:3306 
--mount type=bind src=<local-patch>/db,target=/var/lib/mysql 
mysql:latest

```
або у альтернативному вигляді:
```
docker run --name mysql -e MYSQL_ROOT_PASSWORD=123456 -e MYSQL_DATABASE=test_db -e MYSQL_USER=mysql -d -p 3306:3306 -v <local-patch>/db:/var/lib/mysql mysql:latest
```
