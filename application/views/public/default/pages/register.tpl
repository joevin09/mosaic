<{block name="page-title"}>Inscription<{/block}>
<{block name="content"}>
    <div class="pres pres-register">
        <h2 class="agency_h2">Inscription</h2>
        <h3>Toi aussi,<br /> tu veux faire partie de<br /> la <span>mosaic</span>.</h3>
        <p>Enregistre ton profil en temps que postulant<br/> ou agence.</p>
            <{if !$this->input->get('register_mode')}>
            <div class="btn-choose">
                <a class="btn-postulant btn-register<{if !$this->input->post('action') || $this->input->post('action') == "submit"}> active<{/if}>" data-value="form_postulant"><i class="fa fa-user fa-2x"></i>Postulant</a>      
                <a class="btn-agency btn-register<{if $this->input->post('action') == "submit_agency" || $this->input->get('agency')}> active<{/if}>" data-value="form_agency"><i class="fa fa-users fa-2x"></i>Agence</a>          
            </div>
        <{/if}>
    </div>
    <div class="motif motif-register hidden-xs hidden-sm hidden-md">
        <span class="l1"></span>
        <span class="l2"></span>
        <span class="l3"></span>
        <span class="l4"></span>
    </div> 
    <{if $this->input->get('register_mode') != ""}>
        <{if $this->input->get('register_mode') == "user"}>
            <div class="form form-register<{if (!$this->input->post('action') || $this->input->post('action') == "submit") && !$this->input->get('agency')}> active<{/if}>" id="form_postulant">
                <{include file="register_form.tpl"}>
            </div>
        <{else}>
            <div class="form form-register<{if $this->input->post('action') == "submit_agency" || $this->input->get('register_mode') === "agency"}> active<{/if}>" id="form_agency">
                <{include file="register_agencies_form.tpl"}>
            </div>
        <{/if}>
        
        <{else}>
            <div class="form form-register<{if (!$this->input->post('action') || $this->input->post('action') == "submit") && !$this->input->get('agency')}> active<{/if}>" id="form_postulant">
                <{include file="register_form.tpl"}>
            </div>
            <div class="form form-register<{if $this->input->post('action') == "submit_agency" || $this->input->get('register_mode') === "agency"}> active<{/if}>" id="form_agency">
                <{include file="register_agencies_form.tpl"}>
            </div>
    <{/if}>

<{/block}>