(function ($, undefined) {
	$.widget("ui.gmap", {
		options: {
			x: 0,
			y: 0,
			location: "",
			height: 260,
			width: 470,
			overLaySource: "",
			gps: true,
			scale: 9,
			mapType: "roadmap",
			currentPosition: null,
			interval: 10000,
			followPosition: false,
			searchControl: false,
			showWeatherLayer: false,
			maxUserMarkers: 1,
			numUserMarkers: 0,
			zoomto: 12,
			baseaddr: '',
			isClient: false,
			placehold: 'Address search',
			dispMarkers: [],
			dataLat: '',
			dataLng: '',
			centerOnMarker: false,
			showRussia: false,
			showProjects: false
		},
		/**
		 * Dyn map widget constructor
		 */
		_create: function () {
			this._readConfig();

			if (!this.element.data("gmap")) return;

			switch (this.element.get(0).tagName) {
				case "DIV":
				{
					this._buildMap();
					this.bindEvents();
					break;
				}
				case "IMG":
				{
					this._buildStaticMap();
					break;
				}
				default:
				{
					break;
				}
			}

		},
		_showWeatherLayer: function () {
			var weatherLayer = new google.maps.weather.WeatherLayer({
				temperatureUnits: google.maps.weather.TemperatureUnit.FAHRENHEIT
			});
			weatherLayer.setMap(this.element.gmap3('get'));
		},
		/**
		 * Reads configuration from DOM element
		 */
		_readConfig: function () {
			var
				$this = this,
				$element = this.element;

			//Gets all init params
			if ($element.attr("zoomto") != undefined) this.options.zoomto = parseInt($element.attr("zoomto"));
			if ($element.attr("baseaddr") != undefined) this.options.baseaddr = $element.attr("baseaddr");
			if ($element.attr("placehold") != undefined) this.options.placehold = $element.attr("placehold");

			if ($element.attr("dataLat") != undefined) {
				this.options.dataLat = $element.attr("dataLat");
			}
			if ($element.attr("dataLng") != undefined) {
				this.options.dataLng = $element.attr("dataLng");
			}
			if ($element.attr("dispMarkers") != undefined) {
				this.options.dispMarkers = eval($element.attr("dispMarkers"));
			}

			if ($element.attr("isClient") != undefined) {
				this.options.isClient = ( $element.attr("isClient") ) ? true : false;
			}
			if ($element.attr("centerOnMarker") != undefined) {
				this.options.centerOnMarker = ( $element.attr("centerOnMarker") ) ? true : false;
			}

			if ($element.attr("x") != undefined) {
				this.options.x = parseFloat($element.attr("x"));
			}
			if ($element.attr("y") != undefined) {
				this.options.x = parseFloat($element.attr("y"));
			}
			if ($element.attr("height") != undefined) {
				this.options.height = $element.attr("height");
			}
			if ($element.attr("width") != undefined) {
				this.options.width = $element.attr("width");
			}
			if ($element.attr("showRussia") != undefined) {
				this.options.showRussia = true;
			}
			if ($element.attr("showProjects") != undefined) {
				this.options.showProjects = true;
			}

			if ($element.attr("scale") != undefined) {
				this.options.scale = parseInt($element.attr("scale"));
			}

			if ($element.attr("gps") != undefined) {
				this.options.gps = $element.attr("gps") !== "false";
			}

			if ($element.attr("overLaySource") != undefined) {
				this.options.overLaySource = $element.attr("overLaySource");
			}

			if ($element.attr("location") != undefined) {
				this.options.location = $element.attr("location");
			}

			if ($element.attr("mapType") != undefined) {
				this.options.mapType = $element.attr("mapType");
			}

			if ($element.attr("interval") != undefined) {
				this.options.interval = parseInt($element.attr("interval"));
			}

			if ($element.attr("followPosition") != undefined) {
				this.options.followPosition = $element.attr("followPosition") !== "false";
			}

			if ($element.attr("searchControl") != undefined) {
				this.options.searchControl = $element.attr("searchControl") !== "false";
			}

			if ($element.attr("showWeatherLayer") != undefined) {
				this.options.showWeatherLayer = $element.attr("showWeatherLayer") !== "false";
			}

			if ($element.attr("maxUserMarkers") != undefined) {
				this.options.maxUserMarkers = parseInt($element.attr("maxUserMarkers"));
			}
		},
		/**
		 * Builds static map if owner document element is an IMG
		 */
		_buildStaticMap: function () {
			var
				$this = this,
				$element = this.element;
			$element.attr("src", "http://maps.google.com/maps/api/staticmap?" +
				"center=" + $this.options.location +
				"&zoom=" + $this.options.scale +
				"&size=" + $this.options.width + "x" + $this.options.height +
				"&maptype=" + $this.options.mapType + "&sensor=false")
		},


		/**
		 * Builds a google map
		 */
		_initMap: function (center) {
			var
				$this = this;
			var xPosition = parseFloat(center ? center.y : 0);
			var yPosition = parseFloat(center ? center.x : 0);
			this.element.gmap3(
				{action: 'init',
					options: {
						zoom: $this.options.scale,
						center: new google.maps.LatLng(!isNaN(xPosition) ? xPosition
							: center.y, !isNaN(yPosition) ? yPosition
							: center.x),
						mapTypeId: google.maps.MapTypeId.ROADMAP
					},
					events: $this._getMapEventsHandlers()
				});
		},
		/**
		 * Gets GPS position
		 * @param map
		 */
		_getCurrentPosition: function (map) {
			var
				$this = this;
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function (pos) {
					var lat = pos.coords.latitude;
					var lng = pos.coords.longitude;
					var currentPosition = $this.getCurrentPositionMarker(map)
					if (currentPosition)
						currentPosition.setPosition(new google.maps.LatLng(lat, lng));
					else {
						map.gmap3({ action: 'addMarker',
							latLng: new google.maps.LatLng(lat, lng),
							marker: {
								options: {
									icon: new google.maps.MarkerImage('http://maps.gstatic.com/mapfiles/icon_green.png'),
									animation: google.maps.Animation.DROP,
									isPosition: true,
									tag: "position"
								}},
							map: {
								center: true,
								zoom: $this.options.scale
							}
						});
					}
				});
			}

			if ($this.options.followPosition)
				window.setTimeout(function () {
					$this._getCurrentPosition(map);
				}, $this.options.interval);
		},
		/**
		 * Builds google map
		 */
		_buildMap: function () {
			var
				$this = this,
				$element = $this.element;

			$element.css("height", $this.options.height);
			$element.css("width", $this.options.width);
			$element.gmap3(
				{action: 'init',
					options: {
						panControl: false,
						zoomControl: true,
						mapTypeControl: false,
						scaleControl: false,
						streetViewControl: false,
						overviewMapControl: false,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					},
					events: $this._getMapEventsHandlers(),
					callback: function () {
						if ($this.options.searchControl)
							$this._buildControls();
					}
				});

			if ($this.options.gps)
				$this._getCurrentPosition($element);

			if (!$this.options.followPosition)
				$element.gmap3({
					action: 'getAddress',
					address: $this.options.location,
					callback: function (results) {
						if (!results) return;
						var loc = results[0].geometry.location
						$element.gmap3({
							action: 'addMarker',
							latLng: loc
						});
					}
				});
			if ($this.options.showWeatherLayer)
				$this._showWeatherLayer();

			$this.isInitialisingMarkers = true;
			if ($this.options.dataLat != '' && $this.options.dataLng  != '' ) {
				console.log( parseFloat($this.options.dataLat) );
				console.log( parseFloat($this.options.dataLng) );
				$this._addMarkers([
					[parseFloat($this.options.dataLat), parseFloat($this.options.dataLng) ]
				]);
			}

			for (var i = 0; i < $this.options.dispMarkers.length; ++i) {
				var el = $this.options.dispMarkers[i];
				var x = '';
				var y = '';

				for (var propertyName in el) {
					if (x == '') x = el[propertyName];
					else y = el[propertyName];
					if (x != '' && y != '') break;
				}
				//console.log(el);
				if (el.id) {
					$this._addMarkers([
						[parseFloat(x), parseFloat(y), el.id ]
					]);
				} else {
					$this._addMarkers([
						[parseFloat(x), parseFloat(y) ]
					]);
				}
			}



			$this.isInitialisingMarkers = false;

			if ($this.options.showRussia) {
				var map = $this.element.gmap3('get');
				map.setCenter(new google.maps.LatLng(58.898474688527315, 43.835219946289044));
				map.setZoom(4);
			}
			if ($this.options.showProjects) {
				var map = $this.element.gmap3('get');
				map.setCenter(new google.maps.LatLng(57.22566775087918, 70.98312639097492));
				map.setZoom(3);
				//$('#gmap').gmap3('get').getCenter()
			}


		},
		/**
		 * Gets all markers
		 */
		getAllMarkers: function () {

			return this.element.gmap3({action: "get", name: "marker", all: true});
		},
		setPos: function (x, y, zoom) {
			var $this = this;
			var map = $this.element.gmap3('get');
			map.setCenter(new google.maps.LatLng(x, y));
			map.setZoom(zoom);
		},

		/**
		 * Gets current position marker
		 */
		getCurrentPositionMarker: function () {
			var markers = this.getAllMarkers();
			for (i in markers)
				if (markers[i].isPosition) {
					return markers[i];
				}
		},

		get_max_usermarker_index: function () {
			var $this = this;
			var res = 0;
			var allm = $this.getAllMarkers();
			var s = '';
			$.each(allm, function (i, marker) {
				var ttag = marker.tag;
				s += ttag + ',';
				if (ttag.indexOf('user_marker_') == 0) {
					res = parseInt(ttag.replace('user_marker_', ''));
				}

			});
			//alert( allm + "\r\n" + s+"\r\n max_ind = "+res);
			return res;

		},

		get_user_markers_coords: function () {
			var $this = this;

			var res = [];
			var allm = $this.getAllMarkers();
			$.each(allm, function (i, marker) {
				var ttag = marker.tag;
				if (ttag.indexOf('user_marker_') == 0) {
					var pos = marker.getPosition();
					res.push( {lat: pos.lat(), lng: pos.lng()} );
				}
			});
			return res;
		},


		/**
		 * Add markers to map
		 * @param markers
		 */
		_addMarkers: function (markers, icon, type, callback) {
			var $this = this;


			var maxind = $this.get_max_usermarker_index();

			for (var i = 0; i < markers.length; ++i) {
				var newno = maxind + 1;
				var ctag = 'user_marker_' + newno;

				//move Last marker to new position
				if ($this.options.isClient === false) {
					if ($this.options.numUserMarkers + 1 > $this.options.maxUserMarkers) {
						var mrkr = this.element.gmap3({action: "get", name: "marker", tag: 'user_marker_' + maxind});
						if (mrkr) mrkr.setPosition(markers[i]);
						continue;
					}
				}
				var data = [];

				++$this.options.numUserMarkers;
				data.push({
					latLng: markers[i],
					tag: ctag,
					data: markers[i][2],
					map: {
						center: true,
						zoom: 14
					}
				});
				//alert('in: '+markers[i]);
				var is_draggable = ($this.options.isClient) ? false : true;
				var anim = ($this.options.isClient) ? false : google.maps.Animation.DROP;

				if ($this.isInitialisingMarkers) {
					if ($this.options.isClient || $this.options.centerOnMarker) {
						var map = $this.element.gmap3('get');
						var zoomto = $this.options.zoomto;
						map.setCenter(new google.maps.LatLng(markers[i][0], markers[i][1]));
						if (map.getZoom() < zoomto) map.setZoom(zoomto);
					}
				}
				if (this.options.showProjects) icon = '/img/mapDot.png';


				$this.element.gmap3(
					{
						action: 'addMarkers',
						markers: data,
						marker: {
							options: {
								icon: new google.maps.MarkerImage(icon ? icon : 'http://maps.gstatic.com/mapfiles/icon_green.png'),
								animation: anim,
								draggable: is_draggable,
								tag: ctag

							},
							events: {
								click: function (marker, event, data) {


									$this.element.gmap3({
										action: 'getAddress',
										latLng: marker.getPosition(),
										callback: function (results) {
											//prevent multiple popups
											if (marker.winvisible) return false;

											marker.addressDescription = results && results[1] ? results && results[1].formatted_address : 'no address';
											marker.winvisible = true;
											var content = $this._getOpenWindowContent(marker);
											if ($this.options.isClient) {
												console.log(marker);
												console.log(event);
												console.log(data);
												//content = '<div class=""><div class="markpopup">фывфыв</div></div>'
												content = data;
											}


											$this.element.gmap3(
												{action: 'addinfowindow', anchor: marker,
													options: {
														content: content
													},
													events: {
														domready: function (win) {
															//Fix Info window content box
															$(win.content).parents("div:eq(1)").prev().css("visibility", "hidden");
															$(win.content).parents("div:eq(1)").addClass("ui-body")
																.addClass("ui-body-a").addClass("ui-corner-all").css("z-index", 300);
															//BindEvents
															$(".markerRemove", win.content).click(function (event) {
																event.preventDefault();
																event.stopPropagation();
																--$this.options.numUserMarkers;
																$this.element.gmap3({action: 'clear', name: 'marker', tag: marker.tag});
																//win.anchor.setMap(null);
															});
														},
														closeclick: function () {
															marker.winvisible = false;
														}
													}
												});
										}
									});

								}
							}
						}
					});

			}

		},

		_getOpenWindowContent: function (marker) {
			$.template("ctaMarkerInfo", openBalloonTemplate);
			return $.tmpl("ctaMarkerInfo", marker).get(0);
		},

		/**
		 * Gets directions
		 * @param targetMarker
		 */
		_getDirection: function (targetMarker) {
			var $this = this, $element = this.element;
			$element.gmap3({
				action: 'getRoute',
				options: {
					origin: $this.getCurrentPositionMarker().position,
					destination: targetMarker.position,
					travelMode: google.maps.DirectionsTravelMode.DRIVING
				},
				callback: function (results) {
					if (!results) return;
					$element.gmap3(
						{ action: 'addDirectionsRenderer',
							options: {
								preserveViewport: true,
								draggable: false,
								directions: results,
								suppressInfoWindows: true,
								suppressMarkers: true
							}
						}
					);
				}

			});
		},
		/**
		 * Address search control
		 * @param result
		 */
		_buildControls: function (result) {
			var
				$this = this,
				$element = $this.element;
			map = $element.gmap3('get');
			/*
			 * Address search Control
			 */
			var addressControl = document.createElement('DIV');


			var baseaddr = ($this.options.baseaddr == '') ? $this.options.placehold : $this.options.baseaddr;
			var addressSearch = $("<input type='text' value='" + baseaddr + "' placehold='" + $this.options.placehold + "' style='width: 200px'>");
			$(addressControl).append(addressSearch);
			addressControl.index = 1;
			map.controls[google.maps.ControlPosition.TOP_RIGHT].push(addressControl);
			$(addressControl).css('padding', '5px');

			$(addressSearch).bind('focus', function (e) {
					var pl = $(e.target).attr('placehold');
					var val = $(e.target).val();

					if (val == pl) {
						$(e.target).val('');

						//trying to get val from edit form
						var country = $('#cnt_flexselect').val();
						var city = $('#flexselect_city_flexselect').val();
						var addr = $('#address').val();
						if (typeof country == 'undefined') country = '';
						if (typeof city == 'undefined') city = '';
						if (typeof addr == 'undefined') addr = '';

						if (country != '' || city != '' || addr != '') {
							if (country != '') {
								val = country;
								if (city != '') val += ', ' + city;
							} else {
								if (city != '') val += ', ' + city;
								else val = addr;
							}
							$(e.target).val(val);
							$(addressSearch).autocomplete("search", val);
						}
					} else {
						$(addressSearch).autocomplete("search", val);
					}
				}
			);
			$(addressSearch).bind('blur', function (e) {
					var pl = $(e.target).attr('placehold');
					var val = $(e.target).val();

					if (val == '') $(e.target).val(pl);
				}
			);

			//Init auto-complete widget
			$(addressSearch).autocomplete({
				open: function (event, ui) {

				},
				source: function (request, response) {
					$element.gmap3({
						action: 'getAddress',
						address: $(addressSearch).val(),
						callback: function (results) {
							if (!results) return;
							response($.map(results, function (item) {
								return {
									label: item.formatted_address,
									value: item.formatted_address,
									source: item
								}
							}));
						}
					});
				},
				select: function (event, ui) {
					$this._addMarkers([ui.item.source.geometry.location]);
					var map = $element.gmap3('get');
					var zoomto = $this.options.zoomto;

					map.setCenter(ui.item.source.geometry.location)
					if (map.getZoom() < zoomto) map.setZoom(zoomto);
				}
			});
		},
		/**
		 *  Add map user events handler
		 */
		_getMapEventsHandlers: function () {
			var $this = this;
			return  {click: function (map, event) {
				if ($this.options.isClient) return;
				$this._addMarkers([event.latLng]);
			}}
		},
		/**
		 * Binds map events
		 */
		bindEvents: function () {
		}
	})
})(jQuery);


var openBalloonTemplate = '<div>' +
	'<div class="markpopup">${addressDescription}</div>' +
	'<div><a class="markerRemove">Удалить метку</a> </div>' +
	'</div>';
