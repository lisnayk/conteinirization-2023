# Лекція 1. Вступ до Kubernetes


- За останні кілька років оркестрація контейнерів, зокрема платформи як Kubernetes, стала домінуючим інструментом для управління 
контейнерами в різних галузях. Kubernetes є найпопулярнішою платформою, займаючи близько 85-90% ринку оркестрації контейнерів, 
і її популярність продовжує зростати серед великих підприємств та середнього бізнесу. Це пов'язано з її гнучкістю, масштабованістю 
та здатністю автоматизувати управління контейнерами для складних середовищ, що включають мікросервісні архітектури та DevOps-практики.

Основними конкурентами Kubernetes серед систем оркестрації контейнерів є:

- **Docker Swarm** – інтегрована система оркестрації контейнерів Docker, що спрощує процес створення та управління контейнерами. Вона підходить для менших проектів завдяки простоті використання, але поступається Kubernetes у функціональності та масштабованості.

- **Apache Mesos (з Marathon)** – платформа для управління контейнерами та іншими додатками на великих кластерах. Marathon, фреймворк Mesos, підтримує автоматичне відновлення, а також простий запуск і моніторинг контейнерів, що робить його привабливим для великих корпоративних проектів.

- **OpenShift від Red Hat** – платформа на основі Kubernetes, яка надає додаткові інструменти для безпеки, а також DevOps-функції, що робить її зручною для підприємств, що шукають інтегроване рішення.

- **Nomad від HashiCorp** – легкий та простий інструмент оркестрації, що підтримує різні типи робочих навантажень, не лише контейнери. Nomad підходить для проектів, які вимагають універсальності та менших витрат на ресурси, хоча він менш функціональний у порівнянні з Kubernetes.

- **Rancher** – платформа управління для кількох кластерів Kubernetes, що спрощує створення, управління та моніторинг Kubernetes у великомасштабних середовищах. Rancher став популярним серед компаній, які хочуть оптимізувати управління кластерами Kubernetes.

Ці платформи відрізняються рівнем інтеграції, функціональними можливостями та простотою використання, і вибір однієї з них залежить від вимог до масштабу, функцій і рівня складності проекту


![stat.png](assets%2Fstat.png)

https://kubernetes.io/uk/docs/tutorials/hello-minikube/

Запуск Kubernetes на локальному комп'ютері за допомогою Minikube
```
minikube start
minikube status
minikube dashboard (see the dashboard in browser)
```
**Pod у Kubernetes** -- це група з одного або декількох контейнерів, що об'єднані разом з метою адміністрування і роботи у мережі. 
У цьому навчальному матеріалі Pod має лише один контейнер. 

**Kubernetes Deployment** перевіряє стан Pod'а і перезапускає контейнер Pod'а, якщо контейнер перестає працювати. 
Створювати і масштабувати Pod'и рекомендується за допомогою Deployment'ів.

```
kubectl config get-clusters
kubectl config set-cluster minikube
kubectl get pods -A
kubectl get pods

kubectl run nginx --image=nginx --port=80
kubectl run apache --image=httpd --port=80

kubectl expose pod nginx --type=NodePort --name=nginx-service --port=80 
kubectl expose pod apache --type=NodePort --name=apache-service --port=80

minikube service nginx-service

// delete all pods and services

kubectl create deployment web --image=nginx
kubectl expose deployment web --type=NodePort --port=80 

kubectl scale deployment web --replicas=3 

 kubectl create deployment web-info --image=nginxdemos/hello
 kubectl expose deployment web-info --type=NodePort --port=80
 minikube service web-info 
 kubectl scale deployment web-info --replicas=3
 minikube service web-info
 
 kubectl rollout history deployments/web-info
 kubectl edit deployment web-info 
 kubectl rollout status deployments/web-info 
 kubectl rollout undo deployment/web-info 
 // Show diferent ways update diployment

```




