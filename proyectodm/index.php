<?php
session_start(); // Inicia la sesión

include('conexion.php'); // tu conexión a la base de datos

// Si la sesión no está definida, no hace falta asignarle null
if (!isset($_SESSION["usuario"])) {
    // Podrías redirigir o simplemente continuar sin sesión
    // header("Location: secion.html");
}

// Consulta correcta con el nombre real de la columna
$result = $conex->query("SELECT * FROM portafolios ORDER BY fecha_subida DESC");

// Mostrar error si la consulta falla
if (!$result) {
    die("Error en la consulta: " . $conex->error);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./Styles/styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <!--letra nosotros-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poiret+One&display=swap"
    rel="stylesheet">
  <link rel="icon" href="./Icons/logo.png-removebg-preview.png">
  <!--letra parrafos-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poiret+One&display=swap"
    rel="stylesheet">
  <!-- letra de titulos -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poiret+One&family=Special+Gothic+Condensed+One&display=swap"
    rel="stylesheet">
    <!--Letra Subtitulos-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poiret+One&family=Special+Gothic+Condensed+One&family=Teko:wght@300..700&display=swap" rel="stylesheet">

  <title>DM Producciones</title>
</head>

<body>
  <!-- HEADER -->
  <header class="header" id="inicio">
    <nav class="navbar">
      <div class="navbar__logo">
        <a href="./index.php"><img src="./Icons/logo.png-removebg-preview.png" alt="logo" /></a>
      </div>
      <div class="navbar__toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
      <ul class="navbar__menu">
        <li class="navbar__item"><a href="index.php">Inicio</a></li>
        <li class="navbar__item"><a href="#Nosotros">Nosotros</a></li>
        <li class="navbar__item"><a href="#portafolio">Portafolios</a></li>
        <li class="navbar__item"><a href="#Servicios">Servicios</a></li>
        <li class="navbar__item"><a href="#contac">Contacto</a></li>
        <div class="candado">
          <?php if (isset($_SESSION["usuario"]) && $_SESSION["usuario"] != ""): ?>
          <!-- Usuario logueado: mostramos icono de WhatsApp (subir portafolio) -->
          <a href="./subirporta.php">
            <img src="./Icons/image.png" alt="Subir Portafolio">
          </a>
          <a href="./salir.php">Cerrar Sesión</a>
          <?php else: ?>
          <!-- Usuario no logueado: mostramos candado -->
          <a href="./secion.html">
            <img src="./Icons/candadol-removebg-preview.png" alt="Login">
          </a>
          <?php endif; ?>
        </div>
_      </ul>
    </nav>

    <div class="caja-video">
      <video autoplay muted loop playsinline poster="">
        <source src="./Video/FONDOFULL.mp4" type="video/mp4" />
      </video>
    </div>

    <div class="caja-info">
      <h1>Fotografía y Vídeo Profesional</h1>
      <div class="logo-icons">
        <a href="https://www.facebook.com/profile.php?id=61578084665078" aria-label="Facebook" target="_blank"><img
            src="./Icons/facebook.png" alt="Facebook"></a>
        <a href="https://www.instagram.com/dm.producciones2025/" aria-label="Instagram" target="_blank"><img
            src="./Icons/instagram.png" alt="Instagram"></a>
        <a href="#" aria-label="WhatsApp"><img src="./Icons/whatsapp.png" alt="WhatsApp" target="_blank"></a>
        <a href="https://www.tiktok.com/@dm.producciones2025" aria-label="TikTok" target="_blank"><img
            src="Icons/tik-tok.png" alt="TikTok"></a>
      </div>
    </div>

  </header>

  <!-- MAIN -->
  <main class="main">
    <div id="Nosotros">
      <div class="parrafo_de_nosotros">
        <div class="titulo">
          <h2>HOLA, SOMOS <span>DM PRODUCCIONES</span></h2>
        </div>
        <p class="parrafo_nosotros">
          En <strong>DM Producciones</strong> nos dedicamos a capturar momentos que trascienden el tiempo. Nos
          especializamos en sesiones fotográficas para <strong>eventos, cumpleaños y bautismos</strong>, creando
          recuerdos únicos con un estilo natural, profesional y lleno de emoción.
          <br><br>
          Cada imagen cuenta una historia, y nuestro compromiso es que la tuya se sienta viva cada vez que la veas.
          Porque detrás de cada foto hay risas, abrazos y miradas que merecen ser eternas.
          <br><br>
          Soy <strong>Dennis Mejías</strong>, fundador de <strong>DM Producciones</strong>. Tengo 21 años y me formé en
          la <strong>Escuela Técnica N°5</strong> con orientación en <strong>Informática</strong>. Aunque mi carrera
          académica no estuvo directamente relacionada con la fotografía, descubrí este mundo por curiosidad y pasión:
          comencé como un hobby, explorando la <strong>edición de fotos y videos</strong>, y terminé encontrando en ello
          mi verdadera vocación.
          <br><br>
          Hoy realizo producciones audiovisuales completas, combinando <strong>creatividad, técnica y emoción</strong>
          en cada proyecto. Trabajo con una <strong>Sony A6700</strong> y lente <strong>Sigma 18–50 mm f/2.8</strong>,
          además de un <strong>drone</strong> DJI Mini 5 Pro, estabilizador y dispositivos móviles de última generación
          como el <strong>iPhone 16 Pro Max</strong> y el <strong>Samsung S25 Ultra</strong>. Estas herramientas me
          permiten lograr resultados profesionales y adaptarme a cualquier entorno.
          <br><br>
          Mi objetivo es seguir perfeccionando mi estilo, innovar en cada proyecto y crear imágenes que transmitan
          sensaciones reales.
          <br><br>
          <strong class="eslogan">DM Producciones — Hacemos eternos tus mejores momentos. </strong>
        </p>
      </div>
      <div>
        <hr class="Linea">
      </div>
    </div>
    <!-- EVENTOS -->
    <div class="titulo_servicios" id="Servicios">
      <h2> Servicios</h2>
    </div>
    <section class="section_eventos">
      <div class="img_principal_de_los_servicios">
        <img src="./Image/Principales/P1.jpg" alt="foto de eventos">
      </div>
      <div class="texto_de_los_servicios_titulos">
        <h2>CAPTURAMOS LA FUERZA DEL <span>FOLCLORE</span> EN CADA FOTOGRAFÍA </span></h2>
        <div class="texto_de_los_servicios">
          <p>
            Cada evento es una historia única que merece ser contada con imágenes que transmitan su verdadera emoción.
            En [nombre de tu productora], nos especializamos en fotografía y video profesional para eventos sociales,
            culturales y recorridos folclóricos bolivianos, acompañando a fraternidades, grupos de baile y danzas
            típicas en cada presentación, entrada o ensayo.

            Entendemos que detrás de cada traje, cada paso y cada sonrisa, hay tradición, esfuerzo y orgullo cultural.
            Por eso, nuestro compromiso es capturar no solo el momento, sino también la energía, la devoción y el
            espíritu de tu fraternidad. Desde las grandes entradas folclóricas, aniversarios y festivales, hasta
            sesiones personalizadas o recorridos, cuidamos cada detalle para que tus recuerdos se conserven con la
            calidad y la emoción que merecen.

            Ofrecemos cobertura completa en foto y video con equipos profesionales, tomas aéreas, retratos grupales e
            individuales, clips promocionales, reels para redes sociales y mucho más. Cada proyecto se realiza con una
            mirada artística y respetuosa hacia nuestras raíces culturales, destacando los colores, la música y la
            pasión que hacen vibrar cada baile.

            Sea cual sea tu evento —una entrada folclórica, un aniversario de fraternidad o una presentación especial—
            estamos para acompañarte y transformar cada momento en un recuerdo inolvidable.

          </p>
          <hr>
          <p class="texto_bajo">
            📸 Fotografía profesional | 🎥 Video artístico | 🎉 Eventos y danzas bolivianas | 💃 Fraternidades y cultura
            viva
          </p>
        </div>
      </div>
    </section>

    <!-- Galería Eventos -->
    <section class="section_de_galeria_de_los_servicios">
      <img src="./Image/f1.jpg" alt="galeria de eventos">
      <img src="./Image/f2.jpg" alt="galeria de eventos">
      <img src="./Image/f3.jpg" alt="galeria de eventos">
      <img src="./Image/f4.jpg" alt="galeria de eventos">
    </section>

    <!-- BAUTISMOS -->
    <section class="header_bautismos">
      <div class="img_principal_de_los_servicios">
        <img src="./Image/Principales/P2.jpg" alt="">
      </div>
      <div class="texto_de_los_servicios_titulos">
        <h2>OFRECEMOS SESIONES DE FOTOGRAFÍA PARA <span>BAUTISMOS</span></h2>
        <div class="texto_de_los_servicios">
          <p>
            El bautismo es un momento sagrado y lleno de significado, donde la fe, el amor y la familia se unen para dar
            la bienvenida a una nueva vida espiritual. En [nombre de tu productora], comprendemos la importancia de este
            día tan especial y te ofrecemos sesiones fotográficas profesionales que capturan cada instante con
            sensibilidad, ternura y dedicación.

            Desde los preparativos previos y la ceremonia, hasta los abrazos, las sonrisas y los detalles que hacen
            única la celebración, registramos cada momento con un estilo cálido, natural y lleno de emoción. Nuestro
            objetivo es que cada imagen refleje la inocencia del niño, la alegría de los padres y la unión familiar que
            acompaña este acontecimiento tan especial.

            Ofrecemos cobertura completa del bautismo, sesiones previas o posteriores, retratos familiares, fotografía
            artística del entorno, y opciones personalizadas para que conserves este recuerdo con la mejor calidad.

            Porque cada bautismo es una historia de amor, fe y esperanza —y merece ser recordada por siempre en imágenes
            que hablen por sí solas.
          </P>

          <hr>
          <p class="texto_bajo">
            📸 Fotografía profesional de bautismos | Retratos familiares | Momentos llenos de fe y ternura
          </p>
        </div>
      </div>
    </section>

    <!-- Galería Bautismos -->
    <section class="section_de_galeria_de_los_servicios">
      <img src="./Image/b1.jpg" alt="fotos de bautismos">
      <img src="./Image/b2.jpg" alt="fotos de bautismos">
      <img src="./Image/b3.jpg" alt="fotos de bautismos">
      <img src="./Image/b4.jpg" alt="fotos de bautismos">
    </section>

    <!-- CUMPLEAÑOS -->
    <section class="section_eventos">
      <div class="img_principal_de_los_servicios">
        <img src="./Image/Principales/wilson-127.jpg" alt="">
      </div>
      <div class="texto_de_los_servicios_titulos">
        <h2>OFRECEMOS SESIONES DE FOTOGRAFÍA PARA <span>CUMPLEAÑOS</span></h2>
        <div class="texto_de_los_servicios">
          <p>
            Cada cumpleaños es mucho más que un simple festejo: es una colección de momentos únicos, risas compartidas,
            miradas cómplices y emociones que merecen ser recordadas para siempre. En cada instante se esconde una
            historia que refleja la alegría de quienes lo celebran, los detalles que hacen especial el día y la magia de
            reunir a amigos y familiares.
            Nosotros te ofrecemos sesiones fotográficas diseñadas especialmente para capturar cada uno de esos momentos,
            desde las sonrisas espontáneas hasta los gestos más emotivos, creando recuerdos que podrás revivir una y
            otra vez. Cada fotografía es una ventana a la emoción del instante, pensada para que tu celebración no solo
            se viva, sino que también quede inmortalizada para siempr
          </p>
          <hr>
          <p class="texto_bajo">
            📸 Fotografía profesional de cumpleaños | Retratos espontáneos | Momentos llenos de alegría y diversión
          </p>
        </div>
      </div>
    </section>

    <!-- Galería Cumpleaños -->
    <section class="section_de_galeria_de_los_servicios">
      <img src="./Image/c1.jpg" alt="galeria de cumpleaños">
      <img src="./Image/c2.jpg" alt="galeria de cumpleaños">
      <img src="./Image/c3.jpg" alt="galeria de cumpleaños">
      <img src="./Image/c4.jpg" alt="galeria de cumpleaños">
    </section>

    <hr class="Linea">
    <!-- PORTAFOLIOS -->
    <div class="titulo_servicios" id="portafolio">
      <h2>Portafolios</h2>
    </div>
    <div class="portafolios">
      <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($fila = $result->fetch_assoc()): ?>
      <a href="portafolio.php?id=<?= urlencode($fila['id']) ?>" class="card-link" target="_blank">
        <div class="card">
          <h2>
            <?= htmlspecialchars($fila['titulo']) ?>
          </h2>

          <?php if (!empty($fila['descripcion'])): ?>
          <p>
            <?= nl2br(htmlspecialchars($fila['descripcion'])) ?>
          </p>
          <?php endif; ?>

          <?php
        // Mostrar solo la primera imagen como portada
        for ($i = 1; $i <= 10; $i++):
            $columna = "imagen$i";
            if (!empty($fila[$columna])):
        ?>
          <img src="<?= htmlspecialchars($fila[$columna]) ?>" alt="Imagen del proyecto" class="card-img">
          <?php
                break; // mostramos solo la primera imagen
            endif;
        endfor;
        ?>
        </div>
      </a>
      <?php endwhile; ?>
      <?php else: ?>
      <p>No hay proyectos cargados en el portafolio todavía.</p>
      <?php endif; ?>
    </div>


  </main>

  <!-- FOOTER -->
  <footer>
    <div class="footer-container">
      <div class="footer-section">
        <h4 id="contac">Contacto</h4>
        <p><i class="fab fa-whatsapp"></i> +54 9 11 2884-2866</p>
        <a href="mailto:">Correo de contacto: dennnismejianelson12@gmail.com</a>
      </div>

      <div class="footer-section">
        <h4>Seguinos</h4>
        <div class="social-icons">
          <a href="https://www.facebook.com/profile.php?id=61578084665078" target="_blank"><img
              src="./Icons/Cfacebook.png" alt="Facebook"></a>
          <a href="https://wa.me/5491128842866" target="_blank"><img src="./Icons/Cwhatsapp (1).png" alt="WhatsApp"></a>
          <a href="https://www.tiktok.com/@dm.producciones2025" target="_blank"><img src="./Icons/Ctik-tok.png"
              alt="TikTok"></a>
          <a href="https://www.instagram.com/mejiadennis.18/" target="_blank"><img src="./Icons/Cinstagram.png"
              alt="Instagram"></a>
        </div>
      </div>

      <div class="footer-section">
        <h4>Dirección</h4>
        <p>Dirección del lugar</p>
        <p>MERLO, Argentina</p>
      </div>
    </div>

    <div class="footer-bottom">
      2025 Página web para DM Producciones - Todos los derechos reservados
    </div>
  </footer>
  <div id="lightbox" class="lightbox">
    <span class="close">&times;</span>
    <div class="lightbox-content">
      <a class="prev">&#10094;</a>
      <img class="lightbox-img" id="lightbox-img">
      <a class="next">&#10095;</a>
    </div>
  </div>
  <script>
    const menuToggle = document.getElementById('mobile-menu');
    const menu = document.querySelector('.navbar__menu');

    menuToggle.addEventListener('click', () => {
      menu.classList.toggle('active');
    });
  </script>
  <script>
    // Efecto scroll navbar
    window.addEventListener('scroll', function () {
      const navbar = document.querySelector('.navbar');
      if (navbar && window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else if (navbar) {
        navbar.classList.remove('scrolled');
      }
    });

    // Lightbox
    const images = document.querySelectorAll(".section_de_galeria_de_los_servicios img");
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    const close = document.querySelector(".close");
    const prev = document.querySelector(".prev");
    const next = document.querySelector(".next");
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
  </script>
  <a href="https://wa.me/5491128842866" class="whatsapp-float" target="_blank">
    <img src="./Icons/Cwhatsapp (1).png" alt="WhatsApp">
  </a>
</body>

</html>