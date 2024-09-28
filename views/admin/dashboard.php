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
                <th>Tipo de Usuario</th>
                <th>Estado</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <!-- Cajero Activo -->
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>Cajero</td>
                <td>Activo</td>
                <td>2023-09-20</td>
                <td>
                    <a href="<?= BASE_PATH; ?>/admin/usuarios/<?= '122'; ?>" class="button is-small is-warning">Editar</a>
                    <a href="<?= BASE_PATH; ?>/admin/usuarios/<?= '122'; ?>/bloquear" class="button is-small is-danger">Bloquear</a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Jane Smith</td>
                <td>Usuario Normal</td>
                <td>Activo</td>
                <td>2023-08-15</td>
                <td>
                    <a href="#" class="button is-small is-warning" disabled>Editar</a>
                    <button class="button is-small is-danger" disabled>Bloquear</button>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>Michael Johnson</td>
                <td>Cajero</td>
                <td>Bloqueado</td>
                <td>2023-07-05</td>
                <td>
                    <a href="<?= BASE_PATH; ?>/admin/usuarios/<?= '122'; ?>" class="button is-small is-warning">Editar</a>
                    <a href="<?= BASE_PATH; ?>/admin/usuarios/<?= '122'; ?>" class="button is-small is-link">Desbloquear</a>
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
