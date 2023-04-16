# Project name -- Stack

** Crear database
   -- 1. Copiar el script del directorio [database/schema.sql]
   -- 2. Posteriormente crear su db en su maquina o hosting.
   -- 3. Copiar el script del directorio [database/data.sql] son datos a modo de ejemplo.
   -- 4. Posteriormenet rellenar las tablas de su db.

** Configurar la conexion con la database
   -- 1. Ingresar las credenciales de su database en el directorio [config/connection.php]

** Uso
    -- Cuenta con 2 roles de usuario
      .Administrador      -->  Realiza el Alta, Baja y modificacion de los usuarios.
      .Usuario            -->  Solo realiza el cuestionario de preguntas.

    -- Cuenta con un cuestionario de preguntas para que los usuarios puedan responderlo
      .El resultado que obtenga cada usuario que realiza el test se guardara en la database. 

** Tecnologias utilizadas
   .PHP implementacion de PDO
   .Framework Bootstrap
   .HTML5
   .CSS3
   .DB MySql
   .md5