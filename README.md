# ProyectoFinalDS7
Este repositorio contiene el proyecto final del curso de desarrollo 7


🚀 Guía para trabajar con el repositorio (Workflow del equipo)
Este documento explica los pasos que debes seguir cada vez que trabajes con el proyecto, para evitar conflictos y mantener todo sincronizado.


🧱 1. Clonar el repositorio (solo la primera vez)

  git clone https://github.com/tu-usuario/nombre-del-repo.git
  cd nombre-del-repo
  Cambia tu-usuario/nombre-del-repo por la URL real del repositorio.


🔄 2. Descargar los últimos cambios del proyecto
  Haz esto siempre antes de comenzar a trabajar.
  
  git checkout main
  git pull origin main

  
🌿 3. Crear una nueva rama para trabajar

  Nunca trabajes directamente en main. Crea una rama para cada funcionalidad o tarea que hagas.
  git checkout -b nombre-de-tu-rama

  Ejemplos:
  git checkout -b login-feature
  git checkout -b agregar-productos
  git checkout -b correccion-estilos

  
💻 4. Trabaja normalmente en tu código
  Haz tus cambios en los archivos necesarios y guarda el progreso. Luego sigue con los pasos para guardarlos y subirlos.


💾 5. Agregar y guardar tus cambios

  git add .
  git commit -m "Descripción clara de lo que hiciste"
  
  Ejemplo:
  git commit -m "Agregué pantalla de login con validación básica"


☁️ 6. Subir tu rama al repositorio remoto

  git push origin nombre-de-tu-rama
  Ejemplo:
  git push origin login-feature

  
🔃 7. Crear Pull Request (PR)
  Ve a https://github.com y entra al repositorio.
  
  Verás un botón que dice "Compare & pull request".
  
  Da una descripción clara de lo que hiciste.
  
  Asegúrate de que la rama base sea main.
  
  Haz clic en "Create pull request".

  
✅ 8. Una vez aprobado tu PR y fusionado a main
  Después de que tu código esté en main, actualiza tu copia local:
  
  git checkout main
  git pull origin main

  
🧹 9. Eliminar ramas locales y remotas (opcional, para limpieza)
  Eliminar rama local:

  git branch -d nombre-de-tu-rama
  Eliminar rama remota (si ya fue fusionada):
  git push origin --delete nombre-de-tu-rama

  
🧠 Sugerencias
✅ Siempre trabaja en ramas, no en main.

✅ Haz pull del main antes de empezar.

✅ Nombra tus ramas con sentido (login-feature, fix-validacion, estilos-productos).

✅ Describe bien tus commits.

✅ No hagas push sin commit.
