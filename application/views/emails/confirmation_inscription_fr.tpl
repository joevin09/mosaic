<{block name="content"}>
    <p> 
        <{if $user->title == "madame"}>
            Chère Madame
        <{elseif $user->title == "mademoiselle"}>
            Chère Mademoiselle
        <{else}>
            Cher Monsieur
        <{/if}>
        <{$user->last_name}>,
    </p>

    <p>
        Merci pour votre inscription à la 14e Biennale Internationale de l'Aquarelle.
    </p>
    <p>
        Voici un rappel des identifiants qui vous permettront d'ajouter, en ligne via notre site web, les oeuvres que vous aurez choisi de présenter au jury.
    </p>
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%;">
        <tr>
            <td width="250" style="width:250px;"><b>Pseudo</b></td>
            <td><{$user->pseudo}></td>
        </tr>
        <tr>
            <td width="250" style="width:250px;"><b>Mot de passe</b></td>
            <td><{$user->passwd}></td>
        </tr>
    </table>

    <hr />

    <p>
        <b>Pour vous connecter</b>, vous pouvez entrer ces identifiants à la page suivante :<br />
        <a href="<{get_permalink(config_item('connection_page_id'), $user->lang_id)}>"><{get_permalink(config_item('connection_page_id'), $user->lang_id)}></a>
    </p>

    <hr />

    <p>
        <b><center>OU</center></b>
    </p>

    <hr />

    <p>
        cliquez simplement sur le lien suivant et et le connexion se fera de façon automatique :<br />
        <a href="<{get_permalink(config_item('connection_page_id'), $user->lang_id)}>?l=<{$user->auto_login}>"><{get_permalink(config_item('connection_page_id'), $user->lang_id)}>?l=<{$user->auto_login}></a>
    </p>

    <p>Cordialement,</p>
    <p>L'équipe de la 14e Biennale Internationale de l'Aquarelle.</p>
<{/block}>