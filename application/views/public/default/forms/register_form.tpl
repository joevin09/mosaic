<form method="post" action="<{current_url()}>" novalidate>


    <h4 class="col-sm-8">Formulaire postulant</h4>
    <div class="col-sm-6 <{if form_error('last_name')}> has-error<{/if}>">
        <label for="last_name">Nom</label>
        <div>
            <input type="text" name="last_name" placeholder="Nom" id="last_name" value="<{$form['last_name']}>" required="required" class="form-control" />
            <{if form_error('last_name')}>
                <span class="help-block"><{form_error('last_name')}></span>
            <{/if}>
        </div>
    </div>

    <div class="col-sm-6<{if form_error('first_name')}> has-error<{/if}>">
        <label for="first_name">Prénom</label>
        <div>
            <input type="text" name="first_name" placeholder="Prénom" id="first_name" value="<{$form['first_name']}>" required="required" class="form-control" />
            <{if form_error('first_name')}>
                <span class="help-block"><{form_error('first_name')}></span>
            <{/if}>
        </div>
    </div>

    <div class="col-sm-12 form-group<{if form_error('email')}> has-error<{/if}>">
        <label for="email">Adresse email</label>
        <div>
            <input type="email" name="email" placeholder="Email" id="email" value="<{$form['email']}>" required="required" class="form-control" />
            <{if form_error('email')}>
                <span class="help-block"><{form_error('email')}></span>
            <{/if}>
        </div>
    </div>

    <div class="col-sm-12 form-group<{if form_error('passwd')}> has-error<{/if}>">
        <label for="passwd">Mot de passe</label>
        <div>
            <input type="password" name="passwd" placeholder="Mot de passe" id="passwd" value="<{$form['passwd']}>" required="required" class="form-control" />
            <{if form_error('passwd')}>
                <span class="help-block"><{form_error('passwd')}></span>
            <{/if}>
        </div>
    </div>

    <{*<div class="select col-sm-12 form-group<{if form_error('Date_Year') || form_error('Date_Month') || form_error('Date_Day')}> has-error<{/if}>">
    <label for="birthday">Naissance</label>
    <div>
    <{html_select_date time=$form['birthday'] start_year=$this->birthday_start_year end_year=(date('Y')-100) field_order="DMY"}>
    <{if form_error('Date_Year') || form_error('Date_Month') || form_error('Date_Day')}>
    <span class="help-block"><{form_error('Date_Year')}></span>
    <{/if}>
    </div>
    </div>*}>

    <div class="hidden form-group<{if form_error('sexe')}> has-error<{/if}>">
        <label for="sexe">Sexe</label>
        <div>
            <div class="radio">
                <label>
                    <input type="radio" name="sexe" id="sexe_m" value="Masculin"<{if $form['sexe'] === "Masculin"}> checked="checked"<{/if}> />
                    Homme
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="sexe" id="sexe_f" value="Féminin"<{if $form['sexe'] === "Féminin"}> checked="checked"<{/if}> />
                    Femme
                </label>
            </div>
            <{if form_error('sexe')}>
                <span class="help-block"><{form_error('sexe')}></span>
            <{/if}>
        </div>
    </div>

    <div class="hidden form-group<{if form_error('g-recaptcha-response')}> has-error<{/if}>">
        <div>
            <div class="g-recaptcha" data-sitekey="6LfgBAUTAAAAAJhvPPo6a4iaBzH0capLMX2_CAqm"></div>
            <{if form_error('g-recaptcha-response')}>
                <span class="help-block"><{form_error('g-recaptcha-response')}></span>
            <{/if}>
        </div>
    </div>
    <div class="col-sm-12 form-group">
        <div>
            <input type="hidden" name="action" value="submit" />
            <button type="submit" class="btn btn-primary">Inscription</button>
        </div>
    </div>
    <{if $this->input->post('action') == "submit"}>
        <{include file="_forms_top.tpl"}>
    <{/if}>
    <div class="form-group">
        <p class="col-sm-12 register-connect">Tu as déjà ton profil ? <a href="<{site_url("login")}>">Connecte-toi</a>
    </div>

</form>