<?php
  $link = get_field('button_link');
  if($link): 
    $btn_class = 'btn-block-wrapper';
    if(!empty($block['className'])){
      $btn_class .= ' ' . $block['className'];
    }
    if(!empty($block['align'])){
      $btn_class .= ' align' . $block['align'];
    }
  ?>
  <p class="<?php echo esc_attr($btn_class); ?>">
    <a href="<?php echo esc_url($link['url']); ?>" class="btn-main"><?php echo esc_html($link['title']); ?></a>
  </p>
<?php endif; ?>