<?php
/*
 * Template Name: Referenzen
*/
?>
<?php $id = get_the_ID(); ?>
<script defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2cjJAXR34mqCEOsLtJYlRq0H8yArfjR0"></script>
<?php get_header(); ?>

<?php
$file = "https://www.swb.solar/wp-content/themes/swb/csv/orte.csv";
$json = csvToJson($file);
?>

<section class="content mb-0">
  <div class="container-fluid container-fluid--nopadding mb-lg-5">
    <div class="row no-gutters relative-down-md">
      <div class="col-12 col-lg-7">
        <div class="teaser teaser--map">
          <div id="map-canvas" data-url="<?php echo bloginfo('template_url'); ?>"
               data-pins='{"sites": <?php echo preg_replace('/\\\\ufeff/', '', $json) ?>}'
               data-center="<?php echo get_post_meta($id, 'center', true); ?>"></div>
        </div>
      </div>
      <div class="col-12 col-lg-5 row no-gutters align-items-center pl-md-3 pl-lg-0 py-3 py-lg-4 static-down-md">
        <div class="map-info-container">
          <div class="col-lg-10 map-info">
            <a class="map-info__close" href="#"><img src="/wp-content/themes/swb/img/icons/x.svg" alt="close"></a>
            <div id="map-info"></div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12 row no-gutters">
          <div class="col-12 col-md-12">
            <div class="teaser__tile teaser__tile--basic">
              <div class="teaser__pre">
                Referenzen
              </div>
              <div class="teaser__headline">
                <h1><?php the_title(); ?></h1>
              </div>
              <div class="teaser__text">
                  <?php echo get_post_meta($id, 'text', true); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="teaser__tile teaser__tile--full">
        <?php the_content(); ?>
    </div>
  </div>
</section>

<script>
  var map,mapContainer=document.getElementById("map-canvas"),zoom=6,center=mapContainer.dataset.center.split(",").map(Number),sites=mapContainer.dataset.pins,sitesJSON=JSON.parse(sites);function initMap(){setMarkers(map=new google.maps.Map(mapContainer,{zoom:zoom,center:new google.maps.LatLng(center[0],center[1]),scrollwheel:!1,styles:[{featureType:"all",elementType:"geometry.fill",stylers:[{weight:"2.00"}]},{featureType:"all",elementType:"geometry.stroke",stylers:[{color:"#00AAFF"}]},{featureType:"all",elementType:"labels.text",stylers:[{visibility:"visible"}]},{featureType:"landscape",elementType:"all",stylers:[{color:"#f2f2f2"}]},{featureType:"landscape",elementType:"geometry.fill",stylers:[{color:"#ffffff"}]},{featureType:"landscape.man_made",elementType:"geometry.fill",stylers:[{color:"#ffffff"}]},{featureType:"poi",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"road",elementType:"all",stylers:[{saturation:-100},{lightness:45}]},{featureType:"road",elementType:"geometry.fill",stylers:[{color:"#eeeeee"}]},{featureType:"road",elementType:"labels.text.fill",stylers:[{color:"#7b7b7b"}]},{featureType:"road",elementType:"labels.text.stroke",stylers:[{color:"#ffffff"}]},{featureType:"road.highway",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"road.arterial",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"transit",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"water",elementType:"all",stylers:[{color:"#00AAFF"},{visibility:"on"}]},{featureType:"water",elementType:"geometry.fill",stylers:[{color:"#7fdeff"}]},{featureType:"water",elementType:"labels.text.fill",stylers:[{color:"#070707"}]},{featureType:"water",elementType:"labels.text.stroke",stylers:[{color:"#ffffff"}]}]}),sitesJSON)}var uri=mapContainer.dataset.url;function setMarkers(e,t){for(var s=0;s<t.sites.length;s++){sites=t[s];var l=new google.maps.LatLng(t.sites[s].lat,t.sites[s].long);const a=new google.maps.Marker({title:t.sites[s].name,position:l,icon:uri+"/img/mapmarker.svg?23",map:e,html:t.sites[s].leistung,text:t.sites[s].speicher});a.addListener("click",()=>{if(e.setZoom(10),e.setCenter(a.getPosition()),$(window).width()<992&&e.panBy(0,-100),null!=a.html){var t='<div class="row no-gutters">';t+='<div class="d-flex align-items-center"><div>',t+='<img src="/wp-content/themes/swb/img/icons/leistung.svg">',t+="</div><div><strong>"+a.html.replace(".",",")+" kWp</strong><br>Leistung</div></div>",t+='<div class="d-flex align-items-center"><div>',t+='<img src="/wp-content/themes/swb//img/icons/speicher.svg">',t+="</div><div><strong>"+a.text+"</strong><br>Speicher</div></div>",t+="</div>",$("#map-info").html('<div class="map-info__title">'+a.title+'</div><div class="map-info__description">'+t+"</div>").parent().addClass("map-info--visible"),$(".teaser--map").addClass("teaser--map--focus"),setTimeout(function(){$(".map-info").addClass("fadeInDown")},10),$(".map-info__close").click(function(t){t.preventDefault(),$("#map-info").html(""),$("#map-info").parent().removeClass("map-info--visible"),$(".teaser--map").removeClass("teaser--map--focus"),$(".map-info").removeClass("fadeInDown"),e.setZoom(zoom),e.setCenter({lat:center[0],lng:center[1]})})}})}}google.maps.event.addDomListener(window,"load",initMap);
</script>

<?php get_footer(); ?>
