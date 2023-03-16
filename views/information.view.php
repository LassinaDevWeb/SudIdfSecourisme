<?php ob_start(); ?>


<div class="wrapper row">

    <section class=" mb-5 col-xl-12 col-lg-12 ">
        <script src="https://apps.elfsight.com/p/platform.js" defer></script>
        <div class="elfsight-app-8bf8f877-acbe-44cd-af98-e0757e6bfe5e"></div>
    </section>

    <div class="mt-5  col-xl-12 col-lg-12 ">
        <div class="fb-page" data-href="https://www.facebook.com/Sud-Ile-de-France-Secourisme-FNMNS-94-558623694192007/" data-tabs="timeline" data-width="500" data-height="410" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
            <blockquote cite="https://www.facebook.com/Sud-Ile-de-France-Secourisme-FNMNS-94-558623694192007/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Sud-Ile-de-France-Secourisme-FNMNS-94-558623694192007/">Sud Ile de France Secourisme - FNMNS 94</a></blockquote>
        </div>
    </div>

</div>



<?php
$content = ob_get_clean();
$titre = "Information";
require "template.view.php";
?>