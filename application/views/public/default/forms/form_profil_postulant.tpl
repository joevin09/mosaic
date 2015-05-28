<form method="post" action="<{current_url()}>" class="form-horizontal" novalidate enctype="multipart/form-data">
    <div class="pres pres-register profil-poeple poeple-modif"> 
        <div class="img-profil">
            <!--<i class="fa fa-eye fa-pencil"></i>-->
            <label class="control-label col-sm-4" for="avatar"><img src="<{avatar_url($form['avatar'], '150x150')}>" alt="" /></label>
        </div>
        <h2>Modification de ton profil</h2>
        <div class="first-input form-group<{if form_error('avatar')}> has-error<{/if}>">
            <div class="col-sm-8">
                <input class="avatar-modif" type="file" name="avatar" id="avatar" />
                <{if form_error('avatar')}>
                    <span class="help-block"><{form_error('avatar')}></span>
                <{/if}>
            </div>
        </div>

        <div class="form-group<{if form_error('about')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="about">A propos :</label>
            <div class="col-sm-8 change-profil">
                <textarea name="about" id="about" value="<{$form['about']}>" required="required" class="form-control" rows="4" cols="50" maxlength="150" placeholder="A propos de toi"><{$form['about']}></textarea>
                <p>Il reste <span id="caracteres" >150</span> caractères.</p>
                <{if form_error('about')}>
                    <span class="help-block"><{form_error('about')}></span>
                <{/if}>
            </div>
        </div>

        <div class="form-group<{if form_error('website')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="website">Site web :</label>
            <div class="col-sm-8 change-profil">
                <input type="text" name="website" id="website" value="<{$form['website']}>" required="required" class="form-control" />
                <{if form_error('website')}>
                    <span class="help-block"><{form_error('website')}></span>
                <{/if}>
            </div>
        </div>

        <div class="form-group<{if form_error('town')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="town">Ville :</label>
            <div class="col-sm-8 change-profil">
                <input type="text" name="town" id="town" value="<{$form['town']}>" required="required" class="form-control" />
                <{if form_error('town')}>
                    <span class="help-block"><{form_error('town')}></span>
                <{/if}>
            </div>
        </div>

        <div class="form-group<{if form_error('web_statut')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="web_statut">Fonction :</label>
            <div class="col-sm-8 change-profil">
                <input type="text" name="web_statut" id="web_statut" value="<{$form['web_statut']}>" required="required" class="form-control" />
                <{if form_error('web_statut')}>
                    <span class="help-block"><{form_error('web_statut')}></span>
                <{/if}>
            </div>
        </div>


        <div class="form-group<{if form_error('sexe')}> has-error<{/if}>">
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
        </div>
    </div>

    <div class="motif motif-profil hidden-xs hidden-sm hidden-md">
        <span class="l1"></span>
        <span class="l2"></span>
        <span class="l3"></span>
        <span class="l4"></span>
    </div> 

    <div class="fuctions-list">
        <div class="form-group<{if form_error('functions')}> has-error<{/if}>">
            <label class="control-label" for="functions">Secteurs</label>
            <div class="col-sm-12">
                <{foreach from=$functions_list item=v}>
                    <div class="checkbox <{if is_array($form['functions']) && array_key_exists($v->function_id, $form['functions'])}>active<{/if}>">
                        <input id="functions-<{$v->function_id}>" type="checkbox" name="functions[<{$v->function_id}>]" value="1"<{if is_array($form['functions']) && array_key_exists($v->function_id, $form['functions'])}> checked="checked"<{/if}> />
                        <label for="functions-<{$v->function_id}>" <{if is_array($form['functions']) && array_key_exists($v->function_id, $form['functions'])}>class="checked"<{/if}>><{$v->function_name}></label>
                        <select class="function" name="experiences[<{$v->function_id}>]">
                            <option selected disabled value="">Expériences :</option>
                            <{foreach from=$experiences_list item=vv}>
                                <option value="<{$vv->experience_id}>"<{if $vv->experience_id == $form['functions'][$v->function_id]['experience_id']}> selected="selected"<{/if}>><{$vv->experience_name}></option>
                            <{/foreach}>
                        </select> 
                    </div>
                <{/foreach}>
                <{if form_error('functions')}>
                    <span class="help-block"><{form_error('functions')}></span>
                <{/if}>
            </div>
        </div>
    </div>

    <div class="motif motif-capacite modif-modif hidden-xs hidden-sm hidden-md">
        <span class="l1"></span>
        <span class="l2"></span>
        <span class="l3"></span>
        <span class="l4"></span>
    </div> 

    <div class="infos offre cityexperience">
        <div class="form-group<{if form_error('cities')}> has-error<{/if}>">
            <label for="cities" class="control-label col-sm-4" for="cities">Régions</label>
            <div class="col-sm-8">
                <{foreach from=$cities_list item=v}>
                    <div class="checkbox">
                        <label>
                            <input id="cities" type="checkbox" name="cities[<{$v->city_id}>]" value="1"<{if is_array($form['cities']) && array_key_exists($v->city_id, $form['cities'])}> checked="checked"<{/if}> />
                            <{$v->city_name}>
                        </label>
                    </div>
                <{/foreach}>
                <{if form_error('cities')}>
                    <span class="help-block"><{form_error('cities')}></span>
                <{/if}>
            </div>
        </div>

        <div class="form-group<{if form_error('profession_status_id')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="profession_status_id">Statut</label>
            <div class="col-sm-8">
                <select name="profession_status_id" id="profession_status_id">
                    <option selected disabled value="">Statuts :</option>
                    <{foreach from=$professions_status_list item=v}>
                        <option value="<{$v->profession_status_id}>"<{if $form['profession_status_id'] == $v->profession_status_id}> selected="selected"<{/if}>><{$v->profession_name}></option>
                    <{/foreach}>
                </select> 
                <{if form_error('profession_status_id')}>
                    <span class="help-block"><{form_error('profession_status_id')}></span>
                <{/if}>
            </div>
        </div>
    </div>

    <div class="motif motif-profil hidden-xs hidden-sm hidden-md">
        <span class="l1"></span>
        <span class="l2"></span>
        <span class="l3"></span>
        <span class="l4"></span>
    </div>

    <{assign var=processdata value="/"|explode:$form['process']}>
    <{assign var=processdatadate value=" "|explode:$form['process_date']}>


    <div class="fuctions-list">
        <div class="form-group<{if form_error('process-1')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="process-1">Process</label>
            <div class="col-sm-8">
                <label for="process-1">Process</label>
                <input type="text" value="<{$processdata[0]}>" id="process-1" name="process-1">

                <{if form_error('process-1')}>
                    <span class="help-block"><{form_error('process-1')}></span>
                <{/if}>
            </div>
        </div>  
    </div>

    <div class="fuctions-list process-1 <{if $processdatadate[1] == "Aujourd'hui"}>checked<{/if}>">
        <div class="form-group<{if form_error('process-1-date-1')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="process-1-date-1">Process</label>
            <div class="col-sm-8">
                <label for="process-1-date-1">Date de Début</label>
                <input type="date" value="<{$processdatadate[0]}>" id="process-1-date-1" name="process-1-date-1">

                <label for="process-1-date-2">Date de Fin</label>
                <input type="date" value="<{$processdatadate[1]}>" id="process-1-date-2" name="process-1-date-2">
                
                <input type="radio" value="Aujourd'hui" name="today-1" <{if $processdatadate[1] == "Aujourd'hui"}>checked<{/if}> id="today-1">
                <label for="today-1">Aujourd'hui</label>

                <{if form_error('process-1-date-1')}>
                    <span class="help-block"><{form_error('process-1-date-1')}></span>
                <{/if}>
            </div>
        </div>  
    </div>


    <div class="fuctions-list">
        <div class="form-group<{if form_error('process-2')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="process-2">Process</label>
            <div class="col-sm-8">
                <label for="process">Process</label>
                <input type="process" value="<{$processdata[1]}>" id="process-2" name="process-2">

                <{if form_error('process-2')}>
                    <span class="help-block"><{form_error('process-2')}></span>
                <{/if}>
            </div>
        </div>  
    </div>

    <div class="fuctions-list process-2 <{if $processdatadate[3] == "Aujourd'hui"}>checked<{/if}>">
        <div class="form-group<{if form_error('process-2-date-1')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="process-2-date-1">Process</label>
            <div class="col-sm-8">
                <label for="process-2-date-1">Date de Début</label>
                <input type="date" value="<{$processdatadate[2]}>" id="process-2-date-1" name="process-2-date-1">

                <label for="process-2-date-2">Date de Fin</label>
                <input type="date" value="<{$processdatadate[3]}>" id="process-2-date-2" name="process-2-date-2">
                
                <input type="radio" value="Aujourd'hui"  <{if $processdatadate[3] == "Aujourd'hui"}>checked<{/if}> name="today-2" id="today-2">
                <label for="today-2">Aujourd'hui</label>

                <{if form_error('process-2-date-1')}>
                    <span class="help-block"><{form_error('process-2-date-1')}></span>
                <{/if}>
            </div>
        </div>  
    </div>

    <div class="fuctions-list">
        <div class="form-group<{if form_error('process-3')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="process-3">Process</label>
            <div class="col-sm-8">
                <label for="process">Process</label>
                <input type="process" value="<{$processdata[2]}>" id="process-3" name="process-3">

                <{if form_error('process-3')}>
                    <span class="help-block"><{form_error('process-3')}></span>
                <{/if}>
            </div>
        </div>  
    </div>

    <div class="fuctions-list">
        <div class="form-group<{if form_error('process-4')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="process-4">Process</label>
            <div class="col-sm-8">
                <label for="process">Process</label>
                <input type="process" value="<{$processdata[3]}>" id="process-4" name="process-4">

                <{if form_error('process-4')}>
                    <span class="help-block"><{form_error('process-4')}></span>
                <{/if}>
            </div>
        </div>  
    </div>



    <div class="fuctions-list competences-content">
        <div class="form-group<{if form_error('competences')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="competences">Compétences</label>
            <div class="col-sm-8">
                <label for="competences">Compétences</label>
                <input type="competences" value="<{$form['competences']}>" id="competences" name="competences">
                <{if form_error('competences')}>
                    <span class="help-block"><{form_error('competences')}></span>
                <{/if}>
            </div>
        </div>  
    </div>

    <div class='btn-choose link-modif-profil modif-your-profil'>
        <i class="fa fa-file fa-pencil"></i>
        <input type="hidden" name="action" value="submit" />
        <button type="submit" class="btn btn-primary">Sauvegarder</button>
    </div>
    <{include file="_forms_top.tpl"}>

    <div class="my_button">
        <div class='btn-choose link-modif-profil modif-your-profil'>
            <i class="fa fa-eye fa-pencil"></i>
            <a href="<{site_url(array('members/view', $this->user->user_id))}>" class="btn btn-primary">Profil</a>

        </div>
        <div class='btn-choose link-modif-profil modif-your-profil'>
            <i class="fa fa-users fa-pencil"></i>
            <a class="btn btn-primary" href="<{site_url('mosaic')}>">Voir ma mosaic</a>  

        </div>
    </div>
    <a href="<{site_url(array($this->router->fetch_class(), 'delete'))}>" onclick="return confirm('Souhaitez vraiment supprimer votre compte ?');" class="btn btn-danger">je veux delete mon compte</a>
</div>
</form>