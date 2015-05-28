<{block name="page-title"}>Expériences<{/block}>

<{block name="content"}>
    <{if count($list) > 0}>
        <div class="pres pres-register membres">
            <h2>Expériences</h2>
            <h3>Quel est l'expérience à avoir pour postuler ?</h3>
            <p>Confie nous l'expérience minimum à avoir<br/> pour convenir à tes recherches:</p>
            <div class="select-profil">
                <select class="select-go-to">
                    <option value="">Expériences:</option>
                    <{foreach from=$experiences_list item=v}>
                        <option value="<{site_url(array($this->router->fetch_class(), 'search/function', $search_function, 'experience', $v->experience_slug))}>"><{$v->experience_name}></option>
                    <{/foreach}>
                </select>
            </div>
        </div>
        <div class="motif hidden-xs hidden-sm hidden-md">
            <span class="l1"></span>
            <span class="l2"></span>
            <span class="l3"></span>
            <span class="l4"></span>
        </div> 
        <div class="img_post membres-img hidden-xs hidden-sm">
            <img src="<{assets('img/img_search.jpg')}>" alt="Image d'un contact">
            <h4 class="move-h">Postulants correspondants.</h4>
        </div>
        <h4 class="visible-xs visible-sm">Postulants correspondants.</h4>
        <div class="last_register_home all-members">
            <ul>
                <{foreach from=$list item=v}>
                    <li>
                        <a href="<{site_url(array($this->router->fetch_class(), 'view', $v->user_id))}>">
                            <p><{username($v)}></p>
                        </a>
                    </li>
                <{/foreach}>
            </ul>
        </div>
    <{else}>
        <div class="pres pres-register membres">
            <h2>Désolé</h2>
            <h3>Aucune recherche ne correspond aux critères !</h3>
            <p>Cherches parmi les agences ou inscris-toi pour recevoir les offres te correspondants.
            </p>
            <a class="return" href="<{site_url('register')}>">Inscription</a>
        </div>
        <div class="motif motif-register hidden-xs hidden-sm hidden-md"></div>
        <div class="img_post membres-img hidden-xs hidden-sm">
            <img src="<{assets('img/img_search.jpg')}>" alt="Image d'un contact">
            <h4 class="move-h">Toutes les postulants.</h4>
        </div>
        <h4 class="visible-xs visible-sm">Toutes les postulants.</h4>
        <div class="last_register_home all-members">
            <ul class="list">
                <{$i = 0}>
                <{foreach from=$members item=v}>
                    <li class="item-<{$i}>">
                        <a href="<{site_url(array($this->router->fetch_class(), 'view', $v->user_id))}>">
                            <p><{username($v)}></p>
                        </a>
                    </li>
                    <{$i = $i + 1}>
                <{/foreach}>
            </ul>
        </div>
    <{/if}>
<{/block}>