<{block name="header"}>
    <{include file="header.tpl"}>
<{/block}>

<{include file="primary-navbar.tpl"}>

<main class="container" id="wrapper">
    <{if $this->router->fetch_class() != "home"}>
        <div class="page-header"><h1><{block name="page-title"}>Pas de H1<{/block}></h1></div>
    <{/if}>
    
    <{block name="content"}>
    <{/block}>
</main>

<{block name="footer"}>
    <{include file="footer.tpl"}>
<{/block}>