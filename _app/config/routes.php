<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/



// Start of Website Routing.
$route['websites/i-want-to-be-a-loser'] = 'websites/i_want_to_be_a_loser';
$route['websites/my-movie-collection'] = 'websites/my_movie_collection';
$route['websites/nfl-football-pool'] = 'websites/nfl_football_pool';
$route['websites/the-link-vault'] = 'websites/the_link_vault';
$route['websites/about'] = 'websites/about';

$route['member-movies/test'] = 'movies/test';

$route['member-movies/edit-rating/(:any)'] = 'member_movies/edit_rating/$1';
$route['member-movies/edit/(:any)'] = 'member_movies/edit/$1';

$route['member-movies/toggle-on-watch-list/(:any)'] = 'member_movies/toggle_on_watch_list/$1';
$route['member-movies/toggle-seen-it/(:any)'] = 'member_movies/toggle_seen_it/$1';
$route['member-movies/toggle-in-720/(:any)'] = 'member_movies/toggle_in_720/$1';
$route['member-movies/toggle-in-1080/(:any)'] = 'member_movies/toggle_in_1080/$1';
$route['member-movies/toggle-in-3d/(:any)'] = 'member_movies/toggle_in_3d/$1';

$route['movies/toggle-featured/(:any)'] = 'movies/toggle_featured/$1';

$route['movies/imdb-movie-create/(:any)'] = 'movies/imdb_movie_create/(:any)';
$route['movies/imdb/(:any)'] = 'movies/imdb/$1';
$route['movies/imdb-search'] = 'movies/imdb_search';

$route['movies/add'] = 'movies/add';
$route['movies/admin-search-results'] = 'movies/admin_search_results';
$route['movies/admin-search'] = 'movies/admin_search';
$route['movies/admin-list'] = 'movies/admin_list';

$route['movies/my-watch-list'] = 'movies/my_watch_list';
$route['movies/featured-movies'] = 'movies/featured_movies';
$route['movies/delete/(:any)'] = 'movies/delete/$1';
$route['movies/edit/(:any)'] = 'movies/edit/$1';
$route['movies/view/(:any)'] = 'movies/view/$1';
$route['movies/get-search-results/(:any)'] = 'movies/search_results/$1';
$route['movies/search-results'] = 'movies/search_results';
$route['movies/search'] = 'movies/search';
$route['movies/about'] = 'movies/about';
$route['movies'] = 'movies';


$route['cooking_hints/delete/(:any)'] = 'cooking_hints/delete/$1';
$route['cooking_hints/edit/(:any)'] = 'cooking_hints/edit/$1';
$route['cooking_hints/add'] = 'cooking_hints/add';
$route['cooking_hints/search-results'] = 'cooking_hints/search_results';
$route['cooking_hints'] = 'cooking_hints';

$route['recipe_notes/delete/(:any)'] = 'recipe_notes/delete/$1';
$route['recipe_notes/edit/(:any)'] = 'recipe_notes/edit/$1';
$route['recipe_notes/add/(:any)'] = 'recipe_notes/add/$1';
$route['recipe_notes/add'] = 'recipe_notes/add';

$route['recipe_comments/delete/(:any)'] = 'recipe_comments/delete/$1';
$route['recipe_comments/edit/(:any)'] = 'recipe_comments/edit/$1';
$route['recipe_comments/add'] = 'recipe_comments/add';

$route['recipe_categories/select'] = 'recipe_categories/select';
$route['recipe_categories/delete/(:any)'] = 'recipe_categories/delete/$1';
$route['recipe_categories/edit/(:any)'] = 'recipe_categories/edit/$1';
$route['recipe_categories/view/(:any)'] = 'recipe_categories/view/$1';
$route['recipe_categories/add'] = 'recipe_categories/add';
$route['recipe_categories'] = 'recipe_categories';


// New Version with '-' hyphens instead of '_' underscores for url parts.
$route['recipe-categories/select'] = 'recipe_categories/select';
$route['recipe-categories/delete/(:any)'] = 'recipe_categories/delete/$1';
$route['recipe-categories/edit/(:any)'] = 'recipe_categories/edit/$1';
$route['recipe-categories/view/(:any)'] = 'recipe_categories/view/$1';
$route['recipe-categories/add'] = 'recipe_categories/add';
$route['recipe-categories'] = 'recipe_categories';

$route['recipe_versions/delete/(:any)'] = 'recipe_versions/delete/$1';
$route['recipe_versions/edit/(:any)'] = 'recipe_versions/edit/$1';
$route['recipe_versions/view/(:any)'] = 'recipe_versions/view/$1';
$route['recipe_versions/add'] = 'recipe_versions/add';
$route['recipe_versions'] = 'recipe_versions';

$route['recipes/admin-list'] = 'recipes/admin_list';

//$route['recipes/by-category'] = 'recipes/recipes_by_category';
$route['recipes/by-category/(:any)'] = 'recipes/recipes_by_category/$1';
$route['recipes/my-recipes'] = 'recipes/my_recipes';
$route['recipes/delete/(:any)'] = 'recipes/delete/$1';
$route['recipes/edit/(:any)'] = 'recipes/edit/$1';
$route['recipes/view/(:any)'] = 'recipes/view/$1';
$route['recipes/add'] = 'recipes/add';
$route['recipes/about'] = 'recipes/about';
$route['recipes'] = 'recipes';



