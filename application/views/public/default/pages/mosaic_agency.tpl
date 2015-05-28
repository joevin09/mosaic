
<{block name="page-title"}>Résultats<{/block}>

<{block name="content"}>
    <{if count($list) > 0}>
        <div class="pres pres-register membres">
            <a class="img-profil" href="<{site_url('profil')}>">
                <i class="fa fa-pencil"></i>
                <img src="<{avatar_url($this->user->avatar, '150x150')}>" style="width:100%;" alt="" />
            </a>
            <h2><{username($v)}></h2>
            <h3 class="clear">Une recherche, un résultat, ta mosaic</h3>
            <ol class="breadcrumb">
                <{assign var=uri value="/"|explode:$this->user->last_search_uri}>
                <{$flag = 0}>
                <{foreach from=$uri item=v}>
                    <{if ($flag == 1 || $flag == 3 || $flag == 5)}>
                        <li>
                            <span><{$v}></span>
                        </li>
                    <{/if}>
                    <{$flag = $flag + 1}>
                <{/foreach}>
            </ol>
            <a class="return" href="<{if ($this->user->agency_name == "")}><{site_url('search')}><{else}><{site_url('search_agency')}><{/if}>">Recherche</a>
        </div>
        <div class="motif motif-register hidden-xs hidden-sm hidden-md"></div>
        <div class="img_post membres-img hidden-xs hidden-sm">
            <img src="<{assets('img/img_search.jpg')}>" alt="Image d'un contact">
            <h4 class="move-h">Postulants correspondants.</h4>
        </div>
        <h4 class="visible-xs visible-sm">Postulants correspondants.</h4>
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
            <h2>Mosaic</h2>
            <h3>Aucune profil n'a été found !</h3>
            <p>Cherches parmis les agences pour touver celle qui te correspond.
            </p>
            <a class="return" href="<{site_url('search')}>">Recherche</a>
        </div>
        <div class="motif motif-register hidden-xs hidden-sm hidden-md"></div>
        <div class="img_post membres-img hidden-xs hidden-sm">
            <img src="<{assets('img/img_search.jpg')}>" alt="Image d'un contact">
            <h4 class="move-h">Tous les postulants.</h4>
        </div>
        <h4 class="visible-xs visible-sm">Tous les postulants.</h4>
        <div class="last_register_home all-members">
            <ul class="list">

                <{$i = 0}>
                <{foreach from=$members item=v}>
                    <{if $v->agency_name != NULL}>
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
<{/block}>