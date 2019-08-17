#### **Information about assembly**

#### **Creating by Vladimir Krupin vladimir.krupin133@mail.ru**

##### **Docker**

      docker-compose 
      nginx php:7.2-fpm 
      mysql:5.7 
      node:10 
      composer 
      phpmyadmin/phpmyadmin
      
      networks: driver: bridge ipam: config: - subnet:
      
##### **Framevorks**

      laravel/framework 5.4.*
      laravel/passport 1.0.*
      vue ^2.5.17
      vuex ^3.0.1
      @coreui/vue ^2.0.2
      axios >=0.18.1
      bootstrap ^4.1.3

**Quick start**

1. do not remember put nginx settings in config in you machine!

    and write server names in file /etc/hosts

    for example: i'am using for my project names:
    
        `127.0.0.1 api-skill api-dev-skill skill dev-skill pma-skill pma-dev-skill coverage-skill`
        
2. generate .htpasswd
   
   `htpasswd -c Autorun/pass/.htpasswd`
   
   default:
       login:    test
       password: test
       
3. up it now!

    `sh helper.sh`

after install project you have you have web:
        
        production version:
        
            localhost:8081 - YOUFOLDERNAME_docker_web_1
            localhost:8082 - YOUFOLDERNAME_docker_nodejs_1
            localhost:8084 - YOUFOLDERNAME_docker_phpmyadmin_1
        
        development version:
        
            localhost:8071 - YOUFOLDERNAME_dev_docker_web_1
            localhost:8072 - YOUFOLDERNAME_dev_docker_nodejs_1
            localhost:8074 - YOUFOLDERNAME_dev_docker_phpmyadmin_1
        
        
and serving containers:
    
        production version:
        
            YOUFOLDERNAME_docker_php_1
            YOUFOLDERNAME_docker_composer_1
            YOUFOLDERNAME_docker_mysql_1
        
        development version:
        
            YOUFOLDERNAME_dev_docker_php_1
            YOUFOLDERNAME_dev_docker_composer_1
            YOUFOLDERNAME_dev_docker_mysql_1
    


 