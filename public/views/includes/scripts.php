<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.js"></script> -->
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/dmc_global/public/js/banner.js?v=<?= microtime() ?>"></script>
<script src="https://unpkg.com/scrollreveal"></script>
<script src="/dmc_global/public/lib/WOW-master/js/wow.js"></script>
<script>
    $(document).ready(function() {
        document.addEventListener('DOMContentLoaded', function() {
            let lazyImages = [].slice.call(document.querySelectorAll('img.lazy'));

            if ('IntersectionObserver' in window) {
                let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            let lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.src;
                            lazyImage.classList.remove('lazy');
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });

                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });
            }
        });

        new WOW().init();
    })
</script>
<!-- <script>
    $(document).ready(function() {
      ScrollReveal().reveal('.logo');
      ScrollReveal().reveal('.grid-container', {
        delay: 500
      });
      ScrollReveal().reveal('.comp', {
        delay: 200
      });
      ScrollReveal().reveal('.news-item ', {
        delay: 200
      });

    })
  </script> -->

<script>
    $(document).ready(function() {
        $('.toogle').click(function() {
            $('nav').slideToggle();
        })
    })
</script>

</html>