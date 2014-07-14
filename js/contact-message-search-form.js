// This function is called when the reset button is clicked.
function reset_form_values() {

    //alert('reset_form_values');
    
    if (document.forms.search_contact_messages) {
        var f = document.forms.search_contact_messages;  
        f.name_search.value = '';
        f.message_search.value = '';
        f.notes_search.value = '';
        f.status_search.selectedIndex = 0;
    }    

    return false;
    
} // end of - reset_form_values