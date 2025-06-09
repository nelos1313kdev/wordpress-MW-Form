<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Corpiva
 */
$corpiva_enable_post_excerpt	= get_theme_mod('corpiva_enable_post_excerpt','1'); 
$corpiva_enable_post_cat		= get_theme_mod('corpiva_enable_post_cat','1'); 
$corpiva_enable_post_date		= get_theme_mod('corpiva_enable_post_date','1'); 
$corpiva_enable_post_author		= get_theme_mod('corpiva_enable_post_author','1'); 
$corpiva_enable_post_comments	= get_theme_mod('corpiva_enable_post_comments'); 
$corpiva_enable_post_views		= get_theme_mod('corpiva_enable_post_views'); 
$corpiva_enable_post_rt			= get_theme_mod('corpiva_enable_post_rt'); 
$corpiva_enable_post_tag		= get_theme_mod('corpiva_enable_post_tag'); 
$corpiva_enable_post_ttl		= get_theme_mod('corpiva_enable_post_ttl','1'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('dt_post_item dt_posts--one'); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="image">
			<?php the_post_thumbnail(); ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>"></a>
		</div>
	<?php } ?>
	<div class="inner">
		<?php if($corpiva_enable_post_cat=='1'): ?>
			<div class="catetag">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="category tag"><?php the_category(' , '); ?></a>
			</div>
		<?php endif; ?>	
		<div class="meta">
			<ul>   
				<?php if($corpiva_enable_post_date=='1'): ?>
					<li>
						<div class="date">
							<i class="far fa-calendar" aria-hidden="true"></i> 
							<?php echo esc_html(get_the_date('M, D, Y')); ?>
						</div>
					</li>
				<?php endif; ?>	
				
				<?php if($corpiva_enable_post_author=='1'): ?>
					<li>
						<div class="author">                                                    
							<i class="far fa-user" aria-hidden="true"></i>
							<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><span><?php esc_html(the_author()); ?></span></a>
						</div>
					</li>
				<?php endif; ?>	
				
				<?php if($corpiva_enable_post_comments=='1'): ?>
					<li><i class="far fa-comments"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></li>
				<?php endif; ?>	
				
				<?php if($corpiva_enable_post_views=='1'): ?>
					<li><i class="far fa-eye"></i> <?php echo wp_kses_post(corpiva_get_post_view(get_the_ID())); ?></li>
				<?php endif; ?>	
				
				<?php if($corpiva_enable_post_rt=='1'): ?>
					<li><i class="fa-solid fa-eye"></i> <?php echo esc_html(corpiva_read_time()); ?></li>
				<?php endif; ?>
				
				<?php if($corpiva_enable_post_tag=='1'): ?>
					<li>
						<i class="fa-solid fa-tag"></i>
					<?php
						$posttags = get_tags();
						if($posttags):
							foreach($posttags as $index=>$tag){
								echo '<a href="'.esc_url(get_tag_link($tag->term_id)).'">' .esc_html($tag->name). '</a>, ';
								 if($index>7){break;}
							}
						endif; 
					 ?>
					</li>
				<?php endif; ?>
			</ul>
		</div>
		<?php     
			if($corpiva_enable_post_ttl=='1'):
				if ( is_single() ) :
				
				the_title('<h5 class="title">', '</h5>' );
				
				else:
				
				the_title( sprintf( '<h5 class="title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
				
				endif; 
			endif; 
		?> 
		
		<div class="content">
			<?php 
			  if($corpiva_enable_post_excerpt == '1' && !is_single()):
			  
				the_excerpt();
				if ( function_exists( 'corpiva_execerpt_btn' ) ) : corpiva_execerpt_btn(); endif; 
				
				else:
				
				the_content( 
						sprintf( 
							__( 'Read More', 'corpiva' ), 
							'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
						) 
					);
					
				endif;	
			?>
		</div>
	</div>
</article>