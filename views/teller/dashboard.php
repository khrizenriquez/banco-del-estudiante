<?php
$page_title = "Gestionar usuarios :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

<section class="container mt-6">
    <!-- <table class="table">
        <thead>
        <tr>
            <th>NIT</th>
            <th>Nombre Completo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Activo</th>
        </tr>
        </thead>
        <?php
    /*        include 'conexion.php';

            $sql = "SELECT NIT, Nombre, Telefono, Direccion, Activo FROM Proveedores";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<tbody>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["NIT"] . "</td>";
                    echo "<td>" . $row["Nombre"] . "</td>";
                    echo "<td>" . $row["Telefono"] . "</td>";
                    echo "<td>" . $row["Direccion"] . "</td>";
                    echo "<td class='status'>" . ($row["Activo"] ? "<span class='status-active'>Activo</span>" : "<span class='status-inactive'>Inactivo</span>") . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "No hay proveedores disponibles.";
            }

            $conn->close();
            */?>
    </table>
-->
    <div class="table-container">
        <table class="table is-striped is-hoverable is-fullwidth">
            <thead>
            <tr>
                <th>ID de Usuario</th>
                <th>Nombre Completo</th>
                <th>Número de Cuenta</th>
                <th>Saldo</th>
                <th>Estado de la Cuenta</th>
                <th>Fecha de Creación</th>
                <th>Creado por</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Jane Smith</td>
                <td>1234567890</td>
                <td>$1,200.00</td>
                <td>Activa</td>
                <td>2023-08-15</td>
                <td>Cajero Creador</td>
                <td>
                    <a href="<?= BASE_PATH; ?>/teller/usuarios/<?= '111'; ?>" class="button is-small is-warning">Editar</a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Michael Johnson</td>
                <td>0987654321</td>
                <td>$3,500.00</td>
                <td>Bloqueada</td>
                <td>2023-07-05</td>
                <td>Cajero Creador</td>
                <td>
                    <a href="<?= BASE_PATH; ?>/teller/usuarios/<?= '122'; ?>" class="button is-small is-warning">Editar</a>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>Emily Davis</td>
                <td>1122334455</td>
                <td>$500.00</td>
                <td>Activa</td>
                <td>2023-09-01</td>
                <td>Cajero Creador</td>
                <td>
                    <a href="<?= BASE_PATH; ?>/teller/usuarios/<?= '123'; ?>" class="button is-small is-warning">Editar</a>
                </td>
            </tr>
            </tbody>
        </table>

    </div>

</section>


<?php
require_once './views/common/logged-scripts.php';
?>
</body>
</html>
