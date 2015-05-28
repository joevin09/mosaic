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

        <div class="form-group<{if form_error('email')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="email">Email :</label>
            <div class="col-sm-8 change-profil">
                <input type="email" name="email" id="email" value="<{$form['email']}>" required="required" class="form-control" />
                <{if form_error('email')}>
                    <span class="help-block"><{form_error('email')}></span>
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
    </div>

    <div class="form-group<{if form_error('nbr_member')}> has-error<{/if}>">
        <label class="control-label col-sm-4" for="nbr_member">Membre</label>
        <div class="col-sm-8">
            <select name="nbr_member" id="nbr_member">
                <option selected disabled value="">Nombre :</option>
                <option value="1-10"<{if $form['nbr_member'] == "1-10"}> selected="selected"<{/if}>>< 10</option>
                <option value="11-20"<{if $form['nbr_member'] == "11-20"}> selected="selected"<{/if}>>11-20</option>
                <option value="21"<{if $form['nbr_member'] == "21"}> selected="selected"<{/if}>>> 21</option>
            </select>
            <input id="nbr_member" type="text" name="nbr_member" value="<{$form['nbr_member']}>" />

            <{if form_error('nbr_member')}>
                <span class="help-block"><{form_error('nbr_member')}></span>
            <{/if}>
        </div>
    </div>

    <div class="motif motif-profil hidden-xs hidden-sm hidden-md">
        <span class="l1"></span>
        <span class="l2"></span>
        <span class="l3"></span>
        <span class="l4"></span>
    </div>

    <div class="fuctions-list">

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
    <a href="<{site_url('delete')}>" onclick="return confirm('Souhaitez vraiment supprimer votre compte ?');" class="btn btn-danger">Supprimer compte</a>
</div>
</form>