<{block name="content"}>
    <h1>Bootstrap starter template</h1>
    <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
    <p>Constantes dans Smarty : <{$smarty.const.BASE_URL}></p>
    <p>router_class : <{$smarty.get.router_class}></p>
    <p>post : <{$smarty.post.variable}></p>
    <p>router_class écriture PHP : <{$smarty['get']['router_class']}></p>
    <p>orienté objet: <{$user->username}></p>
<{/block}>