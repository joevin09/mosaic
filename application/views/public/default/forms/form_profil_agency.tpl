<form method="post" action="<{current_url()}>" class="form-horizontal form-post" novalidate enctype="multipart/form-data">
    <div class="pres pres-register profil-poeple poeple-modif"> 
        <div class="img-profil">
            <!--<i class="fa fa-eye fa-pencil"></i>-->
            <label class="control-label col-sm-4" for="avatar"><img src="<{avatar_url($form['avatar'], '150x150')}>" alt="" /></label>
            <p class="modif-profil-avatar">Modifier avatar</p>
        </div>
        <h2 class="agency_h2">Modification de ton profil</h2>
        <div class="first-input form-group<{if form_error('avatar')}> has-error<{/if}>">
            <div class="col-sm-8">
                <input class="avatar-modif" type="file" name="avatar" id="avatar" />

                <{if form_error('avatar')}>
                    <span class="help-block"><{form_error('avatar')}></span>
                <{/if}>
            </div>
        </div>

        <div class="propos form-group<{if form_error('web_statut')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="web_statut">Fonction :</label>
            <div class="col-sm-8 change-profil">
                <input type="text" name="web_statut" id="web_statut" value="<{$form['web_statut']}>" required="required" class="form-control" placeholder="Fonction web" />
                <{if form_error('web_statut')}>
                    <span class="help-block"><{form_error('web_statut')}></span>
                <{/if}>
            </div>
        </div>
        <div class="form-group<{if form_error('town')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="town">Ville :</label>
            <div class="col-sm-8 change-profil">
                <input type="text" name="town" id="town" value="<{$form['town']}>" required="required" class="form-control" placeholder="Ville" />
                <{if form_error('town')}>
                    <span class="help-block"><{form_error('town')}></span>
                <{/if}>
            </div>
        </div>

        <div class="apropos form-group<{if form_error('about')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="about">A propos :</label>
            <div class="col-sm-8 change-profil">
                <textarea name="about" id="about" value="<{$form['about']}>" required="required" class="form-control" rows="2" cols="50" maxlength="150" placeholder="A propos de toi"><{$form['about']}></textarea>
                <p class="caractere">Il te reste <span id="caracteres" >150</span> caractères.</p>
                <{if form_error('about')}>
                    <span class="help-block"><{form_error('about')}></span>
                <{/if}>
            </div>
        </div>

        <div class="form-group<{if form_error('website')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="website">Site web :</label>
            <div class="col-sm-8 change-profil">
                <input type="text" name="website" id="website" value="<{$form['website']}>" required="required" class="form-control" placeholder="Url du site web"/>
                <{if form_error('website')}>
                    <span class="help-block"><{form_error('website')}></span>
                <{/if}>
            </div>
        </div>
            <div class="form-group<{if form_error('passwd')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="passwd">Mot de passe :</label>
            <div class="col-sm-8 change-profil">
                <input type="password" name="passwd" id="passwd" value="" required="required" class="form-control" placeholder="Nouveau mot de passe"/>
                <{if form_error('passwd')}>
                    <span class="help-block"><{form_error('passwd')}></span>
                <{/if}>
            </div>
        </div>
        <{*<div class="form-group<{if form_error('sexe')}> has-error<{/if}>">
        <label class="control-label col-sm-4" for="sexe_m">Genre :</label>
        <div class="col-sm-8">
        <div class="radio">
        <label for="sexe_m">
        <input type="radio" name="sexe" id="sexe_m" value="Masculin"<{if $form['sexe'] === "Masculin"}> checked="checked"<{/if}> />
        Homme
        </label>
        </div>
        <div class="radio">
        <label for="sexe_f">
        <input type="radio" name="sexe" id="sexe_f" value="Féminin"<{if $form['sexe'] === "Féminin"}> checked="checked"<{/if}> />
        Femme
        </label>
        </div>
        <{if form_error('sexe')}>
        <span class="help-block"><{form_error('sexe')}></span>
        <{/if}>
        </div>
        </div>*}>
    </div>

    <div class="motif motif-profil hidden-xs hidden-sm hidden-md">
        <span class="l1"></span>
        <span class="l2"></span>
        <span class="l3"></span>
        <span class="l4"></span>
    </div> 

    <div class="fuctions-list parcours">

        <{assign var=offerdata value="/"|explode:$form['offer']}>
        <{assign var=offerurldata value=" "|explode:$form['offer_url']}>


        <div class="offres offre1 active">
            <h2>Offres</h2>
            <div class="<{if form_error('offer-1')}> has-error<{/if}>">
                <div>
                    <label for="offer-1">Type d'offre</label>
                    <div>
                        <input class="form-control" type="text" value="<{$offerdata[0]}>" id="offer-1" name="offer-1" placeholder="Web designer">
                    </div>
                    <{if form_error('offer-1')}>
                        <span class="help-block"><{form_error('offer-1')}></span>
                    <{/if}>
                </div>
            </div> 
            <div>
                <label for="offerurl-1">Lien de l'offre</label>
                <input class="form-control" type="text" value="<{$offerurldata[0]}>" id="offerurl-1" name="offerurl-1" placeholder="Lien">
            </div>
        </div>
        <div class="offres offre2 <{if ($offerdata[1] != "")}>active<{/if}>">
          
                <div class="<{if form_error('offer-2')}> has-error<{/if}>">
                    <div>
                        <label for="offer-2">Type d'offre</label>
                        <input class="form-control" type="text" value="<{$offerdata[1]}>" id="offer-2" name="offer-2" placeholder="Web designer">
                        <{if form_error('offer-2')}>
                            <span class="help-block"><{form_error('offer-2')}></span>
                        <{/if}>
                    </div>
                </div> 
                <div>
                    <label for="offerurl-2">Lien de l'offre</label>
                    <input class="form-control" type="text" value="<{$offerurldata[1]}>" id="offerurl-2" name="offerurl-2" placeholder="Lien">
                </div>
           
        </div>

        <div class="offres offre3 <{if ($offerdata[2] != "")}>active<{/if}>">

            <div class="<{if form_error('offer-3')}> has-error<{/if}>">
                <div>
                    <label for="offer-3">Type d'offre</label>
                    <div>
                        <input class="form-control" type="text" value="<{$offerdata[2]}>" id="offer-3" name="offer-3" placeholder="Web designer">
                    </div>
                    <{if form_error('offer-3')}>
                        <span class="help-block"><{form_error('offer-3')}></span>
                    <{/if}>
                </div>
            </div> 
            <div>
                <label for="offerurl-3">Lien de l'offre</label>
                <input class="form-control" type="text" value="<{$offerurldata[2]}>" id="offerurl-3" name="offerurl-3" placeholder="Lien">
            </div>
        </div>

        <div class="offres offre4 <{if ($offerdata[3] != "")}>active<{/if}>">

            <div class="<{if form_error('offer-4')}> has-error<{/if}>">
                <div>
                    <label for="offer-4">Type d'offre</label>
                    <div>
                        <input class="form-control" type="text" value="<{$offerdata[3]}>" id="offer-4" name="offer-4" placeholder="Web designer">
                    </div>
                    <{if form_error('offer-4')}>
                        <span class="help-block"><{form_error('offer-4')}></span>
                    <{/if}>
                </div>
            </div> 
            <div>
                <label for="offerurl-4">Lien de l'offre</label>
                <input class="form-control" type="text" value="<{$offerurldata[3]}>" id="offerurl-4" name="offerurl-4" placeholder="Lien">
            </div>
        </div>


        <i class="fa fa-plus plus1 more"></i>
    </div>

    <h2 class="search-title search-title-agency">Afin d'être visible dans les recherches</h2>

    <div class="fuctions-list secteurs">
        <h2>Secteurs</h2>
        <div class="form-group<{if form_error('functions')}> has-error<{/if}>">

            <div class="col-sm-12">
                <{foreach from=$functions_list item=v}>
                    <div class="checkbox <{if is_array($form['functions']) && array_key_exists($v->function_id, $form['functions'])}>active<{/if}>">
                        <input id="functions-<{$v->function_id}>" type="checkbox" name="functions[<{$v->function_id}>]" value="1"<{if is_array($form['functions']) && array_key_exists($v->function_id, $form['functions'])}> checked="checked"<{/if}> />
                        <label for="functions-<{$v->function_id}>" <{if is_array($form['functions']) && array_key_exists($v->function_id, $form['functions'])}>class="checked"<{/if}>><{$v->function_name}></label>

                    </div>
                <{/foreach}>
                <{if form_error('functions')}>
                    <span class="help-block"><{form_error('functions')}></span>
                <{/if}>
            </div>
        </div>
    </div>


    <div class="infos offre cityexperience region region-agency">

        <div class="motif motif-profil hidden-xs hidden-sm hidden-md last-motif last-modif-agency">
            <span class="l1"></span>
            <span class="l2"></span>
            <span class="l3"></span>
            <span class="l4"></span>
        </div>

        <h2>Régions</h2>
        <div class="form-group<{if form_error('cities')}> has-error<{/if}>">

            <div class="col-sm-8">
                <{foreach from=$cities_list item=v}>
                    <div class="checkbox <{if is_array($form['cities']) && array_key_exists($v->city_id, $form['cities'])}>checked"<{/if}>">
                        <label for="cities-<{$v->city_id}>"><{$v->city_name}></label>
                        <input id="cities-<{$v->city_id}>" type="checkbox" name="cities[<{$v->city_id}>]" value="1" <{if is_array($form['cities']) && array_key_exists($v->city_id, $form['cities'])}>checked="checked"<{/if}> />
                    </div>
                <{/foreach}>
                <{if form_error('cities')}>
                    <span class="help-block"><{form_error('cities')}></span>
                <{/if}>
            </div>
        </div>
        <h2 class="padding-top-title">Nombre de membres</h2>
        <div class="form-group<{if form_error('nbr_member')}> has-error<{/if}>">
            <div class="col-sm-2">
                <{*<select name="nbr_member" id="nbr_member">
                <option selected disabled value="">Nombre :</option>
                <option value="1-10"<{if $form['nbr_member'] == "1-10"}> selected="selected"<{/if}>>< 10</option>
                <option value="11-20"<{if $form['nbr_member'] == "11-20"}> selected="selected"<{/if}>>11-20</option>
                <option value="21"<{if $form['nbr_member'] == "21"}> selected="selected"<{/if}>>> 21</option>
                </select>*}>
                <input id="nbr_member" type="text" name="nbr_member" value="<{$form['nbr_member']}>" />

                <{if form_error('nbr_member')}>
                    <span class="help-block"><{form_error('nbr_member')}></span>
                <{/if}>
            </div>
        </div>
    </div>
    <div class="save save-agency">
        <div class='btn-choose link-modif-profil modif-your-profil'>
            <i class="fa fa-file fa-pencil"></i>
            <input type="hidden" name="action" value="submit" />
            <button type="submit" class="btn btn-primary pluspadding">Sauvegarder</button>
        </div>
        <a class="no-lien del-profil" href="<{site_url(array($this->router->fetch_class(), 'delete'))}>" onclick="return confirm('Souhaitez vraiment supprimer votre compte ?');">Supprimer compte</a>
    </div>
    <{include file="_forms_top.tpl"}>
</form>