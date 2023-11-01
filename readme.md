# Sistema CRUD Empleados

## Descripción
Este proyecto es un Sistema de Empleados que permite la gestión de usuarios, empleados, cargos y acceso a través de un sistema de autenticación de inicio de sesión básico. Utiliza PHP y MySQL para gestionar y almacenar los datos. El diseño de la interfaz de usuario se ha construido utilizando Bootstrap 5 para un diseño atractivo y responsivo. Para la visualización de datos, se utiliza DataTables, y para la generación de cartas de recomendación en PDF, se ha integrado DomPDF. Además se utiliza la libería JavaScript SweetAlert2 para las notificaciones.

## Capturas de Pantalla
- Inicio de Sesión
![Inicio de Sesión](modulos/img/login.png)

- Lista de Empleados
![Lista de Empleados](modulos/img/empleadosListar.png)

- Lista de Usuarios
![Lista de Usuarios](modulos/img/usuariosListar.png)

- Lista de Cargos
![Lista de Cargos](modulos/img/cargosListar.png)

- Agregar Empleados
![Agregar Empleados](modulos/img/empleadosAgregar.png)

- Agregar Usuarios
![Agregar Usuarios](modulos/img/usuariosAgregar.png)

- Agregar Cargos
![Agregar Cargos](modulos/img/cargosAgregar.png)

- Editar Cargos
![Editar Cargos](modulos/img/cargosEditar.png)

- Eliminar Empleados
![Editar Cargos](modulos/img/empleadosEliminar.png)

- Buscar Usuarios
![Buscar Usuarios](modulos/img/usuariosBuscar.png)

- Carta de Recomendación en PDF
![Carta de Recomendación en PDF](modulos/img/cartaRecomendacion.png)

## Funcionalidades
El sistema incluye los siguientes módulos y características:

- **Usuarios**:
  - Creación, edición y eliminación de usuarios con diferentes roles.
  - Autenticación de inicio de sesión.

- **Empleados**:
  - Registro y gestión de información de empleados, incluyendo información personal, de contacto y laboral.
  - Asignación de cargos a empleados.
  - Generación de cartas de recomendación en formato PDF.

- **Cargos**:
  - Creación y gestión de cargos dentro de la empresa.

## Instrucciones de Instalación
1. Clona el repositorio en tu entorno de desarrollo local.

2. Configuración de la base de datos:
   - Crea una base de datos MySQL llamada `app_empleados_db` o puedes importar el archivo `app_empleados_db.sql` incluido en el proyecto.
   - Importa el archivo sql en la base de datos para crear las tablas necesarias.
   - Configura las credenciales de la base de datos en el archivo `conexion_db.php`.

3. Abre el proyecto en Visual Studio Code o tu editor de código preferido.

4. Ejecuta el proyecto en un servidor web local. Puedes usar herramientas como XAMPP o MAMP para configurar un entorno de desarrollo local.

5. Accede al sistema en tu navegador web: `http://localhost/tu_carpeta_del_proyecto`.

## Tecnologías Utilizadas
- PHP
- MySQL
- HTML
- CSS (Bootstrap 5)
- JavaScript (jQuery)
- DataTables (para la visualización y búsqueda de datos)
- DomPDF (para la generación de cartas de recomendación en PDF)
- -SweetAlert2 (para las ventanas de mensajes emergentes)

## Contribuciones
Si deseas contribuir al proyecto, por favor sigue estas pautas:
1. Realiza un fork del repositorio.
2. Crea una rama para tu contribución.
3. Realiza tus cambios y asegúrate de que todo funcione correctamente.
4. Envía un pull request a la rama principal.


## Autor
Sebastián García Carmona
2023
---

¡Gracias por interesarte en este proyecto! Si tienes alguna pregunta o comentario, no dudes en ponerte en contacto.
