<{assign var="email_temp" value=$smarty.get.e|base64_decode}>

<form method="post" action="<{current_url()}>" novalidate>
    <div class="form-group">
        <div class="col-sm-12<{if form_error('email')}> has-error<{/if}>">
            <label for="email">Adresse email</label>
            <div>
                <input type="email" name="email" placeholder="Email" id="email" value="<{if ($email_temp != "")}><{$email_temp}><{else}><{$form['email']}><{/if}>" required="required" class="form-control" />
                <{if form_error('email')}>
                    <span class="help-block"><{form_error('email')}></span>
                <{/if}>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12<{if form_error('passwd')}> has-error<{/if}>">
            <label for="passwd">Mot de passe</label>
            <div>
                <input type="password" name="passwd" placeholder="Mot de passe" id="passwd" value="<{$form['passwd']}>" required="required" class="form-control" />
                <{if form_error('passwd')}>
                    <span class="help-block"><{form_error('passwd')}></span>
                <{/if}>
            </div>
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
        <a class="forgot col-sm-12" data-toggle="modal" data-target="#myModal">Mot de passe oublié ?</a>
        <p class="col-sm-12 register-connect">Tu n'as toujours pas de mosaic ? <a href="<{site_url("register")}>">Inscription-toi</a>
    </div>
    <div class="modal fade log" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form method="post" action="<{current_url()}>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="forgot-title modal-title">Mot de passe oublié</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group<{if form_error('email-forgot')}> has-error<{/if}>">
                            <label class="control-label" for="email-forgot">Adresse email</label>
                            <div>
                                <input type="email" name="email-forgot" id="email-forgot" value="<{$form['email-forgot']}>" required="required" class="form-control" placeholder="Email"/>
                                <{if form_error('email-forgot')}>
                                    <span class="help-block"><{form_error('email-forgot')}></span>
                                <{/if}>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="hidden" name="contact_user_id" value="<{$member->user_id}>" />

                            <button class="send-design" type="submit" name="action" value="forgot" class="btn btn-primary">Envoyer</button>
                            <button class="annul-design" type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>

                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div><!-- /.modal -->
</form>