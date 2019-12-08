<?php
add_shortcode( 'os_btn', 'os_btn_func' );
function os_btn_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'url' => '#',
     'title' => '',
     'class' => '',
     'icon_class' => '',
     'color' => false,
     'bg' => false
  ), $atts );

  if($atts['icon_class']){
    $icon_html = '<i class="'.$atts['icon_class'].'"></i>';
  }else{
    $icon_html = '';
  }

  $style_css = '';
  if($atts['color']){
    $style_css.= 'color: '.$atts['color'].';';
  }
  if($atts['bg']){
    if(!strpos($atts['class'], 'outline') && !strpos($atts['class'], 'under')){
      $style_css.= 'background-color: '.$atts['bg'].';';
    }
    $style_css.= 'border-color: '.$atts['bg'].';';
  }

  $html =   '<a style="'.$style_css.'" href="'.$atts['url'].'" class="os-btn '.$atts['class'].'" title="'.$atts['title'].'">'.$icon_html.'<span>'.$content.'</span></a>';
  return $html;
}