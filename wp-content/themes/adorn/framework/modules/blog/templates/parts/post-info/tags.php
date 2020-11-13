<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>
<div class="edge-tags-holder">
    <div class="edge-tags">
        <?php the_tags('', ',', ''); ?>
    </div>
</div>
<?php } ?>