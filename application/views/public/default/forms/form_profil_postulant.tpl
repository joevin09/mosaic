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
                <textarea name="about" id="about" value="<{$form['about']}>" required="required" class="form-control" rows="3" cols="50" maxlength="150" placeholder="A propos de toi"><{$form['about']}></textarea>
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

        <{assign var=processdata value="/"|explode:$form['process']}>
        <{assign var=processdatadate value=" "|explode:$form['process_date']}>


        <div class="formation1 active">
            <h2>Parcours</h2>
            <div class="<{if form_error('process-1')}> has-error<{/if}>">

                <label for="process-1">Nom</label>
                <div>
                    <input class="form-control" type="text" value="<{$processdata[0]}>" id="process-1" name="process-1" placeholder='École, agences, ...'>
                </div>
                <{if form_error('process-1')}>
                    <span class="help-block"><{form_error('process-1')}></span>
                <{/if}>

            </div>  


            <div class="process-1 <{if $processdatadate[1] == "Aujourd'hui"}>checked<{/if}>">
                <div class="form-group<{if form_error('process-1-date-1')}> has-error<{/if}>">


                    <div class="col-sm-6">
                        <div class="form-group col-sm-12">
                            <label for="process-1-date-1">Date de Début</label>
                        </div>
                        <div class="form-group col-sm-12">
                            <input type="date" value="<{$processdatadate[0]}>" id="process-1-date-1" name="process-1-date-1">
                        </div>
                    </div>
                    <div class="endtime1 col-sm-6">
                        <div class="form-group col-sm-12">
                            <label for="process-1-date-2">Date de Fin</label>
                        </div>
                        <div class="form-group col-sm-12">
                            <input type="date" value="<{$processdatadate[1]}>" id="process-1-date-2" name="process-1-date-2">
                        </div>
                    </div>
                    <div class="col-sm-6 day">
                        <input type="checkbox" value="Aujourd'hui" name="today-1" <{if $processdatadate[1] == "Aujourd'hui"}>checked<{/if}> id="today-1">
                        <label class="day1" for="today-1">Aujourd'hui</label>
                    </div>
                    <{if form_error('process-1-date-1')}>
                        <span class="help-block"><{form_error('process-1-date-1')}></span>
                    <{/if}>


                </div>  
            </div>
        </div>
        <div class="formation1 add-formation2 <{if ($processdata[1] != "")}>active<{/if}>">

            <div class="<{if form_error('process-2')}> has-error<{/if}>">

                <label for="process-2">Nom</label>
                <div>
                    <input class="form-control" type="text" value="<{$processdata[1]}>" id="process-2" name="process-2" placeholder='École, agences, ...'>
                </div>
                <{if form_error('process-2')}>
                    <span class="help-block"><{form_error('process-2')}></span>
                <{/if}>

            </div>  

            <div class="process-2 <{if $processdatadate[3] == "Aujourd'hui"}>checked<{/if}>">
                <div class="form-group<{if form_error('process-2-date-1')}> has-error<{/if}>">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <div class="form-group col-sm-12">
                                    <label for="process-2-date-1">Date de Début</label>
                                </div>
                                <div class="form-group col-sm-12">
                                    <input type="date" value="<{$processdatadate[2]}>" id="process-2-date-1" name="process-2-date-1">
                                </div>
                            </div>
                            <div class="endtime2 col-sm-6">
                                <div class="form-group col-sm-12">
                                    <label for="process-2-date-2">Date de Fin</label>
                                </div>
                                <div class="form-group col-sm-12">
                                    <input type="date" value="<{$processdatadate[3]}>" id="process-2-date-2" name="process-2-date-2">
                                </div>
                            </div>
                            <div class="col-sm-6 day">
                                <input type="checkbox" value="Aujourd'hui" name="today-2" <{if $processdatadate[3] == "Aujourd'hui"}>checked<{/if}> id="today-2">
                                <label class="day2" for="today-2">Aujourd'hui</label>
                            </div>
                            <{if form_error('process-2-date-1')}>
                                <span class="help-block"><{form_error('process-2-date-1')}></span>
                            <{/if}>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="formation1 add-formation3 <{if ($processdata[1] != "")}>active<{/if}>">

            <div class="form-group<{if form_error('process-3')}> has-error<{/if}>">
                <div class="col-sm-12">
                    <label for="process-3">Nom</label>
                    <div>
                        <input class="form-control" type="text" value="<{$processdata[2]}>" id="process-3" name="process-3" placeholder='École, agences, ...'>
                    </div>
                    <{if form_error('process-3')}>
                        <span class="help-block"><{form_error('process-3')}></span>
                    <{/if}>
                </div>
            </div>  


            <div class="process-3 <{if $processdatadate[4] == "Aujourd'hui"}>checked<{/if}>">
                <div class="form-group<{if form_error('process-3-date-1')}> has-error<{/if}>">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <div class="form-group col-sm-12">
                                    <label for="process-3-date-1">Date de Début</label>
                                </div>
                                <div class="form-group col-sm-12">
                                    <input type="date" value="<{$processdatadate[4]}>" id="process-3-date-1" name="process-3-date-1">
                                </div>
                            </div>
                            <div class="endtime3 col-sm-6">
                                <div class="form-group col-sm-12">
                                    <label for="process-3-date-2">Date de Fin</label>
                                </div>
                                <div class="form-group col-sm-12">
                                    <input type="date" value="<{$processdatadate[5]}>" id="process-3-date-2" name="process-3-date-2">
                                </div>
                            </div>
                            <div class="col-sm-6 day">
                                <input type="checkbox" value="Aujourd'hui" name="today-3" <{if $processdatadate[5] == "Aujourd'hui"}>checked<{/if}> id="today-3">
                                <label class="day3" for="today-3">Aujourd'hui</label>
                            </div>
                            <{if form_error('process-3-date-1')}>
                                <span class="help-block"><{form_error('process-3-date-1')}></span>
                            <{/if}>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <i class="fa fa-plus plus1 mores"></i>
    </div>


    <div class="motif motif-capacite modif-modif hidden-xs hidden-sm hidden-md">
        <span class="l1"></span>
        <span class="l2"></span>
        <span class="l3"></span>
        <span class="l4"></span>
    </div> 

    <div class="infos offre cityexperience">
        <div class="competences-content">
            <h2>Compétences</h2>
            <div class="<{if form_error('competences')}> has-error<{/if}>">

                <label for="competences">Aptitude</label>

                <input class="form-control" type="competences" value="<{$form['competences']}>" id="competences" name="competences" placeholder="Ajoute tes compétences">

                <{if form_error('competences')}>
                    <span class="help-block"><{form_error('competences')}></span>
                <{/if}>

            </div>  
        </div>
        <span class="removeall"><i class="delete"></i>Supprimer</span>
    </div>

    <h2 class="search-title">Afin d'être visible dans les recherches</h2>

    <div class="fuctions-list secteurs">
        <h2>Secteurs</h2>
        <div class="form-group<{if form_error('functions')}> has-error<{/if}>">

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


    <div class="infos offre cityexperience region">
        <div class="motif motif-profil hidden-xs hidden-sm hidden-md last-motif">
            <span class="l1"></span>
            <span class="l2"></span>
            <span class="l3"></span>
            <span class="l4"></span>
        </div>


        <h2 class="padding-top-title">Statut</h2>
        <div class="form-group<{if form_error('profession_status_id')}> has-error<{/if}>">

            <div class="col-sm-12">
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
    <div class="save">
        <div class='btn-choose link-modif-profil modif-your-profil'>
            <i class="fa fa-file fa-pencil"></i>
            <input type="hidden" name="action" value="submit" />
            <button type="submit" class="btn btn-primary pluspadding">Sauvegarder</button>
        </div>
        <a class="no-lien del-profil" href="<{site_url(array($this->router->fetch_class(), 'delete'))}>" onclick="return confirm('Souhaitez vraiment supprimer votre compte ?');">Supprimer compte</a>
    </div>
    <{include file="_forms_top.tpl"}>
</form>