@extends('main.index')

@section('content')
<!-- ======= Download Section ======= -->
    <section id="download" style="margin-top:100px;">
      <div class="container" data-aos="fade-up" >
    	<div class="row">
          <div class="col-lg-12">
	        <div class="section-title">
	          <h2>GIS</h2>
          	<p>Peta Lokasi Sumber Daya Pertanian</p>
	        </div>
      	  </div>
      	</div>
      </div>
      <div class="container" data-aos="fade-up">
	      <div class="row">
	          <div class="col-lg-12">
	            <div id="map" style="width: auto; height: 600px;"></div>  
                        <script>
                            mapboxgl.accessToken = 'pk.eyJ1Ijoic2tpcHBlcmhvYSIsImEiOiJjazE2MjNqMjkxMTljM2luejl0aGRyOTAxIn0.Wyvywisw6bsheh7wJZcq3Q';
                            var map = new mapboxgl.Map({
                              container: 'map',
                              style: 'mapbox://styles/mapbox/streets-v11',
                              center: [109.76810754, -6.92242416], //lng,lat 10.818746, 106.629179
                              zoom: 9
                            });
                            var test ='<?php echo $dataArray;?>';  
                            var dataMap = JSON.parse(test); 

                            dataMap.features.forEach(function(marker) {

                                var el = document.createElement('div');
                                el.className = 'marker';

                                new mapboxgl.Marker(el)
                                    .setLngLat(marker.geometry.coordinates)
                                    .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                                .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
                                    .addTo(map);
                            });

                            // Add zoom and rotation controls to the map.
                            map.addControl(new mapboxgl.NavigationControl());

                        </script>
	          </div>
	       </div>
	  </div>
    </section><!-- End Download Section -->
@endsection
