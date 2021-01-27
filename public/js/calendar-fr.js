/* Calendars management */

jQuery(document).ready(function($) {

    $( "#date_start, #date_end" ).datepicker({
        altField: "#datepicker",
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        weekHeader: 'Sem.',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        onSelect: function(dateText, inst) {
            $(this).focus();
            $(this).blur();
        },
        beforeShow: function(input) {
            if (input.id == 'date_end') {
                var date_debut = $('#date_start').val();
                var pattern = /(\d{2})\/(\d{2})\/(\d{4})/;
                if(!date_debut) {
                    return {
                        minDate: 0
                    }
                }
                var minDate = new Date(date_debut.replace(pattern,'$3-$2-$1'));
                minDate.setDate(minDate.getDate())
                return {
                    minDate: minDate
                };
            }
            return {
                minDate: 0
            }
        },
        onSelect: function(value, input) {
            if (input.id == 'date_start') {
              $('#date_end').val('');
            }
        }
    });

    $('.fa-calendar-alt, .fa-map-marker-alt').click(function() {
        $(this).prevAll('input').focus();
    });
});
