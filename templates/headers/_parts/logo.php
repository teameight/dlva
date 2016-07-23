					<div class="logo">
						<a href="<?php echo esc_url(home_url( '/' )); ?>"><?php
							echo !empty($THEMEREX_GLOBALS['logo']) 
								? '<img src="'.esc_url($THEMEREX_GLOBALS['logo']).'" class="logo_main" alt="">' 
								: ''; 
							echo !empty($THEMEREX_GLOBALS['logo_fixed']) 
								? '<img src="'.esc_url($THEMEREX_GLOBALS['logo_fixed']).'" class="logo_fixed" alt="">' 
								: '';
							echo ($THEMEREX_GLOBALS['logo_text'] 
								? '<div class="logo_text">'.($THEMEREX_GLOBALS['logo_text']).'</div>' 
								: '');
							echo ($THEMEREX_GLOBALS['logo_slogan'] 
								? '<br><div class="logo_slogan">' . esc_html($THEMEREX_GLOBALS['logo_slogan']) . '</div>' 
								: '');
						?></a>
					</div>
					<div class="headbutts">
						<?php wp_nav_menu( array( 'theme_location' => 'head_butt_rt' ) ); ?>
					</div>