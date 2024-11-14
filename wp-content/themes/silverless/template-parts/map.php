<?php

$map_type = get_field('map_type', 'options');
$static_map = get_field('static_map', 'options');
$center_latitude = get_field('center_latitude', 'options');
$center_longitude = get_field('center_longitude', 'options');
$style = get_field('style', 'options');
$initial_zoom = get_field('initial_zoom', 'options');
$map_marker = get_field('map_marker', 'options');

$random = rand();

?>

<div class="map">
  <?php if ($map_type == 'static') { ?>
    <?php
    $src = wp_get_attachment_image_url($static_map['ID'], 'full');
    $srcset = wp_get_attachment_image_srcset($static_map['ID'], 'full');
    $sizes = wp_get_attachment_image_sizes($static_map['ID'], 'full');
    ?>
    <img src="<?php echo esc_attr($src); ?>" srcset="<?php echo esc_attr($srcset); ?>"
      sizes="<?php echo esc_attr($sizes); ?>" alt="<?php echo esc_attr($static_map['alt']); ?>" loading="lazy" />
  <?php } else { ?>
    <div id="map-container-<?php echo $random; ?>" class="map__container"></div>
    <script type="text/javascript">
      jQuery(function ($) {
        mapboxgl.accessToken =
          'pk.eyJ1Ijoic2lsdmVybGVzcyIsImEiOiJjaXNibDlmM2gwMDB2Mm9tazV5YWRmZTVoIn0.ilTX0t72N3P3XbzGFhUKcg';

        const coords = {
          lng: <?php echo $center_longitude; ?>,
          lat: <?php echo $center_latitude; ?>
        };

        const m = new mapboxgl.Map({
          container: 'map-container-<?php echo $random; ?>', // container ID
          // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
          style: '<?php echo $style; ?>', // style URL
          center: coords, // starting center in [lng, lat]
          zoom: <?php echo $initial_zoom; ?>, // starting zoom
        });

        m.on('load', () => {
          m.addControl(new mapboxgl.NavigationControl());

          const el = document.createElement('div')
          el.className = 'map__marker'
          el.style = "--marker: url('<?php echo $map_marker['url']; ?>')"
          const marker = new mapboxgl.Marker(el).setLngLat(coords).addTo(m);
        })
      })
    </script>
  <?php } ?>
</div>