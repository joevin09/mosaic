<{block name="content"}>
    <p>Bonjour,</p>
    <p>Une nouvelle transaction a été enregistrée sur salon-aquarelle.be.</p>
    <p>Elle concerne le paiement pour <b><{if $type == "livre-dart"}>Le livre d'art<{else if $type == "inscription"}>l'inscription<{else}> /!\ PAS DE TYPE /!\<{/if}></b>.</p>

    <h2>Informations de la transaction</h2>

    <table style="width:100%;" width="100%">
        <tr><td>Montant</td><td><{$mc_gross}> <{$mc_currency}></td></tr>
        <tr><td>Statut du paiement</td><td><{$payment_status}></td></tr>
        <tr><td>Type de paiement</td><td><{$payment_type}></td></tr>
        <tr><td>Date du paiement</td><td><{$payment_date}></td></tr>
        <tr><td>Redevance pour transfert</td><td><{$mc_fee}></td></tr>
        <tr><td>Quantité</td><td><{$quantity}></td></tr>

        <tr><td colspan="2"><hr /></td></tr>

        <tr><td>Nom</td><td><{$last_name}></td></tr>
        <tr><td>Prénom</td><td><{$first_name}></td></tr>
        <tr><td>Adresse email du payeur</td><td><{$payer_email}></td></tr>

        <tr><td colspan="2"><hr /></td></tr>

        <tr><td>Nom de l'adresse</td><td><{$address_name}></td></tr>
        <tr><td>Rue</td><td><{$address_street}></td></tr>
        <tr><td>Etat / commune</td><td><{$address_state}></td></tr>
        <tr><td>Code postal</td><td><{$address_zip}></td></tr>
        <tr><td>Ville</td><td><{$address_city}></td></tr>
        <tr><td>Code du pays</td><td><{$address_country_code}></td></tr>
        <tr><td>Pays</td><td><{$address_country}></td></tr>
        <tr><td>Pays de résidence</td><td><{$residence_country}></td></tr>
        <tr><td>Statut de l'adresse</td><td><{$address_status}></td></tr>

        <tr><td colspan="2"><hr /></td></tr>

        <tr><td>Eligibilité</td><td><{$protection_eligibility}></td></tr>
        <tr><td>ID payeur</td><td><{$payer_id}></td></tr>
        <tr><td>Taxes</td><td><{$tax}></td></tr>
        <tr><td>Staut du payeur</td><td><{$payer_status}></td></tr>
        <tr><td>Adresse email du receveur</td><td><{$business}></td></tr>
        <tr><td>Redevance du paiement</td><td><{$payment_fee}></td></tr>
        <tr><td>Transaction IPN ID</td><td><{$ipn_track_id}></td></tr>
        <tr>
            <td>Référence base de données</td>
            <td>
                <{if $type == "livre-dart"}>
                    ORDER_ID : <{$order_id}>
                <{else if $type == "inscription"}>
                    USER_ID : <{$user_id}>
                <{else}>
                    /!\ PAS DE TYPE /!\
                <{/if}>
            </td>
        </tr>
    </table>

<{/block}>