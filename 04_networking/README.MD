# Мережеві драйвери у Docker: огляд

Підсистема мережі Docker є розширюваною і використовує драйвери для надання основного функціоналу мережі:

1. **bridge (міст)**: Це тип мережі за замовчуванням. Якщо ви не вказуєте драйвер, це буде типом мережі, яку ви створюєте. Мережі мосту часто використовуються, коли ваша програма працює в контейнері і повинна спілкуватися з іншими контейнерами на тому самому хості. Докладніше дивіться в Bridge мережевому драйвері.

2. **host (хост)**: Знімає ізоляцію мережі між контейнером та хостом Docker та використовує мережу хоста безпосередньо. Докладніше дивіться в Host мережевому драйвері.

3. **overlay (накладення)**: Мережі накладення з'єднують кілька демонів Docker та дозволяють службам та контейнерам Swarm спілкуватися між вузлами. Ця стратегія виключає необхідність в маршрутизації на рівні операційної системи. Докладніше дивіться в Overlay мережевому драйвері.

4. **ipvlan (IPvlan)**: Мережі IPvlan дають користувачам повний контроль як над IPv4, так і над IPv6 адресацією. Драйвер VLAN побудований на цьому та надає операторам повний контроль над VLAN маркуванням на рівні 2 та навіть маршрутизацією IPvlan L3 для користувачів, які цікавляться інтеграцією мережі рівня підопору. Докладніше дивіться в IPvlan мережевому драйвері.

5. **macvlan (Macvlan)**: Мережі Macvlan дозволяють призначити контейнеру MAC-адресу, що робить його схожим на фізичний пристрій у вашій мережі. Демон Docker маршрутизує трафік до контейнерів за їх MAC-адресами. Використання драйвера macvlan іноді є найкращим вибором, коли ви маєте справу з легасі-застосунками, які очікують безпосереднього підключення до фізичної мережі, а не через мережевий стек хоста Docker. Докладніше дивіться в Macvlan мережевому драйвері.

6. **none (нічого)**: Повністю ізолює контейнер від хосту та інших контейнерів. Не доступний для Swarm служб. Докладніше дивіться в None мережевому драйвері.

Плагіни мережі: Ви можете встановлювати та використовувати сторонні плагіни мережі з Docker.

Короткий огляд мережевих драйверів:
- Мережа bridge за замовчуванням підходить для контейнерів, яким не потрібні спеціальні можливості мережі.
- Користувацькі мережі bridge дозволяють контейнерам на тому ж хості Docker спілкуватися між собою. Зазвичай користувацька мережа визначає ізольовану мережу для кількох контейнерів, які належать до спільного проекту або компонента.
- Мережа host ділить мережу хоста з контейнером. При використанні цього драйвера мережа контейнера не ізолована від хоста.
- Мережі overlay найкраще підходять, коли вам потрібно, щоб контейнери, що працюють на різних хостах Docker, спілкувалися, або коли декілька додатків співпрацюють за допомогою Swarm служб.
- Мережі macvlan найкраще використовувати, коли ви переходите з налаштувань ВМ або коли вашим контейнерам потрібно виглядати як фізичні пристрої в мережі, кожен зі своєю унікальною MAC-адресою.
- IPvlan схожий на Macvlan, але не надає унікальних MAC-адрес контейнерам.

## Links

- https://spacelift.io/blog/docker-networking
- https://training.play-with-docker.com/docker-networking-hol/
- https://training.play-with-docker.com/alacart/
- https://www.knowledgehut.com/blog/devops/docker-networking#container-network-model-(cnm)%C2%A0
- https://www.knowledgehut.com/blog/category/devops
- https://dev.to/leandronsp/mastering-the-docker-networking-2h57
- https://earthly.dev/blog/docker-networking/
- 

# Example
https://hub.docker.com/r/donch/net-tools
https://hub.docker.com/r/nicolaka/netshoot

```shell
# Example 1 - bridge network and link. PHP and MySQL
docker build --tag my-php .
docker run --rm -d --name my-mysql-container 
      -e MYSQL_ROOT_PASSWORD=123456 
      -e MYSQL_DATABASE=test_db
      -e MYSQL_USER=mysql -p 3306:3306 
      mysql:latest
      
docker run --rm -d -p 80:80 --name my-php-container --link my-mysql-container:db --hostmame my-php-hostname my-php

# Example 2 - bridge network and add-host. PHP and MySQL
docker run --rm -it  --name my-php-container --add-host db:192.168.1.45 -p 8080:80 --hostname my-php-hostname my-php
curl http://localhost:8080

docker run --rm -it  --name my-php-container1 --add-host db:192.168.1.45 --hostname my-php-hostname1 nicolaka/netshoot /bin/bash
ping db
PING db (192.168.1.45) 56(84) bytes of data.
64 bytes from db (192.168.1.45): icmp_seq=1 ttl=62 time=1.16 ms
64 bytes from db (192.168.1.45): icmp_seq=2 ttl=62 time=1.67 ms
64 bytes from db (192.168.1.45): icmp_seq=3 ttl=62 time=1.98 ms
64 bytes from db (192.168.1.45): icmp_seq=4 ttl=62 time=2.76 ms

docker network create --driver bridge --subnet 192.168.2.0/24 --gateway 192.168.2.1 net2
docker network inspect net2 
docker run --rm -it --name net-container1 nicolaka/netshoot /bin/bash

docker run --rm -it --name net-container1 nicolaka/netshoot /bin/bash
docker run --rm -it --name net-container2 nicolaka/netshoot /bin/bash
docker run --rm -it --name net-container2 --hostname container3 nicolaka/netshoot /bin/bash
# ping by IP
# ping by name

```
