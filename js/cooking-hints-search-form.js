// This function is called when the reset button is clicked.
function reset_form_values() {

    //alert('reset_form_values');
    
    if (document.forms.search_cooking_hints) {
        var f = document.forms.search_cooking_hints;  
        f.title_search.value = '';
    }    

    return false;
    
} // end of - reset_form_values