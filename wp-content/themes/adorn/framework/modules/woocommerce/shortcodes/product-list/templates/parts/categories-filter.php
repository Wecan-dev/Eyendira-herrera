<?php if($show_category_filter == 'yes'){ ?>
<div class="edge-pl-categories">
    <h6 class="edge-pl-categories-label"><?php esc_html_e('Categories','adorn'); ?></h6>
	<ul>
        <?php echo adorn_edge_get_module_part($categories_filter_list); ?>
    </ul>
</div>
<?php } ?>