/* START OF - My Daily Life (mdl) Section */

$route['mdl-note-categories/admin-list'] = 'mdl_note_categories/admin_list';

$route['mdl-note-categories/delete/(:any)'] = 'mdl_note_categories/delete/$1';
$route['mdl-note-categories/edit/(:any)'] = 'mdl_note_categories/edit/$1';
$route['mdl-note-categories/view/(:any)'] = 'mdl_note_categories/view/$1';
$route['mdl-note-categories/add'] = 'mdl_note_categories/add';
$route['mdl-note-categories'] = 'mdl_note_categories';

$route['mdl-notes/by-category/(:any)'] = 'mdl_notes/notes_by_category/$1';
$route['mdl-notes/list-gbc'] = 'mdl_notes/list_grouped_by_category';
$route['mdl-notes/delete/(:any)'] = 'mdl_notes/delete/$1';
$route['mdl-notes/edit/(:any)'] = 'mdl_notes/edit/$1';
$route['mdl-notes/view/(:any)'] = 'mdl_notes/view/$1';
$route['mdl-notes/add'] = 'mdl_notes/add';
$route['mdl-notes/about'] = 'mdl_notes/about';
$route['mdl-notes'] = 'mdl_notes';


$route['mdl-link-categories/admin-list'] = 'mdl_link_categories/admin_list';

$route['mdl-link-categories/delete/(:any)'] = 'mdl_link_categories/delete/$1';
$route['mdl-link-categories/edit/(:any)'] = 'mdl_link_categories/edit/$1';
$route['mdl-link-categories/view/(:any)'] = 'mdl_link_categories/view/$1';
$route['mdl-link-categories/add'] = 'mdl_link_categories/add';
$route['mdl-link-categories'] = 'mdl_link_categories';

$route['mdl-links/update-visit-count/(:any)'] = 'mdl_links/update_visit_count/$1';

$route['mdl-links/most-visited'] = 'mdl_links/links_most_visited';
$route['mdl-links/by-category/(:any)'] = 'mdl_links/links_by_category/$1';
$route['mdl-links/list-gbc'] = 'mdl_links/list_grouped_by_category';
$route['mdl-links/delete/(:any)'] = 'mdl_links/delete/$1';
$route['mdl-links/edit/(:any)'] = 'mdl_links/edit/$1';
$route['mdl-links/view/(:any)'] = 'mdl_links/view/$1';
$route['mdl-links/add'] = 'mdl_links/add';
$route['mdl-links/about'] = 'mdl_links/about';
$route['mdl-links'] = 'mdl_links';


$route['members/delete/(:any)'] = 'members/delete/$1';
$route['members/forgot-password'] = 'members/forgot_password';
$route['members/edit-profile'] = 'members/edit_profile';
$route['members/profile'] = 'members/profile';
$route['members/sign-out'] = 'members/sign_out';
$route['members/sign-in'] = 'members/sign_in';
$route['members/sign-up'] = 'members/sign_up';
$route['members/dashboard'] = 'members/dashboard';
$route['members/edit/(:any)'] = 'members/edit/$1';
$route['members/view/(:any)'] = 'members/view/$1';
$route['members/search-results'] = 'members/search_results';
$route['members'] = 'members';

$route['contact-messages/delete/(:any)'] = 'contact_messages/delete/$1';
$route['contact-messages/update_status'] = 'contact_messages/update_status';
$route['contact-messages/add_modal'] = 'contact_messages/add_modal';
$route['contact-messages/thank-you'] = 'contact_messages/thank_you';
$route['contact-messages/edit/(:any)'] = 'contact_messages/edit/$1';
$route['contact-messages/add'] = 'contact_messages/add';
$route['contact-messages/view/(:any)'] = 'contact_messages/view/$1';
$route['contact-messages/search-results'] = 'contact_messages/search_results';
$route['contact-messages'] = 'contact_messages';

$route['news_comments/delete/(:any)'] = 'news_comments/delete/$1';
$route['news_comments/update'] = 'news_comments/update';
$route['news_comments/edit/(:any)'] = 'news_comments/edit/$1';
$route['news_comments/add_modal'] = 'news_comments/add_modal';
$route['news_comments/add'] = 'news_comments/add';

$route['news/get-news-item-using-ajax/(:any)'] = 'news/get_news_item_using_ajax/$1';

$route['news/delete/(:any)'] = 'news/delete/$1';
//$route['news/update'] = 'news/update';
$route['news/edit/(:any)'] = 'news/edit/$1';
$route['news/view/(:any)'] = 'news/view/$1';
$route['news/add'] = 'news/add';
$route['news'] = 'news/news_headlines_with_ajax_story';
//$route['news'] = 'news';

// Start of Base Routing.
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = "pages/view";
//$route['default_controller'] = "magazine";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */