<?php

if (!function_exists('upload_error_message')) {

    function upload_error_message($id) {
        $upload_errors = array(
            _("Aucune erreur, le téléchargement est correct."),
            sprintf(_("Le fichier téléchargé excède la taille de %smb."), getMaxFileSize()),
            _("Le fichier téléchargé excède la taille de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML."),
            _("Le fichier n'a été que partiellement téléchargé."),
            _("Aucun fichier n'a été téléchargé."),
            "",
            _("Un dossier temporaire est manquant."),
            _("Échec de l'écriture du fichier sur le disque."),
            _("Une extension PHP a arrêté l'envoi de fichier. PHP ne propose aucun moyen de déterminer quelle extension est en cause. L'examen du phpinfo() peut aider."),
        );
        return $upload_errors[$id];
    }

}
