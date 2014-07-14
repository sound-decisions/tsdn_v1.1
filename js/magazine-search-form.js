// This function is called when the reset button is clicked.
function reset_form_values() {

    //alert('reset_form_values');
    
    if (document.forms.search_magazines) {
        var f = document.forms.search_magazines;  
        f.publication_id.selectedIndex = 0;
    }    

    return false;
    
} // end of - reset_form_values