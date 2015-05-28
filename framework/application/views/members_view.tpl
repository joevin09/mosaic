<{block name="content"}>
    <div id="avatar">
        <{*<{if ($user['avatar']==true)}>
            <p><img src="<{assets(array('img', $user['avatar']))}>" alt="Avatar du profil"/></p>
        <{else}>
            <p><img src="assets/img/default.png" alt="Avatar par defaut"/></p>
        <{/if}>*}>
    </div>
    <h3><{$user['username']}></h3>
    <p>Age: <{$user['age']}></p>
    <p>Email: <{$user['email']}></p>
    <p>Sexe: <{$user['sexe']}></p>
    <p>A propos de moi: <{$user['about']}></p>
    <a href="<{site_url('members')}>" class="btn btn-primary">Retour à la liste des utilisateurs</a>
<{/block}>