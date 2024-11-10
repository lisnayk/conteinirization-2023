# Лекція 1. Вступ до Kubernetes

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
minikube service web

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




