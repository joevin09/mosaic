
<{if count($list) > 0}>
    <div class="pres pres-register membres">
        <a class="img-profil" href="<{site_url('profil')}>">
            <i class="fa fa-pencil"></i>
            <img src="<{avatar_url($this->user->avatar, '150x150')}>" style="width:100%;" alt="" />
            <p class="modif-profil-avatar change">Modification de profil</p>
        </a>
        <h2><{$this->user->agency_name}></h2>
        <h3 class="clear">Ta mosaic de postulants</h3>
        <{if $this->user->last_search_uri != ""}>
            <p class="no-padding">Dernière recherche que tu as effectuée:</p>
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
        <{else}>
            <p class="no-padding">Tu n'as encore effectué aucune recherche, recherche l'agence qui te correspond.</p>
        <{/if}>
        <a class="padding-bottom ecra-bread" href="<{site_url('search')}>">Recherche</a>
    </div>
    <div class="motif motif-register hidden-xs hidden-sm hidden-md">
        <span class="l1"></span>
        <span class="l2"></span>
        <span class="l3"></span>
        <span class="l4"></span>
    </div>
    <div class="img_post membres-img hidden-xs hidden-sm">
        <img src="<{assets('img/img_search.jpg')}>" alt="Image d'un contact">
        <h4 class="my_h4 move_h for-all move-h-mosaic">Postulants correspondants.</h4>
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
        <a class="img-profil" href="<{site_url('profil')}>">
            <i class="fa fa-pencil"></i>
            <img src="<{avatar_url($this->user->avatar, '150x150')}>" style="width:100%;" alt="" />
            <p class="modif-profil-avatar change">Modification de profil</p>
        </a>
        <h2><{$this->user->agency_name}></h2>
        <h3 class="clear">Ta mosaic de postulants</h3>
        <{if $this->user->last_search_uri != ""}>
            <p class="no-padding">Dernière recherche que tu as effectuée:</p>
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
        <{else}>
            <p class="no-padding">Tu n'as encore effectué aucune recherche, recherche l'agence qui te correspond.</p>
        <{/if}>
        <a class="padding-bottom ecra-bread" href="<{site_url('search')}>">Recherche</a>
    </div>
    <div class="motif motif-register hidden-xs hidden-sm hidden-md">
        <span class="l1"></span>
        <span class="l2"></span>
        <span class="l3"></span>
        <span class="l4"></span>
    </div>
    <div class="img_post membres-img hidden-xs hidden-sm">
        <img src="<{assets('img/img_search.jpg')}>" alt="Image d'un contact">
        <h4 class="my_h4 move_h for-all move-all-h-mosaic">Tous les postulants.</h4>
    </div>
    <h4 class="visible-xs visible-sm">Tous les postulants.</h4>
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
                <{/if}>
                <{$i = $i + 1}>
            <{/foreach}>
        </ul>
    </div>
<{/if}>