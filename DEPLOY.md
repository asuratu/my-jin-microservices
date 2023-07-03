# docker安装

Nacos

 ```bash  
  1. make nacos
  2. cd conf
  3. 在 application.properties 文件中, 修改 nacos.core.auth.default.token.secret.key 为 SecretKey012345678901234567890123456789012345678901234567890123456789
 
```

Rabbitmq

 ```bash  
  1. 如果不显示web管理界面, 请执行以下命令
  2. make rabbit-web
  
```
