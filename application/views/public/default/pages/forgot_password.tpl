<{block name="page-title"}>Mot de passe oublié<{/block}>

<{block name="content"}>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="<{current_url()}>" novalidate>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulaire de contact</h4>
                </div>
                <div class="modal-body">
                    <p class="beco-white">
                       Pour contacter <span><{$member->first_name}></span>, complétez le formulaire ci-dessous,
                        un email lui sera envoyé.
                    </p>

                    <div class="form-group<{if form_error('contact_email')}> has-error<{/if}>">
                        <label for="contact_email">Email</label>
                        <div>
                            <input type="email" required name="contact_email" id="contact_email" class="form-control" value="<{$form['contact_email']|default:$this->user->email}>" placeholder="Email"/>
                            <{if form_error('contact_email')}>
                                <span class="help-block"><{form_error('contact_email')}></span>
                            <{/if}>
                        </div>
                    </div>
                    <div class="form-group<{if form_error('contact_message')}> has-error<{/if}>">
                        <label for="contact_message">Votre message</label>
                        <div>
                            <textarea name="contact_message" required id="contact_message" rows="5" class="form-control" placeholder="Message"></textarea>
                            <{if form_error('contact_message')}>
                                <span class="help-block"><{form_error('contact_message')}></span>
                            <{/if}>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="contact_user_id" value="<{$member->user_id}>" />
                                      
                    <button class="send-design" type="submit" name="action" value="contacter" class="btn btn-primary">Envoyer</button>
                      <button class="annul-design" type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>

                </div>
               
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->
<{/block}>