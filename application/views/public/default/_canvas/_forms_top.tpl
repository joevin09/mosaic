<{if $this->session->flashdata('msg')}>
    <div class="alert alert-<{$this->session->flashdata('msg_type')}>">
        <{$this->session->flashdata('msg')}>
    </div>
<{else if validation_errors()}>
    <div class="alert">
        Une erreur est survenue, veuillez vérifier le formulaire.
    </div>
<{/if}>