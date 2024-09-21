<footer id="footer" class="footer dark-background">

  <div class="footer-top">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Island Tours</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Abdoulatuf</p>
            <p>Moroni</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+269 3772424</span></p>
            <p><strong>Email:</strong> <span>abdoulatufm9@gmail.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Liens utiles</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="randonnee.php"> Randonnée</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="plages.php">Plages </a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="patrimoine.php"> Patrimoine</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="montagne.php"> Montagne</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="art_culture.php">Art & culture</a></li>
          </ul>
        </div>


        <div class="copyright">
          <div class="container text-center">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Island Tours</strong> <span>Tous droits réservés</span></p>
            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you've purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
              Conçu par <a href="https://bootstrapmade.com/">abdoulatufm9@gmail.com</a>
            </div>
          </div>
        </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>
<script>
  function filterCircuits(location) {
    const items = document.querySelectorAll('.portfolio-item');

    items.forEach(item => {
      if (location === '' || item.classList.contains('filter-' + location)) {
        item.style.display = 'block';
      } else {
        item.style.display = 'none';
      }
    });
  }
</script>
</body>

</html>