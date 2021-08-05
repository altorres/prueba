## Install

#### Descargar los paquetes de composer
```
composer install
```
#### instalamos y ejecutamos las dependencias de node
```
npm install && npm run dev
```

#### Generar una copia de .env.example
```
cp .env.example .env
```
#### realizamos la conexion a  la base de datos con las respectivas credenciales

#### Generar un la llave de aplicacion 
```
php artisan key:generate
```
#### Crear acceso a la carpeta storage
```
php artisan storage:link
```
#### Generamos la migracion de la base de datos con los respectivos seeders
```
php artisan migrate --seed
```
#### Para iniciar sesion 
```
usuario= admin@admin.com
contraseña= contraseña
```
#### Si necesita generar datos de prueba ingrese a tinker
```
php artisan tinker
```
#### crear datos ficticios de empresas y empleados 
```
factory(App\Company::class, 10)->create();
factory(App\Employee::class, 50)->create();
```





