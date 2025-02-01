# UD7 - Roles en PHP

Este repositorio contiene ejercicios prácticos sobre el uso de roles en PHP, permitiendo la gestión de datos de usuario en diferentes escenarios y asegurando la persistencia de la información entre solicitudes del servidor. 

## Autor

**Adrián López Pascual**

## Enunciados de los ejercicios

### **Gestión de Roles y Accesos**

1. **[Roles de Usuarios](Ej1/1.php)**  
   Se implementa un sistema de autenticación en el que los usuarios pueden iniciar sesión indicando su nombre y perfil. Existen tres perfiles disponibles:
   - **Gerente**: Tiene acceso a los resultados del salario mínimo, máximo y promedio.
   - **Sindicalista**: Puede visualizar únicamente el salario medio.
   - **Responsable de Nóminas**: Accede a los datos del salario mínimo y máximo.
   
   Según el rol seleccionado, el usuario es redirigido a una página específica que muestra la información correspondiente. Se utiliza el manejo de sesiones para mantener la autenticación y un botón de **"Cerrar sesión"** que permite volver a la página de inicio.

2. **[Clasificación de Usuarios](Ej2/2.php)**  
   Se implementa un formulario donde el usuario introduce sus datos personales, incluyendo nombre, apellido, asignatura, grupo, edad y si tiene un cargo o no. En función de estos datos, el sistema clasifica al usuario en uno de los siguientes perfiles:
   - **Delegado** (Mayor/Menor de edad con cargo)
   - **Estudiante** (Mayor/Menor de edad sin cargo)
   - **Profesor** (Mayor de edad con cargo)
   - **Director** (Mayor de edad con cargo)
   
   Cada perfil cuenta con una página personalizada donde se muestra un mensaje de bienvenida con los datos del usuario, así como un botón para **cerrar sesión** y regresar al formulario de identificación. 

## Notas

- Ambos ejercicios utilizan **sesiones** para gestionar la autenticación y la persistencia de datos.
- Se incluyen **validaciones en los formularios** para garantizar la correcta entrada de datos.
- Cada página de perfil muestra un **título indicando el rol** asignado y permite al usuario **cerrar sesión** en cualquier momento.

