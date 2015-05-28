<{include file="_forms_top.tpl"}>
<div class="pres pres-register profil-poeple">
    <{if $member->user_id == $this->user->user_id}>
        <a class="img-profil" href="<{site_url('profil')}>">
            <img src="<{avatar_url($member->avatar, '150x150')}>" style="width:100%;" alt="<{$member->first_name}> <{$member->last_name}>" />
            <i class="fa fa-pencil"></i>
        </a>
    <{else}>
        <div class="img-profil">
            <img src="<{avatar_url($member->avatar, '150x150')}>" style="width:100%;" alt="<{$member->first_name}> <{$member->last_name}>" />
            <i class="fa fa-pencil"></i>
        </div>
    <{/if}>
    <h2><{username($member)}></h2>
    <p class="city"><{$member->town}></p>
    <p class="fonction"><{$member->web_statut}></p>
    <a class="website no-lien" target="_blank" href="http://www.<{$member->website}>"><{$member->website}></a>
    <p class="about"><{$member->about}></p>
    <{*<p class="about">Age: <{$member->birthday}></p>*}>
    <{*<p class="about">Sexe: <{$member->sexe}></p>*}>
    <!-- Button trigger modal -->

    <{if $member->user_id == $this->user->user_id}>
        <a class="contact-me" href="<{site_url('mosaic')}>">Voir ma mosaic</a>  
    <{else}>
        <a class="contact-me" data-toggle="modal" data-target="#myModal">
            Contact
        </a>
    <{/if}>
    <{if $member->user_id == $this->user->user_id}> 
    <{else}>
        <a class="back no-lien" href="<{return_back('members')}>"><i class="fa fa-long-arrow-left"></i> Retour à la recherche</a>
    <{/if}> 
</div>
<div class="motif motif-profil hidden-xs hidden-sm hidden-md">
    <span class="l1"></span>
    <span class="l2"></span>
    <span class="l3"></span>
    <span class="l4"></span>
</div> 
<div class="infos formation gmpas-content">
    <img src="<{assets('img/img_profile.jpg')}>" alt="Image d'une stylo">
    <div id="map-canvas" class="gmpas" style="height:300px">
        <!-- Generated with JS -->
    </div>
</div>
<div class="btn-choose link-modif-profil">
    <{if $member->user_id == $this->user->user_id}>
        <i class="fa fa-pencil"></i>
        <a href="<{site_url('profil')}>" >Modifier mon profil</a>       
    <{/if}>
</div>

<{assign var=offer value="/"|explode:$member->offer}>
<{assign var=offer_url value="+"|explode:$member->offer_url}>

<div class="my_offre">
    <div class="infos offre">
        <{if ($offer[0] != "")}>
            <h2>Offres</h2>
            <{$flag = 0}>
            <{foreach from=$offer item=pro}>
                <p><{$pro}></p>
                <span><a href="<{$offer_url[$flag]}>"><{$offer_url[$flag]}></a></span>
            <{/foreach}>
        <{else}>
            <{if $member->user_id == $this->user->user_id}>
                <p>Vous n'avez encore d'offre. <a href="http://m-saic.be/profil/">Ajoutez une offre maintenant</a></p>
            <{else}>
                <p><{$member->agency_name}> n'a pas encore d'offre.</p>
            <{/if}>
        <{/if}>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="<{current_url()}>" novalidate>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulaire de contact</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Pour contacter <strong><{$member->first_name}></strong>, complétez le formulaire ci-dessous,
                        un email sera envoyé dans sa boîte email personnelle.
                    </p>
                    <div class="form-group">
                        <label for="contact_email">
                            Email
                        </label>
                        <div>
                            <input type="email" required name="contact_email" id="contact_email" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact_message">
                            Votre message
                        </label>
                        <div>
                            <textarea name="contact_message" required id="contact_message" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="contact_user_id" value="<{$member->user_id}>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" name="action" value="contacter" class="btn btn-primary">Envoyer</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->