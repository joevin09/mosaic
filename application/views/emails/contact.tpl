<{block name="content"}>
    <p>Bonjour,</p>
    <p>Vous venez de recevoir une nouvelle demande de contact de <i><b><{$first_name}> <{strtoupper($last_name)}></b></i>.</p>
    <p>Vous pouvez soit utiliser la fonction "Répondre" à cet email, soit reprendre son adresse email : <a href="mailto:<{$email}>"><{$email}></a> .</p>
    <p>Voici son message :</p>
    <blockquote style="border-left: 10px solid #CCC;padding-left:20px;margin-left:40px;"><{nl2br($message)}></blockquote>
<{/block}>