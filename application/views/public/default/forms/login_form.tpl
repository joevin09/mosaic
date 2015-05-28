<form method="post" action="<{current_url()}>" novalidate>
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
    <div class="form-group">
        <div class="col-sm-12">
            <input type="hidden" name="action" value="submit" />
            <button type="submit" class="btn btn-primary">Connexion</button>
        </div>
    </div>
         <{include file="_forms_top.tpl"}>
    <div class="form-group">
            <a class="forgot col-sm-12" href="<{site_url("forgot_password_form")}>">Mot de passe oublié ?</a>
            <p class="col-sm-12 register-connect">Tu n'as toujours pas de mosaic ? <a href="<{site_url("register")}>">Inscription-toi</a>
    </div>
   
</form>