<{block name="content"}>
    <div class="page-header">
        <h1>Liste des membres</h1>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>Username</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <{foreach from=$users key="k" item="v" name="users"}>
                <tr>
                    <td><{$smarty.foreach.users.iteration}></td>
                    <td><{$v['username']}></td>
                    <td><{$v['email']}></td>
                    <td>
                        <a href="<{site_url('members/view/'|cat:$v['id'])}>">voir le profil</a>
                    </td>
                </tr>
            <{/foreach}>
        </tbody>
    </table>
<{/block}>