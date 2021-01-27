/* Calendars management */

jQuery(document).ready(function($) {

    $( "#date_start, #date_end" ).datepicker({

        altField: "#datepicker",
        closeText: 'Close',
        prevText: 'Previous',
        nextText: 'Next',
        currentText: 'Today',
        monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
        weekHeader: 'Sem.',
        dateFormat: 'mm/dd/yy',
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
                var minDate = new Date(date_debut.replace(pattern,'$3-$1-$2'));
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
