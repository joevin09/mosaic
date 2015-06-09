
<{block name="page-title"}>Résultats<{/block}>

<{block name="content"}>
    <{if !$this->user->agency_name}>
        <{include file="mosaic_users.tpl"}>
    <{else}>
        <{include file="mosaic_agencies.tpl"}>
    <{/if}>
<{/block}>