<?php
/**
 * ----------------------------------------------------------------------------
 * SEARCH
 * ----------------------------------------------------------------------------
 */
 add_filter( 'get_search_form',function ( $form ) 
 {    
     $formTemplate = <<<'EOT'
 <div class="search-form-container form-inline">
	<form role="search" method="get" class="search-form" action="%1$s">
		<div class="form-group">
            <button type="submit" class="search-submit btn btn-default" title="%3$s"><span class="sr-only">%3$s</span><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            <label class="sr-only" for="s">Search</label>
			<input type="search" class="search-field form-control" placeholder="%3$s..." value="%2$s" name="s" title="Search for:">
		</div>
	</form>
</div>
EOT;
     
     $form = sprintf($formTemplate, 
                     home_url( '/' ), // %1$s action
                     get_search_query(), // %2$s query
                     __( 'Search', 'toebox-basic') // %3$s button caption
                    );
 
     return $form;
 });
 
 add_filter('nav_menu_walker_arguments', function($arguments){
     
     $searchForm = sprintf('<!-- SEARCH -->%s<!-- SEARCH -->', get_search_form(false));
     $arguments['items_wrap'] = str_ireplace('<!-- SEARCH -->', $searchForm, $arguments['items_wrap']);
     
     return $arguments;
 }, 0, 1 );