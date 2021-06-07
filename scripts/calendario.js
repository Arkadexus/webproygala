var x = window.matchMedia("(max-width: 767px)")
if(x.matches){
    months = 1;
}else{
    months = 2;
}
$(".datepicker").datepicker({
    minDate: 0,
    numberOfMonths: months,
    beforeShowDay: function(date) {
        var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#input1").val());
        var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#input2").val());
        return [true, date1 && ((date.getTime() == date1.getTime()) || (date2 && date >= date1 && date <= date2)) ? "dp-highlight" : ""];
    },
    onSelect: function(dateText, inst) {
        var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#input1").val());
        var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#input2").val());
        var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);

        
        if (!date1 || date2) {
            $("#input1").val(dateText);
            $("#input2").val("");
            $(this).datepicker();
        } else if( selectedDate < date1 ) {
            $("#input2").val( $("#input1").val() );
            $("#input1").val( dateText );
            $(this).datepicker();
        } else {
            $("#input2").val(dateText);
            $(this).datepicker();
        }
    }
});