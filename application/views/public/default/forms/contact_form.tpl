<form method="post" action="<{current_url()}>" novalidate>
    <div class="col-sm-6 form-group<{if form_error('last_name')}> has-error<{/if}>">
        <label for="last_name">Nom</label>
        <div>
            <input type="text" name="last_name" placeholder="Nom" id="last_name" value="<{$form['last_name']}>" required="required" class="form-control" />
            <{if form_error('last_name')}>
                <span class="help-block"><{form_error('last_name')}></span>
            <{/if}>
        </div>
    </div>

    <div class="col-sm-6 form-group<{if form_error('first_name')}> has-error<{/if}>">
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
    <div class="col-sm-12 form-group<{if form_error('message')}> has-error<{/if}>">
        <label for="message">Message</label>
        <div>
            <textarea rows="4" name="message" placeholder="Message" id="message" value="<{$form['message']}>" required="required" class="form-control"></textarea>
            <{if form_error('message')}>
                <span class="help-block"><{form_error('message')}></span>
            <{/if}>
        </div>
    </div>

        <div class="col-sm-12 form-group">
            <input type="hidden" name="action" value="submit" />
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
            <{include file="_forms_top.tpl"}>
</form>