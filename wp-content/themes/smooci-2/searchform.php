<!-- <form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">    
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr>
        	<td style="width:100%;"><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" class="search_input" /></td>
            <td style="width:100px; padding-left:20px;"><input name="imageField" type="image" src="<?php bloginfo('template_url'); ?>/images/search.png" alt="SEARCH" /></td>
        </tr>
    </tbody>
    </table>        
</form> -->

<form action="http://www.google.com/cse" id="cse-search-box" target="_blank">
  <div>
    <input type="hidden" name="cx" value="partner-pub-4703206129601829:40q4o6pjk9v" />
    <input type="hidden" name="ie" value="ISO-8859-1" />
    <input type="text" name="q" size="15" />
    <input type="submit" name="sa" value="Search" />
  </div>
</form>
<script type="text/javascript" src="//www.google.com/cse/brand?form=cse-search-box&amp;lang=en"></script>