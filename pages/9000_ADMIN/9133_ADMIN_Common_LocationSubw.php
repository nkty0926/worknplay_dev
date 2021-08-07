<?php

$location_subw = $DB->conn->query("select name, group_concat(subw_line separator ', ') as subw_line, lat, lng from code_location_subw group by lat, lng")->fetchAll(PDO::FETCH_ASSOC);

include_once 'pages/9000_ADMIN/9000_ADMIN_header.php';

?>
	<section class="container-fluid">

		<div id="GoogleMap-map" style="height:728px;"></div>
		<script defer>
var map;
var markers = [];
function initAutocomplete(){
	map = new google.maps.Map(document.getElementById('GoogleMap-map'), {
		center: { lat: 37.566535, lng: 126.97796919999996 }, zoom: 10,
		zoomControl: true, scaleControl: true, streetViewControl: false, rotateControl: false, fullscreenControl: false, mapTypeControl: false
	});
<?php foreach($location_subw as $subw){ if($subw['lat'] && $subw['lng']){ ?>
	var marker = new google.maps.Marker({
		map: map,
		position: {lat: <?= $subw['lat'] ?>, lng: <?= $subw['lng'] ?>},
		subw_line: '<?= $subw['subw_line'] ?>',
		name: '<?= str_replace('\'', '\\\'', $subw['name']) ?>',
		infowindow: new google.maps.InfoWindow({ maxWidth:300 })
	}); markers.push(marker);
<?php }} ?>
	markers.forEach(function(marker){
		google.maps.event.addListener(marker, 'click', function(){
			map.setCenter(this.position);
			markers.forEach(function(marker){ marker.infowindow.close(); });
			this.infowindow.setContent(this.name + ' (' + this.subw_line + ')');
			this.infowindow.open(map, this);
		});
	});
}
		</script>
	</section>