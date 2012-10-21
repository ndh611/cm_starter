<?php
/*********************************************************************************
DISPLAY LANGUAGE SELECTOR WITH FLAGS ONLY
*********************************************************************************/
function CM_language_selector_flags(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
        foreach($languages as $l){			
            if(!$l['active']) echo '<a href="'.$l['url'].'" title="'.$l['language_code'].'">';			
			$flag = $l['country_flag_url'];
			
			$default_flags = array (
				'plugins/sitepress-multilingual-cms/res/flags/en.png',
				'plugins/sitepress-multilingual-cms/res/flags/vi.png'
			);
			
			$custom_flags = array (
				'themes/bep/images/flag_en.gif',
				'themes/bep/images/flag_vi.gif'
			);
			
			$flag = str_replace($default_flags,$custom_flags,$flag);
			
			echo '<img src="'.$flag.'" alt="'.$l['language_code'].'" />';
            if(!$l['active']) echo '</a>';
        }		
    }
}

/*********************************************************************************
DATE FORMAT
*********************************************************************************/
function CM_itl_date_format ($lan) {
	if ($lan=='en') return 'M j, Y';
	if ($lan=='vi') return 'd-m-Y';		
}

?>
?>