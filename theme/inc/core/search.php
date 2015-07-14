<?php
/**
 * ----------------------------------------------------------------------------
 * SEARCH
 * ----------------------------------------------------------------------------
 */
add_filter('get_search_form', function ($form) {
    $formTemplate = <<<'EOT'
   
        <div class="search-form form-inline">
            <form role="search" method="get"  action="%1$s">
                <div class="form-group btn-group" roll="group">
                    <button type="submit" class="search-submit btn btn-primary pull-right" title="%3$s"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            		<label class="screen-reader-text sr-only" for="s">Search for:</label>
            		<input type="search" class="search-field form-control"  placeholder="%3$s..."value="%2$s" name="s">
                </div>
            </form>
        </div>
EOT;

    $form = sprintf($formTemplate, home_url('/'), // %1$s action
                        get_search_query(), // %2$s query
                        __('Search', 'toebox-basic')); // %3$s button caption

    return $form;
});

// Add search to a navigation wrapper markup if it is requested
add_filter('nav_menu_walker_arguments', function ($arguments) {

    $searchForm = sprintf('<!-- SEARCH -->%s<!-- SEARCH -->', get_search_form(false));
    $arguments['items_wrap'] = str_ireplace('<!-- SEARCH -->', $searchForm, $arguments['items_wrap']);

    return $arguments;
    
}, 0, 1);