# API CRUD PRODUCTOS

## Instrucciones de uso
En el archico Conection.php coloque las credenciales de su base de datos dentro de las '' para que el código pueda ejecutar la funcion de actualizar
 instale un servidor que le permita correr código php y el motor de base de datos de su preferencia en mi caso utlicé [XAMPP](https://www.apachefriends.org/download.html)

 Si decide usar XAMPP debe alojar la carpeta del proyecto en la ruta capartetaraiz/htdocs ejemplo: XAMPP/htdocs/nombreproyecto.

## pruebas
Para realizar las pruebas del proyecto puede usar un cliente como [Postman](https://www.postman.com/downloads/), al tenerlo instalado puede probar realizando una petición con los siguentes parámetros


- Tipo de petición: GET 
- URL ejemplo : http://localhost/api/producto
- Tipo de contenido: JSON

- Tipo de petición: GET 
- URL ejemplo : http://localhost/api/producto/id
- Tipo de contenido: JSON


- Tipo de petición: POST 
- URL ejemplo : http://localhost/api/producto
- Tipo de contenido: JSON
- Body de la petición de ejemplo:{
    "id": 320,
    "nombre": "Queso",
    "precio": 1500,
    "cantidad": 34,
    "stock": 100
  }

- Tipo de petición: PUT 
- URL ejemplo : http://localhost/api/producto/id
- Tipo de contenido: JSON
- Body de la petición de ejemplo:{
    
    "nombre": "Queso",
    "precio": 1500,
    "cantidad": 34,
    "stock": 100
  }

- Tipo de petición: DELETE 
- URL ejemplo : http://localhost/api/producto/id
- Tipo de contenido: JSON
