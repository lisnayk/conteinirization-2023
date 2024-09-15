1. Поорівняння розмірів образів створених за допомогою Dockerfile
```shell
docker build --file 01_Dockerfile -t ubuntu-big:v1 .
docker build --file 02_Dockerfile -t ubuntu-small:v1 .
docker images

REPOSITORY                         TAG             IMAGE ID       CREATED          SIZE
ubuntu-small                       v1              12809dd89dd7   26 seconds ago   211MB
ubuntu-big                         v1              dc3183fcbeae   8 minutes ago    216MB
```
2. Порівнянн exec та shell форматів для Entrypoint
```shell
# ENTRYPOINT ["htop"] у exec форматі
docker build  --file 03_Dockerfile -t ubuntu-entrypoint:v1 .
docker run -it ubuntu-entrypoint:v1
  PID USER       PRI  NI  VIRT   RES   SHR S  CPU%-MEM%   TIME+  Command
    1 root        20   0  5516  4004  2884 R   0.0  0.2  0:00.00 htop

# ENTRYPOINT htop у shell форматі
docker build  --file 03_Dockerfile -t ubuntu-entrypoint:v1 .
docker run -it ubuntu-entrypoint:v2
  PID USER       PRI  NI  VIRT   RES   SHR S  CPU%-MEM%   TIME+  Command
    1 root        20   0  2800  1520  1520 S   0.0  0.1  0:00.00 /bin/sh -c htop
    7 root        20   0  5516  4112  2992 R   0.0  0.2  0:00.02 htop

```
3. Порівняння CMD та ENTRYPOINT
```shell
docker run -it ubuntu top
# Default CMD
docker build  --file 05_Dockerfile -t ubuntu-entrypoint-cmd:v3 .
docker run ubuntu-entrypoint-cmd:v3                                 
PING 8.8.8.8 (8.8.8.8) 56(84) bytes of data.
64 bytes from 8.8.8.8: icmp_seq=1 ttl=63 time=29.4 ms
64 bytes from 8.8.8.8: icmp_seq=2 ttl=63 time=29.3 ms
64 bytes from 8.8.8.8: icmp_seq=3 ttl=63 time=29.1 ms
64 bytes from 8.8.8.8: icmp_seq=4 ttl=63 time=28.3 ms

--- 8.8.8.8 ping statistics ---
4 packets transmitted, 4 received, 0% packet loss, time 3006ms
rtt min/avg/max/mdev = 28.281/29.020/29.377/0.439 ms

# Rewrite CMD
docker run ubuntu-entrypoint-cmd:v3 ukr.net -c 4
PING ukr.net (35.186.218.67) 56(84) bytes of data.
64 bytes from 35.186.218.67: icmp_seq=1 ttl=63 time=29.5 ms
64 bytes from 35.186.218.67: icmp_seq=2 ttl=63 time=32.9 ms
64 bytes from 35.186.218.67: icmp_seq=3 ttl=63 time=28.3 ms
64 bytes from 35.186.218.67: icmp_seq=4 ttl=63 time=29.1 ms

--- ukr.net ping statistics ---
4 packets transmitted, 4 received, 0% packet loss, time 3006ms
rtt min/avg/max/mdev = 28.337/29.971/32.943/1.767 ms

```
4. Keep container up
```shell
docker build  --file 06_Dockerfile -t ubuntu-bg:v1 .

5. Run nodeJS app
```shell
cd /07

