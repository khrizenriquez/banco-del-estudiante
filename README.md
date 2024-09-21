# Problema

**Sistema de Banca en Línea:** El presente proyecto consiste en el diseño e implementación de un sistema de Banca en Línea.

El proyecto consiste en una aplicación web que permite realizar transferencias monetarias entre los usuarios registrados, pudiendo visualizar y llevar control de las transferencias realizadas. Ya que es una aplicación bancaria, se necesita manejar cierto nivel de seguridad, por lo que es importante realizar todas las validaciones indicadas en la definición del proyecto.

## Objetivos

- Que el estudiante comprenda el concepto de Diseño Responsivo.
- Que el estudiante mejore sus conocimientos de HTML5/CSS3.
- Que el estudiante ponga en práctica los conocimientos adquiridos en el diseño de páginas dinámicas, implementación de portales web, mantenimiento y soporte de servidores web.

## Entregables

El sitio debe de contar con 4 opciones:

1. **Página principal del banco:** Deberá contar con un encabezado con logo y nombre del banco, y cuatro enlaces:

   a. **Inicio de sesión de administrador (5 pts):** Pantalla para ingreso de usuario y clave de administrador. Si la autenticación es exitosa, deberá de dirigir al administrador al panel de administrador.

   b. **Inicio de sesión de usuario (5 pts):** Pantalla para ingreso de usuario y clave de usuario cliente del sistema. Si la autenticación es exitosa, deberá de dirigir al usuario al panel de usuario.

   c. **Iniciar sesión de cajero (5 pts):** Pantalla para ingreso de usuario y clave de cajero. Si la autenticación es exitosa, deberá de dirigir al administrador al panel de cajero.

   d. **Registro de nuevo usuario (5 pts):** Deberá mostrar un formulario para el registro de un nuevo usuario con la siguiente información:

   i. No. Cuenta Bancaria

   ii. Correo Electrónico (el correo electrónico se utilizará como el nombre de usuario)

   iii. DPI

   iv. Contraseña

   v. Confirmación de Contraseña

   **Tomar en cuenta lo siguiente:**

    - Para que un cliente pueda crear un usuario, la cuenta bancaria debió haber sido creada previamente por un cajero. Es decir, un cliente asiste primero al banco a crear su cuenta bancaria, y posteriormente puede ingresar al portal del banco a crear un usuario para realizar transacciones en línea.
    - Por tanto, el formulario deberá validar que la cuenta bancaria exista, que el número de DPI coincida con el registrado en la cuenta, y que no existe ningún otro usuario registrado para esa cuenta.

2. **Panel de administrador:** Para poder ingresar al panel de administrador, el usuario administrador deberá iniciar sesión en el sistema. Una vez iniciada la sesión de administrador, podrá realizar las siguientes funciones:

   a. **Gestión de usuarios de cajeros (5 pts):** Presentará un listado de usuarios de cajeros, con la opción de poder bloquear/desbloquear un usuario, y de poder agregar nuevos usuarios. Para agregar un nuevo usuario el sistema deberá solicitar:

   i. Nombre Completo

   ii. Usuario

   iii. Clave

   iv. Confirmación de Clave

   b. **Monitor de transferencias (10 pts):** Presentará una página con dos secciones.

   i. **La primera sección mostrará:**

         1. Cantidad de cuentas creadas en el día

         2. Cantidad de usuarios cliente registrados en el día (excluir usuarios de cajero)

         3. Cantidad de transacciones

         4. Cantidad de depósitos

         5. Cantidad de retiros

   ii. **La segunda sección mostrará una gráfica que muestre la cantidad monetaria en depósitos vs la cantidad monetaria en retiros.**

   c. **Salir:** Cerrar sesión y salir del sistema.

3. **Panel de cajero:** Para poder ingresar al panel de cajero, el usuario cajero deberá iniciar sesión en el sistema. Una vez iniciada la sesión de cajero, podrá realizar las siguientes funciones:

   a. **Crear cuenta monetaria (5 pts):** Deberá presentar un formulario para agregar nuevas cuentas con la siguiente información:

   i. Nombre de la cuenta

   ii. No. Cuenta

   iii. Identificación (DPI)

   iv. Monto Inicial

   b. **Depósito monetario (5 pts):** Deberá presentar un formulario para realizar un depósito monetario a una cuenta. El formulario deberá solicitar número de cuenta y cantidad a depositar.

   c. **Retiro monetario (5 pts):** Deberá presentar un formulario para realizar un débito monetario de una cuenta. El formulario deberá solicitar número de cuenta y cantidad a debitar.

4. **Panel de usuario:** Para poder ingresar al panel de usuario, el usuario deberá iniciar sesión en el sistema. Una vez iniciada la sesión podrá realizar las siguientes funciones:

   a. **Agregar cuentas de terceros (10 pts):** Una cuenta de tercero es otra cuenta bancaria, ajena al usuario conectado, a la cual el usuario conectado desea transferir dinero. El formulario de adición de cuentas de terceros deberá solicitar:

   i. No. Cuenta: se debe de validar que la cuenta bancaria exista.

   ii. Monto Máximo: Monto máximo que se puede transferir a esta cuenta en una operación de transferencia.

   iii. Cantidad máxima de transacciones diarias: Cantidad máxima de transferencias diarias que se pueden realizar a la cuenta.

   iv. Alias: Alias de la cuenta.

   **Nota:** Una cuenta de tercero solo existe para el usuario que la crea, y no debe estar disponible para otros usuarios en el sistema.

   b. **Transferencia a cuenta de tercero (10 pts):** Presentará un formulario que le permitirá al usuario conectado poder hacer una transferencia monetaria a cualquiera de las cuentas de tercero que tenga registradas.

   i. El formulario deberá desplegar el listado de cuentas de tercero disponibles para el usuario conectado. Se deberá seleccionar la cuenta a la que se desea transferir dinero y la cantidad monetaria a transferir.

   ii. El sistema deberá validar:

         1. Que el monto de transferencia ingresado no supere el monto máximo permitido a transferir para la cuenta seleccionada.

         2. Que la cantidad de transacciones no sobrepase el máximo establecido por día para la cuenta seleccionada.

   **Nota:** La operación de transferencia, una vez se hayan realizado todas las validaciones, deberá de realizarse bajo un contexto de transacción.

   c. **Estado de cuenta (10 pts):** Reporte con todas las operaciones realizadas en la cuenta del usuario conectado, es decir, todos los débitos y créditos (depósitos, retiros y transferencias).

---

**Administración, Mantenimiento y Soporte de Servidor Web (Apache) (10 pts):** Se debe de instalar una herramienta para el análisis del log del Apache y revisar cuántas solicitudes son OK, cuáles son las páginas más visitadas, cuáles páginas dan error, etc. Adjuntar a la documentación del proyecto que se debe de subir a la UMG y ver la posibilidad de verlo en línea.

**Como documentación oficial del proyecto (10 pts):** Se debe incluir el diagrama de arquitectura de la solución, el diagrama ER y los diagramas de casos de uso.