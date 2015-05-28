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
        Nous accusons bonne réception de votre paiement pour le Livre d'Art 2013.
    </p>
    <p>
        Nous vous ferons parvenir votre commande dans les plus bref délais. Vous trouverez un récapitulatif de celle-ci ci-dessous.
    </p>
    <h2>Votre commande</h2>
    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th>Descriptions</th>
            <th>Montant</th>
        </tr>
        <tr>
            <td>
                <p><b><i>Livre d'Art 2013</i></b></p>
                <p>Numéro d'objet : <{base64_encode($user->order_id)}></p>
                <p>Prix de l'objet : €<{num_format($user->amount)}></p>
                <p>Quantité : <{$user->quantity}></p>
            </td>
            <td align="right">
                €<{num_format($user->amount * $user->quantity)}>
            </td>
        </tr>
        <tr>
            <td colspan="2"><hr /></td>
        </tr>
        <tr>
            <td><b>Total objet</b></td>
            <td align="right"><b>€<{num_format($user->amount * $user->quantity)}></b></td>
        </tr>
        <tr>
            <td>Livraison et traitement : </td>
            <td align="right"><b>€<{num_format($user->shipping + (($user->quantity - 1) * $user->shipping2))}></b></td>
        </tr>
        <tr>
            <td colspan="2"><hr /></td>
        </tr>
        <tr>
            <th colspan="2" align="right">
               Total €<{num_format(($user->amount * $user->quantity) + ($user->shipping + (($user->quantity - 1) * $user->shipping2)))}>
            </th>
        </tr>
    </table>
    
    <p>Cordialement,</p>
    <p>L'équipe de la 14e Biennale Internationale de l'Aquarelle.</p>
<{/block}>