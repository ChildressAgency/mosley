</div><?php //close container ?>

<div class="callout-block">
  <div class="container">
    <?php echo wp_kses_post(get_field('callout_block')); ?>
  </div>
</div>

<div class="container"><?php //re-open original container for rest of page