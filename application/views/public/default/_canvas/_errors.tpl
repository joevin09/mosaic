<{block name="page-title"}>404<{/block}>
<{block name="content"}>
    <div class="pres pres-register error">
        <h2 class="agency_h2">Erreur</h2>
        <h3><span>404</span> | La page <br />n'a pas été trouvée !</h3>
        <p>Aucun profil par ici, tu as dû te perdre<br /> dans tes recherches.</p>
        <a href="<{site_url()}>">Retour à la mosaic</a>
    </div>
    <div class="motif motif-register hidden-xs hidden-sm hidden-md">
        <span class="l1"></span>
        <span class="l2"></span>
        <span class="l3"></span>
        <span class="l4"></span>
    </div>
    <div class="img_post error-img">
        <img class="img_post hidden-xs hidden-sm" src="<{assets('img/img_error.jpg')}>" alt="image d'une recherche">
    </div>
<{/block}>