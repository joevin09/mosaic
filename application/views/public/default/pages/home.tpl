<{block name="content"}>
    <{if $this->user->user_id > 0}>

        <{if ($this->user->agency_name == NULL)}>
            <div id="postulant" class="content visible-menu connect-top">
                <div class="pres pres_postulant">
                    <h2 class="agency_h2">Postulant</h2>
                    <span class="ligne"></span>
                    <h3 class="h3-home">Tu cherches <br/><span id="changeword-postulant">ta place</span><br/> sur le web ?</h3>
                    <p>Définis ta recherche afin de trouver l’agence<br /> qui te correspond le mieux.</p>
                    <a class="link-post" href="<{site_url('search_agency')}>">Trouve-là !</a>
                </div>
                <div class="motif hidden-xs hidden-sm hidden-md">
                    <span class="l1"></span>
                    <span class="l2"></span>
                    <span class="l3"></span>
                    <span class="l4"></span>
                </div>  
                <div class="img_post hidden-xs hidden-sm offre-text">
                    <img src="<{assets('img/img_agence.jpg')}>" alt="Image d'une agence">
                    <h4 class="my_h4">Agences inscrites récemment</h4>
                    <p><span></span>Offre d'emploi en cours</p>
                </div>
                <div class="last_register_home display-400">
                    <ul class="list">
                        <{$i = 0}>
                        <{foreach from=$last_registered_agencies item=v}>
                            <li class="item-<{$i}>">
                                <a href="<{site_url(array('members','view', $v->user_id))}>">
                                    <img src="<{avatar_url($v->avatar, '150x150')}>" style="width:100%;" alt="" />
                                    <p><{username($v)}></p>
                                    <{if ($v->offer != "")}>
                                    <span class="offre-square" title="Offre d'emploi">Offre d'emploi</span>
                                <{/if}>
                                </a>
                            </li>
                            <{$i = $i + 1}>
                        <{/foreach}>
                    </ul>

                </div>
            </div>
        <{else}>
            <div id="agency" class="content connect-top-agency">
                <div class="pres pres_agency">
                    <h2 class="agency_h2">Agence</h2>
                    <span class="ligne"></span>
                    <h3 class="h3-home">Tu tentes de trouver<br/><span id="changeword-agence">un associé ?</span></h3>
                    <p>Spécifie ta recherche afin de trouver<br /> le collaborateur qui te correspond.</p>
                    <div class="link_find link-age"><a href="<{site_url('search')}>">Trouve-le !</a></div>
                </div>
                <div class="motif hidden-xs hidden-sm hidden-md">
                    <span class="l1"></span>
                    <span class="l2"></span>
                    <span class="l3"></span>
                    <span class="l4"></span>
                </div> 
                <div class="img_post hidden-xs hidden-sm">
                    <img src="<{assets('img/img_postulant.jpg')}>" alt="Image d'un postulant">
                    <h4 class="my_h4">Postulants inscrits récemment</h4>
                </div>
                <div class="last_register_home display-400">
                    <ul class="list">
                        <{$i = 0}>
                        <{foreach from=$last_registered item=v}>
                            <li class="item-<{$i}>">
                                <a href="<{site_url(array('members','view', $v->user_id))}>">
                                    <img src="<{avatar_url($v->avatar, '150x150')}>" style="width:100%;" alt="" />
                                    <p><{username($v)}></p>
                                   
                                </a>
                            </li>
                            <{$i = $i + 1}>
                        <{/foreach}>
                    </ul>
                       
                </div>
            </div>
        <{/if}>

    <{else}>
        <div id="postulant" class="content visible-menu">
            <div class="pres pres_postulant">
                <h2 class="agency_h2">Postulant</h2>
                <span class="ligne"></span>
                <h3 class="h3-home">Tu cherches <br/><span id="changeword-postulant">ta place</span><br/> sur le web ?</h3>
                <p>Définis ta recherche afin de trouver l’agence<br /> qui te correspond le mieux.</p>
                <a class="link-post" href="<{site_url('search_agency')}>">Trouve-la !</a>
            </div>
            <div class="motif hidden-xs hidden-sm hidden-md">
                <span class="l1"></span>
                <span class="l2"></span>
                <span class="l3"></span>
                <span class="l4"></span>
            </div>  
            <div class="img_post hidden-xs hidden-sm offre-text">
                <img src="<{assets('img/img_agence.jpg')}>" alt="Image d'une agence">
                <h4 class="my_h4 my_h4_agency">Agences inscrites récemment</h4>
                <p><span></span>Offre d'emploi en cours</p>
            </div>
            <div class="last_register_home last_register_home_agency display-400">
                <ul class="list">
                    <{$i = 0}>
                    <{foreach from=$last_registered_agencies item=v}>
                        <li class="item-<{$i}>">
                            <a href="<{site_url(array('members','view', $v->user_id))}>">
                                <img src="<{avatar_url($v->avatar, '150x150')}>" style="width:100%;" alt="" />
                                <p><{username($v)}></p>
                                <{if ($v->offer != "")}>
                                    <span class="offre-square" title="Offre d'emploi">Offre d'emploi</span>
                                <{/if}>
                            </a>
                        </li>
                        <{$i = $i + 1}>
                    <{/foreach}>
                </ul>
            </div>
        </div>
        <div id="agency" class="content">
            <div class="pres pres_agency">
                <h2 class="agency_h2">Agence</h2>
                <span class="ligne"></span>
                <h3 class="h3-home">Tu tentes de trouver<br/><span id="changeword-agence">un associé ?</span></h3>
                <p>Spécifie ta recherche afin de trouver<br /> le collaborateur qui te correspond.</p>
                <div class="link_find link-age"><a href="<{site_url('search')}>">Trouve-le !</a></div>
            </div>
            <div class="motif hidden-xs hidden-sm hidden-md">
                <span class="l1"></span>
                <span class="l2"></span>
                <span class="l3"></span>
                <span class="l4"></span>
            </div> 
            <div class="img_post hidden-xs hidden-sm">
                <img src="<{assets('img/img_postulant.jpg')}>" alt="Image d'un postulant">
                <h4 class="my_h4">Postulants inscrits récemment</h4>
            </div>

            <div class="last_register_home display-400">
                <ul class="list">
                    <{$i = 0}>
                    <{foreach from=$last_registered item=v}>
                        <li class="item-<{$i}>">
                            <a href="<{site_url(array('members','view', $v->user_id))}>">
                                <img src="<{avatar_url($v->avatar, '150x150')}>" style="width:100%;" alt="" />
                                <p><{username($v)}></p>
                            

                            </a>
                        </li>
                        <{$i = $i + 1}>
                    <{/foreach}>
                </ul>

            </div>
        </div>
    <{/if}>
<{/block}>