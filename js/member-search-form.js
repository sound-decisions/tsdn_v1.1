// This function is called when the reset button is clicked.
function reset_form_values() {

    //alert('reset_form_values');
    
    if (document.forms.search_members) {
        var f = document.forms.search_members;  
        f.starts_with_hidden.value = '';
        f.starts_with_not_set.checked = true;
        f.name_search.value = '';
        f.status_search.selectedIndex = 0;
        f.access_search.selectedIndex = 0;
    }    

    return false;
    
} // end of - reset_form_values