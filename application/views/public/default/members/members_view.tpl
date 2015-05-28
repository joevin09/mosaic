<{block name="page-title"}>Profil de <{username($member)}><{/block}>

<{block name="content"}>
    <{if $member->agency_name != ""}>
        <{include file="profil_agency.tpl"}>
    <{else}>
        <{include file="profil_postulant.tpl"}>
    <{/if}>
<{/block}>