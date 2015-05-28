<form method="post" action="<{current_url()}>" novalidate>
    <h4 class="col-sm-11">Formulaire agence</h4>
    <div class="col-sm-12 form-group<{if form_error('agency_name')}> has-error<{/if}>">
        <label for="agency_name">Nom de l'agence</label>
        <div>
            <input type="text" name="agency_name" placeholder="Nom" id="agency_name" value="<{$form['agency_name']}>" required="required" class="form-control" />
            <{if form_error('agency_name')}>
                <span class="help-block"><{form_error('agency_name')}></span>
            <{/if}>
        </div>
    </div>
    <div class="col-sm-12 form-group<{if form_error('agency_email')}> has-error<{/if}>">
        <label for="agency_email">Adresse email</label>
        <div>
            <input type="email" name="agency_email" placeholder="Email" id="agency_email" value="<{$form['agency_email']}>" required="required" class="form-control" />
            <{if form_error('agency_email')}>
                <span class="help-block"><{form_error('agency_email')}></span>
            <{/if}>
        </div>
    </div>

    <div class="col-sm-12 form-group<{if form_error('agency_passwd')}> has-error<{/if}>">
        <label for="agency_passwd">Mot de passe</label>
        <div>
            <input type="password" name="agency_passwd" placeholder="Mot de passe" id="agency_passwd" value="<{$form['agency_passwd']}>" required="required" class="form-control" />
            <{if form_error('agency_passwd')}>
                <span class="help-block"><{form_error('agency_passwd')}></span>
            <{/if}>
        </div>
    </div>

    <{*<div class="col-sm-12 form-group<{if form_error('nbr_agency')}> has-error<{/if}>">
    <label for="nbr_agency">Nombre de personne dans l'agence</label>
    <div>
    <select>
    <option value="first">1 > 5</option>
    <option value="second">5 > 10</option>
    <option value="third">10 > 20</option>
    <option value="four">20 > 50</option>
    <option value="five">+ 50</option>
    </select>
    <{if form_error('nbr_agency')}>
    <span class="help-block"><{form_error('nbr_agency')}></span>
    <{/if}>
    </div>
    </div>*}>


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
            <input type="hidden" name="action" value="submit_agency" />
            <button type="submit" class="btn btn-primary">Inscription</button>
        </div>
    </div>
    <{if $this->input->post('action') == "submit_agency"}>
        <{include file="_forms_top.tpl"}>
    <{/if}>
    <div class="form-group">
        <p class="col-sm-12 register-connect">Tu as déjà ton profil ? <a href="<{site_url("login")}>">Connecte-toi</a>
    </div>

</form>