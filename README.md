# Laravel 8 API Order

##### 1.1.	Cloning API product by GITHUB

Run the command bellow on Bash:
```
$  git clone https://github.com/carlosclayton/api-order
```  

##### 1.2.	Env

Run the command bellow on Bash:
```
$  cp .env.example .env
```  
Add the variables below to the .env file:

LOCAL_USER=[YOUR_USER_SYSTEM]
USER_ID=[YOUR_USER_ID_SYSTEM]
GROUP_ID=[YOUR_GROUP_ID_SYSTEM]

Run the command bellow on Bash to up:
```
$  docker-compose up -d --build
```  

Run the command bellow on Bash migrate DB with seed:
```
$  php artisan migrate --seed
```  

##### 1.3.	Endpoints

Run the command bellow on Bash:
```
$  php artisan api:routes
```  

### 1.4	Test

Run the command bellow

```
$  vendor/bin/phpunit --filter OrderTest --testdox
```
