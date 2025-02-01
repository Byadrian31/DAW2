# UD7 - Token en Formularios

Este repositorio contiene ejercicios prácticos sobre el uso de **tokens de formulario** en PHP para asegurar la sesión de cada usuario. Se implementa un sistema de autenticación con diferentes roles y validación mediante tokens de sesión para prevenir ataques CSRF.

## Autor

**Adrián López Pascual**

## Enunciados de los ejercicios

### **1. Token en Formulario de Roles (Ejercicio 1)**

📌 **[Ejercicio 1 - Roles de Usuarios](Ej1/1.php)**  

Se implementa un sistema de autenticación con un **token de formulario** para validar la sesión del usuario. Este sistema clasifica a los usuarios en tres roles diferentes y los redirige a su página correspondiente:

- **Gerente**: Puede visualizar el salario mínimo, máximo y promedio.
- **Sindicalista**: Solo tiene acceso al salario medio.
- **Responsable de Nóminas**: Puede consultar los salarios mínimo y máximo.

🔒 **Seguridad Implementada**:
- Se genera un **token único** en la sesión que se envía con el formulario.
- Se valida el **token recibido** en la página de destino.
- Si el token no coincide, se muestra un mensaje de error y se redirige al usuario al formulario de autenticación.
- Se incluye un botón **"Cambiar SID"** que genera un nuevo token para comprobar si la sesión sigue siendo válida.

---

### **2. Token en Formulario de Clasificación de Usuarios (Ejercicio 2)**

📌 **[Ejercicio 2 - Clasificación de Usuarios](Ej2/2.php)**  

Este ejercicio amplía el uso de **tokens de sesión** y la autenticación mediante formularios para clasificar a los usuarios según sus datos personales:

- **Delegado** (Menor o mayor de edad con cargo)
- **Estudiante** (Menor o mayor de edad sin cargo)
- **Profesor** (Mayor de edad sin cargo)
- **Director** (Mayor de edad con cargo)

🔒 **Seguridad Implementada**:
- Cada usuario introduce su nombre, apellido, asignatura, grupo, edad y si tiene un cargo.
- Se genera un **token de seguridad** en la sesión que se compara en la página de destino.
- Si el token no coincide, el sistema muestra un mensaje de error y devuelve al usuario al formulario.
- Se incorpora la opción de **"Cambiar SID"** para generar un nuevo token y validar la autenticación.

---

## 🚀 Tecnologías Usadas
- **PHP** (Manejo de sesiones y autenticación)
- **HTML** (Estructura de formularios)
- **CSS** (Estilización de las páginas)
- **Tokens de seguridad** (Protección contra CSRF)
- **Manejo de sesiones** (Persistencia de datos entre páginas)

## ℹ️ Notas Finales
- Ambos ejercicios implementan **sesiones seguras** para gestionar la autenticación del usuario.
- Se previenen ataques de falsificación de solicitudes mediante **tokens únicos**.
- Se redirige a los usuarios a su página correspondiente **según su rol**.
- Se proporciona una opción para **cerrar sesión** y regresar al formulario de inicio.

📌 **Ejecuta los archivos `1.php` y `2.php` en un servidor local.**
