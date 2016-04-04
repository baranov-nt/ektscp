function educationNewForm(value) {
    /* Среднее и начальное */
    if(value == 490) {
        $( "#schoolForm" ).show();
        $( "#techForm" ).hide();
        $( "#hihgForm" ).hide();
    }
    /* Средне-специальное */
    if(value == 11) {
        $( "#schoolForm" ).hide();
        $( "#techForm" ).show();
        $( "#hihgForm" ).hide();
    }
    /* ВУЗ */
    if(value == 12 || value == 438) {
        $( "#schoolForm" ).hide();
        $( "#techForm" ).hide();
        $( "#hihgForm" ).show();
    }
    $( "#useEveryWhere" ).show();
}