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
        Nous accusons bonne réception de votre paiement. Votre inscription est désormais complète.
    </p>
    <p>
        N'oubliez pas que pour que votre participation soit valide, il vous faut nous faire parvenir <b>entre 5 et 10 oeuvres</b>.
        Vous pouvez le faire soit via courrier, soit via notre site web en utilisant les informations fournies lors de votre inscription.
    </p>
    <p>Vous trouverez un rappel de ces informations ci-dessous.</p>
    
    <hr />
    
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