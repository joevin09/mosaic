<{block name="page-title"}>Résultats<{/block}>

<{block name="content"}>
    <{if $this->user->user_id > 0}>
        <{if count($list) > 0}>
            <div class="pres pres-register membres">
                <h2 class="agency_h2">Résultats</h2>
                <h3 class="h3-bread">Ta recherche est terminée.</h3>
              <ol class="breadcrumb bread-fixe">
                    <{$flag = 0}>
                  
                    <{assign var=uri value="/"|explode:$this->session->current->userdata['search_query']}>
                    <{foreach from=$uri item=v}>
                        <{if ($flag == 1 || $flag == 3 || $flag == 5)}>
                            <li>
                                <{$v}>
                            </li>
                        <{/if}>
                        <{$flag = $flag + 1}>
                    <{/foreach}>
                </ol>
                                <p>Ce résultat ne te satisfait toujours pas, effectue à nouveau une <a class="no-lien" href="<{site_url('search')}>">recherche</a>.</p>

                <a class="ecra-left padding-bottom" href="<{site_url('mosaic')}>">Ta mosaic</a>
                <div class="back move-retour" onclick="history.back();"><i class="fa fa-long-arrow-left"></i> Étape précédente</div>
            </div>
            <div class="motif motif-register hidden-xs hidden-sm hidden-md">
                <span class="l1"></span>
                <span class="l2"></span>
                <span class="l3"></span>
                <span class="l4"></span>
            </div>
            <div class="img_post membres-img hidden-xs hidden-sm">
                <img src="<{assets('img/img_search.jpg')}>" alt="Image d'un recherche">
                <h4 class="my_h4 move_h">Postulants correspondants.</h4>
            </div>
            <div class="last_register_home all-members">
                <ul class="list">
                    <{$i = 0}>
                    <{foreach from=$list item=v}>
                        <li class="item-<{$i}>">
                            <a href="<{site_url(array('members/view', $v->user_id))}>">
                                <img src="<{avatar_url($v->avatar, '150x150')}>" style="width:100%;" alt="Photo de <{username($v)}>" />
                                <p><{username($v)}></p>
                            </a>
                        </li>
                        <{$i = $i + 1}>
                    <{/foreach}>
                </ul>
            </div>
        <{else}>
            <div class="pres pres-register membres">
                <h2 class="agency_h2">Désolé</h2>
                <h3 class="h3-bread">Aucun profil trouvé !</h3>
              
              <ol class="breadcrumb bread-fixe">
                    <{$flag = 0}>
                  
                    <{assign var=uri value="/"|explode:$this->session->current->userdata['search_query']}>
                    <{foreach from=$uri item=v}>
                        <{if ($flag == 1 || $flag == 3 || $flag == 5)}>
                            <li>
                                <{$v}>
                            </li>
                        <{/if}>
                        <{$flag = $flag + 1}>
                    <{/foreach}>
                </ol>
                  <p>Cherches parmi les profils ou inscris-toi pour recevoir les offres te correspondants.
                </p>
                <a class="ecra-left" href="<{site_url('mosaic')}>">Ta mosaic</a>
                <div class="back move-retour" onclick="history.back();"><i class="fa fa-long-arrow-left"></i> Retour à la recherche</div>
            </div>
            <div class="motif motif-register hidden-xs hidden-sm hidden-md">
                <span class="l1"></span>
                <span class="l2"></span>
                <span class="l3"></span>
                <span class="l4"></span>
            </div>
            <div class="img_post membres-img hidden-xs hidden-sm">
                <img src="<{assets('img/img_search.jpg')}>" alt="Image d'un recherche">
                <h4 class="my_h4 move_h for-all move-all-h-mosaic">Tous les postulants.</h4>
            </div>
            <div class="last_register_home all-members">
                <ul class="list">
                    <{$i = 0}>
                    <{foreach from=$members item=v}>
                        <{if $v->agency_name == NULL}>
                            <li class="item-<{$i}>">
                                <a href="<{site_url(array('members/view', $v->user_id))}>">
                                    <img src="<{avatar_url($v->avatar, '150x150')}>" style="width:100%;" alt="Photo de <{username($v)}>" />
                                    <p><{username($v)}></p>
                                </a>
                            </li>
                            <{$i = $i + 1}>
                        <{/if}>
                    <{/foreach}>
                </ul>
            </div>
        <{/if}>
    <{else}>
        <{if count($list) > 0}>
            <div class="pres pres-register membres">
                <h2 class="agency_h2">Résultats</h2>
                <h3 class="h3-bread">Ta recherche est terminée.</h3>
                 <ol class="breadcrumb bread-fixe">
                    <{$flag = 0}>
                  
                    <{assign var=uri value="/"|explode:$this->session->current->userdata['search_query']}>
                    <{foreach from=$uri item=v}>
                        <{if ($flag == 1 || $flag == 3 || $flag == 5)}>
                            <li>
                                <{$v}>
                            </li>
                        <{/if}>
                        <{$flag = $flag + 1}>
                    <{/foreach}>
                </ol>
                                <p>Inscris-toi pour créer ta mosaic. Consulte les nouveaux profils qui te correspondent.</p>

                <a class="ecra-left" href="http://m-saic.be/register/?register_mode=agency">Inscription</a>
                <div class="back move-retour" onclick="history.back();"><i class="fa fa-long-arrow-left"></i> Étape précédente</div>
            </div>
            <div class="motif motif-register hidden-xs hidden-sm hidden-md">
                <span class="l1"></span>
                <span class="l2"></span>
                <span class="l3"></span>
                <span class="l4"></span>
            </div>
            <div class="img_post membres-img hidden-xs hidden-sm">
                <img src="<{assets('img/img_search.jpg')}>" alt="Image d'un recherche">
                <h4 class="my_h4 move_h">Postulants correspondants.</h4>
            </div>
            <div class="last_register_home all-members">
                <ul class="list">
                    <{$i = 0}>
                    <{foreach from=$list item=v}>          
                        <li class="item-<{$i}>">
                            <a href="<{site_url(array('members/view', $v->user_id))}>">
                                <img src="<{avatar_url($v->avatar, '150x150')}>" style="width:100%;" alt="Photo de <{username($v)}>" />
                                <p><{username($v)}></p>
                            </a>
                        </li>
                        <{$i = $i + 1}>
                    <{/foreach}>
                </ul>
            </div>

        <{else}>
            <div class="pres pres-register membres">
                <h2 class="agency_h2">Désolé</h2>
                <h3 class='h3-bread'>Aucun profil trouvé !</h3>
               
                <ol class="breadcrumb bread-fixe">
                    <{$flag = 0}>
                  
                    <{assign var=uri value="/"|explode:$this->session->current->userdata['search_query']}>
                    <{foreach from=$uri item=v}>
                        <{if ($flag == 1 || $flag == 3 || $flag == 5)}>
                            <li>
                                <{$v}>
                            </li>
                        <{/if}>
                        <{$flag = $flag + 1}>
                    <{/foreach}>
                </ol>
                <p>Cherches parmi les profils ou inscris-toi pour recevoir les offres te correspondants.
                </p>
                <a class="ecra-left" href="http://m-saic.be/register/?register_mode=agency">Inscription</a>
                <div class="back move-retour" onclick="history.back();"><i class="fa fa-long-arrow-left"></i> Retour à la recherche</div>
            </div>
            <div class="motif motif-register hidden-xs hidden-sm hidden-md">
                <span class="l1"></span>
                <span class="l2"></span>
                <span class="l3"></span>
                <span class="l4"></span>
            </div>
            <div class="img_post membres-img hidden-xs hidden-sm">
                <img src="<{assets('img/img_search.jpg')}>" alt="Image d'un recherche">
                <h4 class="my_h4 move_h for-all move-all-h-mosaic">Tous les postulants.</h4>
            </div>
            <div class="last_register_home all-members">

                <ul class="list">
                    <{$i = 0}>
                    <{foreach from=$members item=v}>
                        <{if $v->agency_name == NULL}>
                            <li class="item-<{$i}>">
                                <a href="<{site_url(array('members/view', $v->user_id))}>">
                                    <img src="<{avatar_url($v->avatar, '150x150')}>" style="width:100%;" alt="Photo de <{username($v)}>" />
                                    <p><{username($v)}></p>
                                </a>
                            </li>
                            <{$i = $i + 1}>
                        <{/if}>
                    <{/foreach}>
                </ul>
            </div>
        <{/if}>
    <{/if}>
<{/block}>