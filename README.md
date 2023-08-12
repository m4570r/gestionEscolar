# GestionEscolar API REST

GestionEscolar es una API REST diseñada específicamente para instituciones educativas, facilitando la gestión de estudiantes, matriculaciones, registros de salud y más. Está construida con PHP puro y MySQL para la base de datos. Aunque no cuenta con una interfaz gráfica de usuario, proporciona una estructura robusta y técnica para ser consumida directamente por una aplicación.

> **Nota:** Esta API es para uso técnico y directo de la aplicación. No está diseñada para ser accedida directamente por apoderados o alumnos. Solo personal técnico y desarrolladores deberían interactuar con ella.

## Tabla de Contenido
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Ejecución](#ejecución)
- [Documentación](#documentación)
- [Colaborar](#colaborar)
- [Licencia](#licencia)

## Requisitos

- PHP (versión recomendada 7.4+)
- MySQL (version 5.7+ recomendada)
- Servidor Apache

## Instalación

1. **Clonar el repositorio**
   
   ```bash
   git clone https://github.com/m4570r/gestionEscolar.git
   cd gestionEscolar
   ```

2. **Configurar la base de datos**

   - Importar el esquema de la base de datos desde la ubicación proporcionada en el repositorio.

## Configuración

1. **Archivo de configuración**

   Modificar el archivo `conexion.php` que se encuentra en la raíz del sitio. Ajusta los siguientes parámetros:
   - `host`
   - `nombre de la base de datos`
   - `usuario`
   - `contraseña`

## Ejecución

1. **Iniciar un servidor Apache**

   Coloca el contenido del repositorio clonado dentro del directorio `htdocs` de tu servidor Apache. Asegúrate de que el servidor esté corriendo para acceder a la API.

## Documentación

Para probar la API, puedes utilizar herramientas como [Postman](https://www.postman.com/) o acceder directamente a la interfaz de Swagger que se encuentra en el subdirectorio `/documentacion` después de que la API esté en ejecución.

## Colaborar

Si deseas colaborar en este proyecto, por favor lee las directrices que se encuentran en [CONTRIBUTING.md](#).

## Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo [LICENSE.md](#) para más detalles.

### Contacto
Ante cualquier duda, por favor contacta a [mgonzalez.gnu@gmail.com](mailto:mgonzalez.gnu@gmail.com).
