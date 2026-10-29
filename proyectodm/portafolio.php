<?php
include("conexion.php"); // Asegúrate de que tu conexion.php está correcto

// Trae todos los portafolios ordenados por fecha (de más reciente a más antiguo)
$query = "SELECT * FROM portafolios ORDER BY fecha_subida DESC";
$result = $conex->query($query);

// Mostrar error si falla la consulta
if (!$result) {
    die("Error en la consulta: " . $conex->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Portafolio - DM Producciones</title>
  <link rel="icon" type="image/png" href="./Icons/logo.png-removebg-preview.png">
  <link rel="stylesheet" href="./Styles/portafolio.css">
</head>
<body>

  <!-- HEADER -->
  <header>
    <nav class="navbar">
      <div class="navbar__logo">
        <a href="./index.php"><img src="./Icons/logo.png-removebg-preview.png" alt="logo" /></a>
      </div>
      <ul>
        <li><a href="./index.php">Inicio</a></li>
      </ul>
      <div class="navbar__toggle">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
    </nav>
  </header>

  <!-- GALERÍA -->
  <main class="portafolio-page">
    <h2>Nuestros Proyectos Recientes</h2>

    <?php if ($result->num_rows > 0): ?>
      <div class="galeria">
        <?php while ($fila = $result->fetch_assoc()): ?>
          <?php
          for ($i = 1; $i <= 10; $i++):
            $columna = "imagen$i";
            if (!empty($fila[$columna])):
          ?>
            <img src="<?= htmlspecialchars($fila[$columna]) ?>"
                 alt="Imagen del proyecto <?= htmlspecialchars($fila['titulo']) ?>"
                 class="galeria-img">
          <?php
            endif;
          endfor;
          ?>
        <?php endwhile; ?>
      </div>

      <!-- LIGHTBOX -->
      <div id="lightbox" class="lightbox">
        <span class="close">&times;</span>
        <img id="lightbox-img" src="">
        <span class="prev">&#10094;</span>
        <span class="next">&#10095;</span>
      </div>
    <?php else: ?>
      <p>No hay imágenes en el portafolio todavía.</p>
    <?php endif; ?>
  </main>

  <!-- FOOTER -->
  <footer>
    <div class="footer-container">
      <div class="footer-section">
        <h4>Contacto</h4>
        <p>+54 9 11 2884-2866</p>
        <a href="mailto:dennnismejianelson12@gmail.com">Correo de contacto</a>
      </div>

      <div class="footer-section">
        <h4>Seguinos</h4>
        <div class="social-icons">
          <a href="https://www.facebook.com/profile.php?id=61578084665078" target="_blank"><img src="./Icons/Cfacebook.png" alt="Facebook"></a>
          <a href="https://wa.me/5491128842866" target="_blank"><img src="./Icons/Cwhatsapp (1).png" alt="WhatsApp"></a>
          <a href="https://www.tiktok.com/@dm.producciones2025" target="_blank"><img src="./Icons/Ctik-tok.png" alt="TikTok"></a>
          <a href="https://www.instagram.com/mejiadennis.18/" target="_blank"><img src="./Icons/Cinstagram.png" alt="Instagram"></a>
        </div>
      </div>

      <div class="footer-section">
        <h4>Dirección</h4>
        <p>MERLO, Argentina</p>
      </div>
    </div>

    <div class="footer-bottom">
      2025 Página web para DM Producciones - Todos los derechos reservados
    </div>
  </footer>

  <!-- JS LIGHTBOX -->
  <script>
    // Lightbox funcional
    const images = document.querySelectorAll(".galeria-img");
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    const close = document.querySelector(".lightbox .close");
    const prev = document.querySelector(".lightbox .prev");
    const next = document.querySelector(".lightbox .next");
    let currentIndex = 0;

    images.forEach((img, index) => {
      img.addEventListener("click", () => {
        lightbox.style.display = "flex";
        lightboxImg.src = img.src;
        currentIndex = index;
      });
    });

    close.addEventListener("click", () => lightbox.style.display = "none");

    prev.addEventListener("click", () => {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      lightboxImg.src = images[currentIndex].src;
    });

    next.addEventListener("click", () => {
      currentIndex = (currentIndex + 1) % images.length;
      lightboxImg.src = images[currentIndex].src;
    });

    lightbox.addEventListener("click", (e) => {
      if (e.target === lightbox) lightbox.style.display = "none";
    });

    document.addEventListener("keydown", (e) => {
      if (lightbox.style.display === "flex") {
        if (e.key === "ArrowRight") next.click();
        if (e.key === "ArrowLeft") prev.click();
        if (e.key === "Escape") close.click();
      }
    });

    // Navbar toggle móvil
    const toggle = document.querySelector('.navbar__toggle');
    const nav = document.querySelector('.navbar ul');
    toggle.addEventListener('click', () => {
      nav.classList.toggle('active');
      toggle.classList.toggle('active');
    });
  </script>
</body>
</html>