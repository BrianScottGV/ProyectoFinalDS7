# Contexto del Proyecto: Plataforma de Recomendación de Películas/Series (PHP)

Este documento proporciona un resumen del proyecto, sus requisitos y el flujo de trabajo para la contribución al repositorio.

## 1. Objetivo General del Proyecto

Desarrollar una aplicación web dinámica utilizando PHP para una Plataforma de Recomendación de Películas/Series. La aplicación permitirá a los usuarios registrarse, iniciar sesión, explorar contenido y recibir recomendaciones personalizadas basadas en sus intereses, utilizando cookies, sesiones y webservices con XML/JSON.

## 2. Requisitos Clave

*   **Autenticación de Usuarios:**
    *   Registro e inicio de sesión.
    *   Roles de usuario: estándar y administrador.
*   **Manejo de Sesiones y Cookies:**
    *   Uso de sesiones para mantener el inicio de sesión.
    *   Uso de cookies para personalizar la experiencia (temas, nombre de usuario, últimas vistas).
    *   Diferenciación de la experiencia según el rol.
*   **Base de Datos:**
    *   Almacenamiento de información de usuarios, películas/series, calificaciones y preferencias.
    *   Relaciones adecuadas entre tablas (usuarios, contenido, géneros, etc.).
*   **Formulario de Registro de Preferencias:**
    *   Los usuarios podrán seleccionar sus géneros favoritos mediante checkboxes para filtrar recomendaciones.
*   **Sistema de Recomendaciones:**
    *   Mostrar contenido recomendado basado en géneros seleccionados o historial de navegación.
*   **Administrador:**
    *   Funcionalidades CRUD para películas/series.
    *   Resumen del comportamiento de los usuarios (ej. géneros más visitados).
*   **Consumo de Webservices:**
    *   Uso de al menos un archivo XML o JSON para alimentar o intercambiar información.
*   **Seguridad:**
    *   Validación y sanitización de formularios (XSS, SQLi, fuerza bruta).
    *   Estructura organizada de carpetas para restringir el acceso a ficheros sensibles.
*   **Interfaz:**
    *   Diseño amigable y organizado por secciones.
    *   Personalización visual básica (ej. tema claro/oscuro con cookies).

## 3. Contexto de la Tarea Actual (Issue #18)

**Persona 3 → Usuario (Perfil + Preferencias + Recomendaciones)**

**Módulos Involucrados:** `modules/user/`, `modules/recommendations/`

**Archivos Clave:**
*   `modules/user/controller.php`
*   `modules/user/model.php`
*   `modules/user/view_profile.php`
*   `modules/user/view_preferences.php`
*   `modules/recommendations/controller.php`
*   `modules/recommendations/model.php`
*   `modules/recommendations/view_recommendations.php`

**Responsabilidades:**
*   CRUD de perfil de usuario.
*   Preferencias de género.
*   Sistema de recomendaciones.

**Variables Relevantes:**
*   `$_SESSION['user_id']`
*   `$user_data`
*   `$_POST['genres[]']`
*   `$recommended_content`

## 4. Guía para Trabajar con el Repositorio (Workflow del Equipo)

Este documento explica los pasos a seguir para contribuir al proyecto, evitar conflictos y mantener la sincronización.

1.  **Clonar el repositorio (solo la primera vez):**
    ```bash
    git clone https://github.com/tu-usuario/nombre-del-repo.git
    cd nombre-del-repo
    ```
    *(Reemplazar `tu-usuario/nombre-del-repo` con la URL real del repositorio.)*

2.  **Descargar los últimos cambios del proyecto (siempre antes de comenzar a trabajar):**
    ```bash
    git checkout main
    git pull origin main
    ```

3.  **Crear una nueva rama para trabajar (nunca trabajar directamente en `main`):**
    ```bash
    git checkout -b nombre-de-tu-rama
    ```
    *Ejemplos: `git checkout -b login-feature`, `git checkout -b agregar-productos`, `git checkout -b correccion-estilos`*

4.  **Trabajar normalmente en tu código:**
    Realiza tus cambios en los archivos necesarios y guarda el progreso.

5.  **Agregar y guardar tus cambios:**
    ```bash
    git add .
    git commit -m "Descripción clara de lo que hiciste"
    ```
    *Ejemplo: `git commit -m "feat: agregar formulario de preferencias – closes #18"` (para cerrar el issue automáticamente)*

6.  **Subir tu rama al repositorio remoto:**
    ```bash
    git push origin nombre-de-tu-rama
    ```
    *Ejemplo: `git push origin login-feature`*

7.  **Crear Pull Request (PR):**
    *   Ve a `https://github.com` y entra al repositorio.
    *   Busca el botón "Compare & pull request".
    *   Proporciona una descripción clara de lo que hiciste.
    *   Asegúrate de que la rama base sea `main`.
    *   Haz clic en "Create pull request".

8.  **Una vez aprobado tu PR y fusionado a `main`:**
    Actualiza tu copia local:
    ```bash
    git checkout main
    git pull origin main
    ```

9.  **Eliminar ramas locales y remotas (opcional, para limpieza):**
    *   **Eliminar rama local:**
        ```bash
        git branch -d nombre-de-tu-rama
        ```
    *   **Eliminar rama remota (si ya fue fusionada):**
        ```bash
        git push origin --delete nombre-de-tu-rama
        ```

**Sugerencias:**
*   ✅ Siempre trabaja en ramas, no en `main`.
*   ✅ Haz `pull` del `main` antes de empezar.
*   ✅ Nombra tus ramas con sentido (`login-feature`, `fix-validacion`, `estilos-productos`).
*   ✅ Describe bien tus `commits`.
*   ✅ No hagas `push` sin `commit`.
