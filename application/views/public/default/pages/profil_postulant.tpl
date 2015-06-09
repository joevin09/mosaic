
<div class="pres pres-register profil-poeple">
    <{include file="_forms_top.tpl"}>
    <{if $member->user_id == $this->user->user_id}>
        <a class="img-profil" href="<{site_url('profil')}>">
            <img src="<{avatar_url($member->avatar, '150x150')}>" style="width:100%;" alt="<{$member->first_name}> <{$member->last_name}>" />
            <i class="fa fa-pencil"></i>
            <p class="modif-profil-avatar">Modification de profil</p>
        </a>       
    <{else}>
        <div>
            <img src="<{avatar_url($member->avatar, '150x150')}>" style="width:100%;" alt="<{$member->first_name}> <{$member->last_name}>" />
        </div>
    <{/if}>
    <h2><{username($member)}></h2>
    <{if $member->web_statut != ""}><p class="fonction"><{$member->web_statut}></p><{/if}>
    <{if $member->town != ""}><p class="city"><{$member->town}></p><{/if}>

    <{if $member->about != ""}><p class="about"><{$member->about}></p><{/if}>
    <{if $member->website != ""}><a class="website no-lien" target="_blank" href="http://<{$member->website}>"><i class="fa fa-laptop"></i><span><{$member->website}></span></a><{/if}>
            <{*<p class="about">Age: <{$member->birthday}></p>*}>
            <{*<p class="about">Sexe: <{$member->sexe}></p>*}>
    <!-- Button trigger modal -->

    <{if $member->user_id == $this->user->user_id}>
        <a class="contact-me ecra-left" href="<{site_url('mosaic')}>">Voir ma mosaic</a>  
    <{else}>
        <a class="contact-me ecra-left" data-toggle="modal" data-target="#myModal">
            Contact
        </a>
    <{/if}>
    <a class="no-lien email-js" href="mailto:<{$member->email}>"><{$member->email}></a>
    <{if $member->user_id == $this->user->user_id}> 
    <{else}>
        <a class="back no-lien" href="<{return_back('members')}>"><i class="fa fa-long-arrow-left"></i> Retour</a>
    <{/if}> 
</div>
<div class="motif motif-profil hidden-xs hidden-sm hidden-md">
    <span class="l1"></span>
    <span class="l2"></span>
    <span class="l3"></span>
    <span class="l4"></span>
</div> 
<div class="infos formation formation-postulant">
    <{if $member->process}>
        <{assign var=process value="/"|explode:$member->process}>
        <{assign var=process_date value=" "|explode:$member->process_date}>

        <div class="formation-text">
            <h2>Parcours</h2>
            <{$flag = 0}>
            <{foreach from=$process item=pro}>

                <{assign var=process_date_formating1 value="-"|explode:$process_date[$flag]}>

                <p><{$pro}></p>
                <{if ($process_date[$flag+1] != "Aujourd'hui")}>     
                    <{assign var=process_date_formating2 value="-"|explode:$process_date[$flag+1]}>
                    <{if $process_date[$flag] != "" && ($process_date[$flag+1] != "")}><span><{$process_date_formating1[2]}>-<{$process_date_formating1[1]}>-<{$process_date_formating1[0]}> - <{$process_date_formating2[2]}>-<{$process_date_formating2[1]}>-<{$process_date_formating2[0]}></span><{/if}>
                <{else}>
                    <{if $process_date[$flag] != "" && ($process_date[$flag+1] != "")}><span><{$process_date_formating1[2]}>-<{$process_date_formating1[1]}>-<{$process_date_formating1[0]}> - <{$process_date[$flag+1]}></span><{/if}>
                <{/if}>  
                <{$flag = $flag + 2}>
            <{/foreach}>

        </div>
    <{else}>       
        <img src="<{assets('img/img_profile.jpg')}>" alt="Image d'une stylo">
    <{/if}>
</div>
<{if $member->competences != ""}>
    <div class="capacite">
        <h4>Compétences</h4>
        <{assign var=skills value=" "|explode:$member->competences}>
        <ul>
            <{foreach from=$skills item=skill}>
                <{if ($skill != "")}>
                    <li><{$skill}></li>
                    <{/if}>
                <{/foreach}>  
        </ul>
    </div>
<{/if}>
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