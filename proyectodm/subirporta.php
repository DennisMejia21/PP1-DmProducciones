<?php
session_start();
include("conexion.php");

// ===============================
// 🔧 CONFIGURACIONES DE PHP
// ===============================
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '120M');
ini_set('max_file_uploads', '30');
ini_set('max_execution_time', '600');
ini_set('memory_limit', '512M');
ini_set('file_uploads', 'On');
ini_set('upload_tmp_dir', 'C:\\xampp\\tmp'); // Carpeta temporal segura

// ===============================
// 🔐 VALIDAR SESIÓN
// ===============================
if (!isset($_SESSION["usuario"])) {
    header("Location: secion.html");
    exit();
}

// ===============================
// 📤 PROCESAR FORMULARIO
// ===============================
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');

    // Carpeta donde se guardan las imágenes
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $imagenes = [];
    $maxFileSize = 100 * 1024 * 1024; // 100MB

    // 📸 Función para optimizar/comprimir imágenes
    function optimizarImagen($rutaOriginal, $rutaDestino, $calidad = 75) {
        $info = @getimagesize($rutaOriginal);
        if (!$info) return false;

        $mime = $info['mime'];
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($rutaOriginal);
                imagejpeg($image, $rutaDestino, $calidad);
                break;
            case 'image/png':
                $image = imagecreatefrompng($rutaOriginal);
                imagepng($image, $rutaDestino, 8);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($rutaOriginal);
                imagewebp($image, $rutaDestino, $calidad);
                break;
            default:
                return false; // tipo no compatible
        }
        imagedestroy($image);
        return true;
    }

    // 🔄 Subir hasta 10 imágenes
    for ($i = 1; $i <= 10; $i++) {
        $field = 'img' . $i;
        $imagenes[$i - 1] = '';

        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            if ($_FILES[$field]['size'] > $maxFileSize) continue;

            $safeBase = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', basename($_FILES[$field]['name']));
            $ext = strtolower(pathinfo($safeBase, PATHINFO_EXTENSION));
            $nombreArchivo = time() . "_{$i}_" . bin2hex(random_bytes(4)) . ".$ext";
            $destinoAbs = $uploadDir . $nombreArchivo;
            $destinoRel = "uploads/" . $nombreArchivo;

            if (move_uploaded_file($_FILES[$field]['tmp_name'], $destinoAbs)) {
                $comprimida = $uploadDir . "min_" . $nombreArchivo;
                if (optimizarImagen($destinoAbs, $comprimida)) {
                    rename($comprimida, $destinoAbs);
                }
                $imagenes[$i - 1] = $destinoRel;
            }
        }
    }

    // 💾 Guardar en base de datos
    $sql = "INSERT INTO portafolios (titulo, descripcion, imagen1, imagen2, imagen3, imagen4, imagen5, imagen6, imagen7, imagen8, imagen9, imagen10)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conex->prepare($sql) or die("Error en prepare(): " . $conex->error);
    $stmt->bind_param(
        "ssssssssssss",
        $titulo, $descripcion,
        $imagenes[0], $imagenes[1], $imagenes[2], $imagenes[3], $imagenes[4],
        $imagenes[5], $imagenes[6], $imagenes[7], $imagenes[8], $imagenes[9]
    );
    $stmt->execute() or die("Error en execute(): " . $stmt->error);
    $stmt->close();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Portafolio</title>
    <link rel="stylesheet" href="./Styles/subir.css">
</head>
<body>
    <div class="container">
        <h1>Subir Portafolio</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="titulo" placeholder="Título del proyecto" required>
            <textarea name="descripcion" placeholder="Descripción" rows="4"></textarea>

            <?php for ($i=1; $i<=10; $i++): ?>
                <label class="file-input">
                    Imagen <?php echo $i; ?>:
                    <input type="file" name="img<?php echo $i; ?>">
                </label>
            <?php endfor; ?>

            <button type="submit">Subir Portafolio</button>
        </form>
    </div>
</body>
</html>
