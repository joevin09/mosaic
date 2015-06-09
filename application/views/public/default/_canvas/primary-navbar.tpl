<div class="container">
    <nav class="navbar navbar-fixed-top">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" role="button" aria-label="Toggle Navigation" class="navbar-toggle lines-button arrow arrow-left">
                        <span class="sr-only">Navigation Smartphone</span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<{site_url('', FALSE)}>">
                        <{include file="_logo.tpl"}>
                    </a>
                    <{if $this->user->user_id < 0}>
                    <div class="link_agency hidden-xs">
                        <p>
                            <a href="#postulant">Postulant</a><span>/</span><a href="#agency">Agence</a>
                        </p>
                    </div>
                    <{/if}>
                </div>
                <div id="navbar" class="nav-collapse">
                    <ul class="nav navbar-nav menu">
                        <{foreach from=$this->primary_nav item=v}>
                            <{if (!$v['user_must_be_logged_in'] || $this->user->user_id > 0)}>
                                    <{assign "slug" $v['slug']}>
                                    <{assign "name" $v['name']}> 
                            <{else if is_array($v['user_must_be_logged_in'])}>
                                <{assign "slug" $v['user_must_be_logged_in']['slug']}>
                                <{assign "name" $v['user_must_be_logged_in']['name']}>
                            <{/if}>
                            <li<{if $this->router->fetch_class() == $slug}> class="active"<{/if}>>
                                <a href="<{site_url($slug, FALSE)}>">
                                    <{$name}>
                                </a>
                            </li>
                        <{/foreach}>
                        <li>
                            <ul class="nav navbar-nav connect_link">
                                <{if $this->user->user_id > 0}>

                                    <{if ($this->user->agency_name !="")}>                           
                                        <{assign "user" $this->user->agency_name}>
                                    <{else}>
                                        <{assign "user" $this->user->first_name}> 
                                    <{/if}>
                                    <li><a href="<{site_url(array('members/view', $this->user->user_id))}>" title="Profil de <{$user}>"><{$user}></a></li>
                                    <li><a href="<{site_url('logout')}>">Déconnexion</a></li>
                                    <{else}>
                                    <li><a href="<{site_url('register')}>">Inscription</a></li>
                                    <li><a href="<{site_url('login')}>">Connexion</a></li>
                                    <{/if}>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav social_icon">
                        <li>
                            <a href="https://www.facebook.com/pages/Mosaic/370991219764479" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="https://twitter.com/m_saic_" target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="https://fr.pinterest.com/mosaic0529/" target="_blank"><i class="fa fa-pinterest-p"></i></a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/u/1/" target="_blank"><i class="fa fa-google-plus"></i></a>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </nav>
</div>
