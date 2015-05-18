<?php
global $posts;
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_top');
toebox\inc\ToeBox::HandleLoop($posts, $toeboxSlug);

toebox\inc\ToeBox::HandleListNavigation();

toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_bottom');
