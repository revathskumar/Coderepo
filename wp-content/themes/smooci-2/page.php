<?php get_header(); ?> 
             
        <div class="main_body_mobile"> 
        
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
        	<tr>
            	<td style="width:15px;"><img src="<?php bloginfo('template_url'); ?>/images/leftContentHeader2Background.png" alt="" /></td>
                <td style="background-color:#ffffff; background-image:url(<?php bloginfo('template_url'); ?>/images/contentHeader2Background.png); width:100%;"></td>    
                <td style="width:15px;"><img src="<?php bloginfo('template_url'); ?>/images/rightContentHeader2Background.png" alt="" /></td>
            </tr>
            <tr>
            	<td style="background-color:#ffffff; width:15px; background-image:url(<?php bloginfo('template_url'); ?>/images/leftContentBackground.png);"></td>  
				<td style="background-color:#ffffff;">
              		
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                        
                            <td valign="top" style="width:100%;">
                                <div id="container">
                    
                                    <?php if(have_posts()) : ?>
                                    <?php while(have_posts()) : the_post(); ?>
                    
                                        <div class="post_mobile" id="post-<?php the_ID(); ?>">
                    
                                            <div class="post_the_date">
                                                <?php the_time('F j, Y') ?>
                                            </div>
                                            <div class="post_the_title">
                                                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                            </div>        
                                            
											<div class="entry">                        
												<?php the_content(); ?>
                                                <?php wp_link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
												<?php edit_post_link('Edit', '<p>', '</p>'); ?>
											</div>                                               	
                    
                                        </div>                    
                    
                                    <?php endwhile; ?>               
                    
                                    <?php else : ?>
                    
                                        <div class="post" id="post-<?php the_ID(); ?>">
                                            <h2><?php _e('No posts are added.'); ?></h2>
                                        </div>
                    
                                    <?php endif; ?>
                                    
                                </div>
                            </td>
						</tr>
                        <tr>
								
        					<td valign="top" style="width:100%;"><?php get_sidebar(); ?></td>
                                        	
                         </tr>
                    </tbody>
                    </table>  
        
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

        <?php get_footer(); ?>        