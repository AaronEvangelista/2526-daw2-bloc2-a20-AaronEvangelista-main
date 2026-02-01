<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<footer class="footer-premium">
    <div class="container">
        <div class="row g-4 justify-content-between">

            <div class="col-lg-4 col-md-6 text-center text-md-start">
                <h3 class="footer-brand">NOVA GYM</h3>
                <p class="footer-text mt-3" style="max-width: 350px; margin: 0 auto 0 0;">
                    Tu mejor versión empieza aquí.
                </p>
            </div>

            <div class="col-lg-3 col-md-6 text-center text-md-start">
                <h5 class="footer-heading mb-4">Explorar</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="../index.php" class="footer-link">Inicio</a></li>
                    <li class="mb-2"><a href="../pages/verClases.php" class="footer-link">Clases y Horarios</a></li>

                    <?php if (isset($_SESSION['rol'])): ?>
                        <li class="mb-2"><a href="../pages/perfil.php" class="footer-link">Mi Perfil</a></li>
                    <?php else: ?>
                        <li class="mb-2"><a href="../sessions/registro.php" class="footer-link">Únete al Club</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="col-lg-3 col-md-12 text-center text-md-end">
                <h5 class="footer-heading mb-4">Síguenos</h5>

                <div class="d-flex justify-content-center justify-content-md-end mb-3 gap-2">
                    <a href="#" class="social-icon-btn"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon-btn"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon-btn"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="social-icon-btn"><i class="bi bi-tiktok"></i></a>
                </div>

                <p class="footer-text small">contacto@novagym.com</p>
            </div>
        </div>

        <hr class="footer-divider">

        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <p class="footer-copyright mb-0">
                    &copy; 2026 <strong class="text-info">NOVA GYM</strong>. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>