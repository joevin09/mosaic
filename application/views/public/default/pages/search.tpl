<{block name="page-title"}><{$select_page_title}><{/block}>

<{block name="content"}>
    <{if $this->user->user_id > 0}>
        <{if count($list) > 0}>

            <ol class="breadcrumb bread">
                <{foreach from=$breadcrumb item=v}>
                    <li>
                        <{if $v['active']}>
                            <a class="active" href="<{site_url(array($this->router->fetch_class(), $v['url']))}>"><{$v['name']}></a>
                        <{else}>
                            <span><{$v['name']}></span>
                        <{/if}>
                    </li>
                <{/foreach}>
            </ol>
            <div class="pres pres-register membres">
                <h2 class="agency_h2"><{$select_head_title}></h2>
                <h3><{$select_h3}></h3>
                <p><{$select_p}></p>
                <div class="select-profil">
                    <select class="select-go-to custom_select">
                        <option selected disabled value=""><{$select_title}>:</option>
                        <{foreach from=$select_list item=v}>
                            <option value="<{$v->url_value}>"><{$v->$field_name_value}></option>
                        <{/foreach}>
                    </select>
                </div>
                <div class="back" onclick="history.back();"><i class="fa fa-long-arrow-left"></i> Étape précédente</div>
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
            <ol class="breadcrumb bread">
                <{foreach from=$breadcrumb item=v}>
                    <li>
                        <{if $v['active']}>
                            <a class="active" href="<{site_url(array($this->router->fetch_class(), $v['url']))}>"><{$v['name']}></a>
                        <{else}>
                            <span><{$v['name']}></span>
                        <{/if}>
                    </li>
                <{/foreach}>
            </ol>
            <div class="pres pres-register membres">
                <h2 class="agency_h2">Désolé</h2>
                <h3>Aucune recherche ne correspond !</h3>
                <p>Cherches parmis les profils ou inscris-toi pour recevoir les offres te correspondants.
                </p>
                <a class="padding-bottom" href="<{site_url('mosaic')}>">Ta mosaic</a>
                <div class="back" onclick="history.back();"><i class="fa fa-long-arrow-left"></i> Retour à la recherche</div>
            </div>

            <div class="motif motif-register hidden-xs hidden-sm hidden-md">
                <span class="l1"></span>
                <span class="l2"></span>
                <span class="l3"></span>
                <span class="l4"></span>
            </div>
            <div class="img_post membres-img hidden-xs hidden-sm">
                <img src="<{assets('img/img_search.jpg')}>" alt="Image d'un recherche">
                <h4 class="my_h4 move_h for-all">Tous les postulants.</h4>
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
            <ol class="breadcrumb bread">
                <{foreach from=$breadcrumb item=v}>
                    <li>
                        <{if $v['active']}>
                            <a class="active" href="<{site_url(array($this->router->fetch_class(), $v['url']))}>"><{$v['name']}></a>
                        <{else}>
                            <span><{$v['name']}></span>
                        <{/if}>
                    </li>
                <{/foreach}>
            </ol>
            <div class="pres pres-register membres">
                <h2 class="agency_h2"><{$select_head_title}></h2>
                <h3><{$select_h3}></h3>
                <p><{$select_p}></p>
                <div class="select-profil">
                    <select class="select-go-to custom_select">
                        <option selected disabled value=""><{$select_title}>:</option>
                        <{foreach from=$select_list item=v}>
                            <option value="<{$v->url_value}>"><{$v->$field_name_value}></option>
                        <{/foreach}>
                    </select>
                </div>
                <div class="back" onclick="history.back();"><i class="fa fa-long-arrow-left"></i> Étape précédente</div>
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
            <ol class="breadcrumb bread">
                <{foreach from=$breadcrumb item=v}>
                    <li>
                        <{if $v['active']}>
                            <a class="active" href="<{site_url(array($this->router->fetch_class(), $v['url']))}>"><{$v['name']}></a>
                        <{else}>
                            <span><{$v['name']}></span>
                        <{/if}>
                    </li>
                <{/foreach}>
            </ol>
            <div class="pres pres-register membres">
                <h2 class="agency_h2">Désolé</h2>
                <h3>Aucune recherche ne correspond !</h3>
                <p>Cherches parmis les profils ou inscris-toi pour recevoir les offres te correspondants.
                </p>
                <a class="padding-bottom" href="http://m-saic.be/register/?register_mode=agency">Inscription</a>
                <div class="back" onclick="history.back();"><i class="fa fa-long-arrow-left"></i> Retour à la recherche</div>
            </div>

            <div class="motif motif-register hidden-xs hidden-sm hidden-md">
                <span class="l1"></span>
                <span class="l2"></span>
                <span class="l3"></span>
                <span class="l4"></span>
            </div>
            <div class="img_post membres-img hidden-xs hidden-sm">
                <img src="<{assets('img/img_search.jpg')}>" alt="Image d'un recherche">
                <h4 class="my_h4 move_h for-all">Tous les postulants.</h4>
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