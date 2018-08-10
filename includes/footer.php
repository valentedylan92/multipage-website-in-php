<footer>
    <div class="section__container container">
        <div class="row">
            <div class="col-12 col-md-4">
                <h3>Sitemap</h3>
                <nav class="navbar">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link header__item" href="index.php">Accueil</a>
                        <a class="nav-item nav-link header__item" href="organisation.php">Organisation</a>
                        <a class="nav-item nav-link header__item active" href="articles.php">Articles</a>
                        <a class="nav-item nav-link header__item " href="#">Documents</a>
                        <a class="nav-item nav-link header__item " href="contact.php">Contact</a>
                    </div>
                </nav>
            </div>
            <div class="col-12 col-md-4">
                <h3>Contact</h3>
                <h4>Asbl Lhiving</h4>
                <ul class="listing">
                    <li class="listing__item"><i class="listing__icon fas fa-map-marker-alt"></i>Quai du Batelage 11/122 (12ième étage)<br>1000 Bruxelles</li>
                    <li class="listing__item"><a href="#"><i class="listing__icon fas fa-phone"></i>02 201 14 19</a><br>Jours ouvrables de 9h à 17h, à l’exception des mardis matin.<br>Rendez-vous antenne possibles après un coup de fil.</li>
                    <li class="listing__item"><a href="contact.php"><i class="listing__icon fas fa-at"></i>Nous contacter par mail</a></li>
                    <li class="listing__item"><a href="#"><i class="listing__icon fab fa-facebook-f"></i>Rejoignez-nous sur Facebook</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-4">
                <h3>Comment nous rejoindre ?</h5>
                <p>Métro Yser sur la ligne 2, sortie Héliport. Nous sommes situés dans l’immeuble en face des sapeurs-pompiers, juste derrière le parc Maximillien.</p>
                <div id="map"></div>
            </div>
            <div class="col-12">
                <p id="copyright">© 2018 - Lhiving - Tous droits réservés</p>
            </div>
        </div>
    </div>
</footer>
<script src="vendor/components/jquery/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    function initMap() {
        var mapDiv = document.getElementById('map');
        // var iconMarker = "images/map-marker.png";
        var myLatLng = {
            lat: 50.8590489,
            lng: 4.3485118
        };
        var map = new google.maps.Map(mapDiv, {
            center: myLatLng,
            zoom: 15
        });
        var marker = new google.maps.Marker({
            // icon: iconMarker,
            position: myLatLng,
            map: map,
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIoX3ZWDDEyaBvo-voT-iXOFaJMETn6II&callback=initMap" async defer></script>
<script src="service-worker.js"></script>

</body>

</html>