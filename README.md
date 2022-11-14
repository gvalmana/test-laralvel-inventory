# test-laralvel-inventory
API RestFull para inventarios de pruebas
### Consideraciones para el despliegue:
- Este proyecto tiene creado un Seeder para Productos el cual puede ser usado con el comando 
**php artisan migrate:fresh --seed --seeder=ProductoSeeder**
- Está incluido un fichero - docker-compose.yml para el despliegue con Docker

### Entorno con que se desarrollo:
- **Versión de Laravel:** 9.19
- **Versión de PHP:** 8.0.2
- **Motor de base de datos MariaDB:**  mariadb  Ver 15.1 Distrib 10.8.3-MariaDB