		
        <div class="sidebar">
        
        	<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tbody>
        		<tr>
            		<td style="width:15px;"><img src="<?php bloginfo('template_url'); ?>/images/leftContentHeader2Background.png" alt="" /></td>
                	<td style="background-color:#ffffff; background-image:url(<?php bloginfo('template_url'); ?>/images/contentHeader2Background.png); width:100%;"></td>    
                	<td style="width:15px;"><img src="<?php bloginfo('template_url'); ?>/images/rightContentHeader2Background.png" alt="" /></td>
            	</tr>
            	<tr>
            		<td style="background-color:#ffffff; width:15px; background-image:url(<?php bloginfo('template_url'); ?>/images/leftContentBackground.png);"></td>  
					<td style="background-color:#ffffff; width:100%;">
                    	<ul>
							<?php //if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : ?>
                            
                            <li>
								<?php get_search_form(); ?>
                            </li>
                            <li>

                            <?php

if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== FALSE || strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== FALSE || strpos($_SERVER['HTTP_USER_AGENT'], 'iPod') !== FALSE || strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== FALSE){
    ?>
        <script type="text/javascript"><!--
          // XHTML should not attempt to parse these strings, declare them CDATA.
          /* <![CDATA[ */
          window.googleAfmcRequest = {
            client: 'ca-mb-pub-4703206129601829',
            format: '320x50_mb',
            output: 'HTML',
            slotname: '7874004489',
          };
          /* ]]> */
        //--></script>
        <script type="text/javascript"    src="http://pagead2.googlesyndication.com/pagead/show_afmc_ads.js"></script>
        <?php
}else{
    
    $GLOBALS['google']['client']='ca-mb-pub-4703206129601829';
    $GLOBALS['google']['https']=read_global('HTTPS');
    $GLOBALS['google']['ip']=read_global('REMOTE_ADDR');
    $GLOBALS['google']['markup']='xhtml';
    $GLOBALS['google']['output']='xhtml';
    $GLOBALS['google']['ref']=read_global('HTTP_REFERER');
    $GLOBALS['google']['slotname']='7161972639';
    $GLOBALS['google']['url']=read_global('HTTP_HOST') . read_global('REQUEST_URI');
    $GLOBALS['google']['useragent']=read_global('HTTP_USER_AGENT');
    $google_dt = time();
    google_set_screen_res();
    google_set_muid();
    google_set_via_and_accept();
    function read_global($var) {
      return isset($_SERVER[$var]) ? $_SERVER[$var]: '';
    }

    function google_append_url(&$url, $param, $value) {
      $url .= '&' . $param . '=' . urlencode($value);
    }

    function google_append_globals(&$url, $param) {
      google_append_url($url, $param, $GLOBALS['google'][$param]);
    }

    function google_append_color(&$url, $param) {
      global $google_dt;
      $color_array = explode(',', $GLOBALS['google'][$param]);
      google_append_url($url, $param,
                        $color_array[$google_dt % count($color_array)]);
    }

    function google_set_screen_res() {
      $screen_res = read_global('HTTP_UA_PIXELS');
      if ($screen_res == '') {
        $screen_res = read_global('HTTP_X_UP_DEVCAP_SCREENPIXELS');
      }
      if ($screen_res == '') {
        $screen_res = read_global('HTTP_X_JPHONE_DISPLAY');
      }
      $res_array = preg_split('/[x,*]/', $screen_res);
      if (count($res_array) == 2) {
        $GLOBALS['google']['u_w']=$res_array[0];
        $GLOBALS['google']['u_h']=$res_array[1];
      }
    }

    function google_set_muid() {
      $muid = read_global('HTTP_X_DCMGUID');
      if ($muid != '') {
        $GLOBALS['google']['muid']=$muid;
         return;
      }
      $muid = read_global('HTTP_X_UP_SUBNO');
      if ($muid != '') {
        $GLOBALS['google']['muid']=$muid;
         return;
      }
      $muid = read_global('HTTP_X_JPHONE_UID');
      if ($muid != '') {
        $GLOBALS['google']['muid']=$muid;
         return;
      }
      $muid = read_global('HTTP_X_EM_UID');
      if ($muid != '') {
        $GLOBALS['google']['muid']=$muid;
         return;
      }
    }

    function google_set_via_and_accept() {
      $ua = read_global('HTTP_USER_AGENT');
      if ($ua == '') {
        $GLOBALS['google']['via']=read_global('HTTP_VIA');
        $GLOBALS['google']['accept']=read_global('HTTP_ACCEPT');
      }
    }

    function google_get_ad_url() {
      $google_ad_url = 'http://pagead2.googlesyndication.com/pagead/ads?';
      google_append_url($google_ad_url, 'dt',
                        round(1000 * array_sum(explode(' ', microtime()))));
      foreach ($GLOBALS['google'] as $param => $value) {
        if (strpos($param, 'color_') === 0) {
          google_append_color($google_ad_url, $param);
        } else if (strpos($param, 'url') === 0) {
          $google_scheme = ($GLOBALS['google']['https'] == 'on')
              ? 'https://' : 'http://';
          google_append_url($google_ad_url, $param,
                            $google_scheme . $GLOBALS['google'][$param]);
        } else {
          google_append_globals($google_ad_url, $param);
        }
      }
      return $google_ad_url;
    }

    $google_ad_handle = @fopen(google_get_ad_url(), 'r');
    if ($google_ad_handle) {
      while (!feof($google_ad_handle)) {
        echo fread($google_ad_handle, 8192);
      }
      fclose($google_ad_handle);
    }
}
?>
                            </li>
                            <!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
                            <li><h2>Author</h2>
                            <p>A little something about you, the author. Nothing lengthy, just an overview.</p>
                            </li>
                            -->

							<?php if ( is_404() || is_category() || is_day() || is_month() || is_year() || is_search() || is_paged() ) {?>
                            <li>
								<?php /* If this is a 404 page */ if (is_404()) { ?>
								<?php /* If this is a category archive */ } elseif (is_category()) { ?>
								<p>You are currently browsing the archives for the <?php single_cat_title(''); ?> category.</p>
								<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
							    <p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives	for the day <?php the_time('l, F jS, Y'); ?>.</p>
								<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
								<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives	for <?php the_time('F, Y'); ?>.</p>
								<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
								<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives	for the year <?php the_time('Y'); ?>.</p>
								<?php /* If this is a search result */ } elseif (is_search()) { ?>
								<p>You have searched the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives for <strong>'<?php the_search_query(); ?>'</strong>. If you are unable to find anything in these search results, you can try one of these links.</p>
								<?php /* If this set is paginated */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
								<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives.</p>
								<?php } ?>
							</li>
							<?php }?>
                            <?php wp_list_pages('title_li=<h2>Pages</h2>' ); ?>
                
                            <li><h2>Archives</h2>
                                <ul>
                                <?php wp_get_archives('type=monthly'); ?>
                                </ul>
                            </li>
                
                            <?php wp_list_categories('show_count=1&title_li=<h2>Categories</h2>'); ?>
                            <?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
                                <?php wp_list_bookmarks(); ?>
                
                                <li><h2>Meta</h2>
                                <ul>
                                    <?php wp_register(); ?>
                                    <li><?php wp_loginout(); ?></li>
                                    <li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
                                    <li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
                                    <li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
                                    <?php wp_meta(); ?>
                                </ul>
                                </li>
                            <?php } ?>
                            <?php //endif; ?>
                        </ul>
                    </td>
           			<td style="background-color:#ffffff; width:15px; background-image:url(<?php bloginfo('template_url'); ?>/images/rightContentBackground.png);"></td>
				</tr>
                <tr>
                	<td style="width:15px;"><img src="<?php bloginfo('template_url'); ?>/images/leftContentFooterBackground.png" alt="" /></td>
                    <td style="background-color:#ffffff; background-image:url(<?php bloginfo('template_url'); ?>/images/contentFooterBackground.png); width:100%;"></td>    
                    <td style="width:15px;"><img src="<?php bloginfo('template_url'); ?>/images/rightContentFooterBackground.png" alt="" /></td>
                </tr>
			</tbody>
            </table>    
    
        </div>