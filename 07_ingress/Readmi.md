```shell

minikube status
minikube addons list
minikube addons enable ingress

minikube service ingress-nginx-controller -n ingress-nginx
curl http://127.0.0.1:51950/healthz
 
```
