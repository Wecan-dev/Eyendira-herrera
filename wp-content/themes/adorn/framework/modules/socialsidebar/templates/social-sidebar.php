<?php
if($show_sidebar){ ?>

    <div class="edge-social-sidebar-holder <?php echo esc_attr($classes)?>">

		<?php if(is_array($networks) && count($networks)){ ?>

            <span class="edge-social-sidebar-text">
                <?php esc_html_e('Follow us:  ', 'adorn');?>
            </span>

			<?php
			foreach ($networks as $network){

				$icon_params['fa_icon'] = $network['icon'];

				$icon_params['link'] = '';
				if(isset($network['link'])){
					$icon_params['link'] = $network['link'];
				}

				echo adorn_edge_execute_shortcode('edge_icon', $icon_params);
			}

		}?>
    </div>

<?php }