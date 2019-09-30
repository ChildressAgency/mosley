<div class="media quick-link-block">
  <?php $quick_link_image = get_field('quick_link_block_quick_link_image'); ?>
  <img src="<?php echo esc_url($quick_link_image['url']); ?>" alt="<?php echo esc_attr($quick_link_image['alt']); ?>" />
  <div class="media-body">
    <?php $quick_link = get_field('quick_link_block_quick_link'); ?>
    <h3><a href="<?php echo esc_url($quick_link['url']); ?>"><?php echo esc_html($quick_link['title']); ?></a></h3>
    <p><?php echo esc_html(get_field('quick_link_block_quick_link_description')); ?></p>
  </div>
</div>
