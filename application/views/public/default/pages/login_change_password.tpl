<{block name="content"}>
    <form method="post" action="<{current_url()}>" class="form-horizontal">
        <div class="form-group<{if form_error('email')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="email">Adresse email</label>
            <div class="col-sm-8">
                <input type="email" name="email" id="email" value="<{$form['email']}>" required="required" class="form-control" />
                <{if form_error('email')}>
                    <span class="help-block"><{form_error('email')}></span>
                <{/if}>
            </div>
        </div>
        <div class="form-group<{if form_error('change_passwd_code')}> has-error<{/if}>">
            <label class="control-label col-sm-4" for="change_passwd_code">CODE</label>
            <div class="col-sm-8">
                <input type="text" name="change_passwd_code" id="change_passwd_code" value="<{$form['change_passwd_code']}>" required="required" class="form-control" />
                <{if form_error('change_passwd_code')}>
                    <span class="help-block"><{form_error('change_passwd_code')}></span>
                <{/if}>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-4">
                <input type="hidden" name="action" value="submit" />
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </div>
    </form>
<{/block}>