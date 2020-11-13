<section class="edge-side-menu">
    <div class="edge-side-area-inner">
        <div class="edge-close-side-menu-holder">
            <a class="edge-close-side-menu" href="#" target="_self">
                <span class="icon-arrows-remove"></span>
            </a>
        </div>
        <?php if(is_active_sidebar('sidearea')) {
            dynamic_sidebar('sidearea');
        } ?>
    </div>
    <div class="edge-side-area-bottom">
        <?php if(is_active_sidebar('sideareabottom')) {
            dynamic_sidebar('sideareabottom');
        } ?>
    </div>
</section>