<{block name="page-title"}>Modification de profil<{/block}>
<{block name="content"}>
    <{if $this->user->agency_name}>
        <{include file="form_profil_agency.tpl"}>
    <{else}>
        <{include file="form_profil_postulant.tpl"}>
    <{/if}>
<{/block}>