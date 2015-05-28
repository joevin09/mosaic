<{block name="content"}>
<p>Bonjour <{$user->first_name}> <{$user->last_name}>,</p>
<p>Un compte a été créé pour vous sur <i><{$this->config->item('site_name')}></i> !</p>
<p>
    Pour vous connecter, rendez-vous sur 
    <a href="<{site_url('', FALSE)}>" target="_blank" style="color: <{$color1}>;"><{site_url('', FALSE)}></a><br />
    et saisissez les identifiants suivants :
</p>
<table border="0">
    <tr>
        <td width="200">
            <b>Adresse e-mail </b>
        </td>
        <td>
            <{$user->email}>
        </td>
    </tr>
    <tr>
        <td>
            <b>Mot de passe </b>
        </td>
        <td>
            <{$user->passwd}>
        </td>
    </tr>
</table>
<p>Cordialement,</p>
<p>L'équipe du <{$this->config->item('site_name')}></p>
<{/block}>