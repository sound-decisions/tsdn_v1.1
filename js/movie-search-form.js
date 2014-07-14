// This function is called when the reset button is clicked.
function reset_form_values() {

    //alert('reset_form_values');
    
    if (document.forms.search_movies) {
        var f = document.forms.search_movies;  
        f.starts_with_hidden.value = '';
        f.starts_with_not_set.checked = true;
        f.title_search.value = '';
        f.genre_search.selectedIndex = 0;
        f.mpaa_rating_search.selectedIndex = 0;
        f.year_released_search.value = '';
        f.persons_name_search.value = '';
    }    

    return false;
    
} // end of - reset_form_values