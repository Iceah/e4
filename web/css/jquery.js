$(function () {
    // Document.ready -> link up remove event handler

    $('button[id=btnDeleteModule]').bind('click', RemoveClick);

    function RemoveClick() {
        // Récupération de la ligne en cours
        var oTR = $(this).parent().parent();
        // Récupération de l'id du module
        var idModule = oTR.attr("id");
        // Récupération du titre
        var oTitre = oTR.find("#nomMat");

        if (idModule != '' && confirm("Voulez-vous supprimer le module '" + oTitre.html() + "' ? "))
        {
            oTitre.html("</b><i class='fa fa-spinner fa-spin'></i><b>Suppression en cours ...</b>");

            // CSS pour suppression
            oTR.attr('class','tr_removed');
            // Le bouton est grisé ...
            $(this).attr("disabled", true);
            // Le bouton Edit est aussi grisé
            var btnEdit = oTR.find("#btnEditModule");
            btnEdit.attr("disabled", true);

            $.ajax({
                url: "delete",
                type: "post",
                data: { "id": idModule },
                success: function(data){
                    var oTR = $('#' + data.id);
                    if (data.status == 0) {
                        oTR.fadeOut('slow');
                        $('#update-message').attr("class", 'label label-success');
                    }
                    else {
                        $('#update-message').attr("class", 'label label-important');
                        // On remet les valeurs de départ
                        // CSS pour suppression
                        oTR.attr('class','');
                        // Le bouton n'est pas grisé ...
                        $(this).attr("disabled", false);
                        // Le bouton Edit n'est plus grisé
                        var btnEdit = oTR.find("#btnEditModule");
                        btnEdit.attr("disabled", false);
                    }
                    $('#update-message').text(data.message);
                    $('#update-message').show('slow', null).delay(6000).hide('slow');
                },
                error:function(){
                    alert("Erreur d'accès à la méthode de suppression");
                }
            });
        }
