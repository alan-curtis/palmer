jQuery(document).ready(function($) {
		
    if( $('.toplevel_page_wpgmp_view_overview ul li a').find('.fc-fire-sale').length > 0 ) { 
        $('.toplevel_page_wpgmp_view_overview ul li a').find('.fc-fire-sale').parent('a').attr('target','_blank');
    }    

	let checked_chkboxes = [];
	
	$('.wp-list-table').find(':checkbox').change(function() {
		
		let temp = [];
		
		var checked_boxes = $('.wp-list-table').find(':checkbox').not('#cb-select-all-1');
		
		checked_boxes.each(function(){
			
			if($(this).is(":checked")){
				temp.push(this.value);
			}
			
		});
		checked_chkboxes = temp;
          
    });
    
	$(document).on('click', '#doaction', function( e ) {
		
        e.preventDefault();
        
        if($('#bulk-action-selector-top').val() == 'delete'){
			
			if(checked_chkboxes.length == 0){
				
				$("#delete_bulk_fc_record .modal_delete_msg").text(wpgmp_local.no_record_for_bulk_delete);
				$('.modal-custom-heading').text('Notice');
				$('.modal-footer.delete').hide();
				$('.modal-footer.select-some').show();
				
			}else{
				
				$("#delete_bulk_fc_record .modal_delete_msg").text(wpgmp_local.confirm_bulk_delete);
				$('.modal-custom-heading').text('Confirmation');
				$('.modal-footer.delete').show();
				$('.modal-footer.select-some').hide();
				
			}
			
			$('#delete_bulk_fc_record').modal('show'); 
			
			return false;
						
		}else{
			
			$('.modal-footer.delete').show();
			$('.modal-footer.select-some').show();
		}
        
	 });
	 
	 
    
	$(document).on('click', '.bulk-delete-btn', function( e ) {
	  
	  e.preventDefault();
	  $(".wpgmp_listing_form").submit();
	  
	});

	$('#delete_fc_record').on('show.bs.modal', function (event) {

		$('.modal-footer.delete').show();
		
		var triggerElement = jQuery(event.relatedTarget); // Button that triggered the modal
		var current_id = triggerElement.data('item-id');
		var current_page = triggerElement.data('page-slug');
		var record_type = triggerElement.data('record-type');
		var _wpnonce = $('#_wpnonce').val();
		if(record_type == 'location_id'){
			$("#delete_fc_record .modal_delete_msg").text(wpgmp_local.confirm_location_delete);
		}else if(record_type == 'map_id'){
			$("#delete_fc_record .modal_delete_msg").text(wpgmp_local.confirm_map_delete);
		}else if(record_type == 'group_map_id'){
			$("#delete_fc_record .modal_delete_msg").text(wpgmp_local.confirm_category_delete);
		}else{
			$("#delete_fc_record .modal_delete_msg").text(wpgmp_local.confirm_record_delete);
		}
		var delete_url = '?page='+current_page+'&doaction=delete&'+record_type+'='+current_id+'&_wpnonce='+_wpnonce;
		var modal = jQuery(this);
		modal.find(".modal-footer a").attr("href", delete_url);
		
	});
    
    $('#delete_fc_record').on('hidden.bs.modal', function (e) {
	  $('.wp-list-table tr').removeClass('active');
	});
            
    var wpgmp_image_id = '';
    //intialize add more...
      
    $(".wpgmp_check_backup").click(function() {
		
        var wpgmp_bid = confirm(wpgmp_local.confirm_overwrite_db);
        if (wpgmp_bid == true) {
            var bkid = $(this).data("backup");
            $(this).closest("form").find("input[name='row_id']").val(bkid);
            $(this).closest("form").find("input[name='operation']").val("import_backup");
            $(this).closest("form").submit();
            return true;
        } else {
            return false;
        }
    });

    $(".wpgmp_check_key").click(function() {
        $('.wpgmp_maps_preview').html("...");
        var wpgmp_maps_key = $("input[name='wpgmp_api_key']").val();
        var address = 'london';
        $.get("https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=" + wpgmp_maps_key, function(data) {
            if (data.status == 'OK') {
                $('.wpgmp_maps_preview').html("Perfect!");
            } else {
                $('.wpgmp_maps_preview').html(data.error_message);
            }
        });
    });

    $("select[name='map_id']").change(function() {
        $(this).closest('form').submit();
    });
    $("select[name='filter_location']").change(function(event) {

        event.preventDefault();

        var what_value = $(this).val();

        if (what_value > 0) {
            $("tr[class^='filter_group_cat']").hide();
            $(".filter_group_cat" + $(this).val()).show("slow");
        } else {
            $("tr[class^='filter_group_cat']").show("slow");
        }

    });

    $(".wpgmp_search_input").keyup(function() {
        map_id = $(this).attr("rel");
        $(".wpgmp_locations_listing[rel='" + map_id + "']").addClass("wpgmp_loading");
        wpgmp_filter_locations(map_id, 1);
    });

    $(".wpgmp_toggle_container").click(function() {
        $(".wpgmp_toggle_main_container").toggle("slow");
        if ($(this).text() == "Hide") {
            $(this).text("Show");
        } else {
            $(this).text("Hide");
        }
    });

    $(".wpgmp_mcurrent_loction").click(function() {
        wpgmp_get_current_location();
    });

    $(".wpgmp-select-all").click(function() {
        var checkAll = $(".wpgmp-select-all").prop('checked');
        if (checkAll) {
            $(this).closest('table').find(".wpgmp-location-checkbox").prop("checked", true);
        } else {
            $(this).closest('table').find(".wpgmp-location-checkbox").prop("checked", false);
        }
    });

    $(".wpgmp-location-checkbox").click(function() {
        if ($(".wpgmp-location-checkbox").length == $(".wpgmp-location-checkbox:checked").length) {
            $(".wpgmp-select-all").prop("checked", true);
        } else {
            $(".wpgmp-select-all").prop("checked", false);
        }
    });

    $(".wpgmp_map_key_missing").click(function(e) {

        e.preventDefault();

        var winWidth=570;
        var winHeight=700;
        var left = (screen.width-winWidth)/2;
        var top = (screen.height-winHeight)/2;
     
        window.open('https://console.cloud.google.com/google/maps-hosted?utm_source=wp_plugin_flipper', 'Quick Start Widget', 
        'resizable=yes,width='+winWidth+',height='+winHeight+',left='+left+',top='+top);
        return false;
    });



    var maptable = $('#wpgmp_google_map_data_table').dataTable({
        "lengthMenu": [
            [10, 25, 50, 100, 200, 500, -1],
            [10, 25, 50, 100, 200, 500, "All"]
        ],
        "order": [
            [1, "desc"]
        ],
        "aoColumns": [{
            sWidth: '5%',
            "bSortable": false
        }, {
            sWidth: '40%'
        }, {
            sWidth: '30%'
        }, {
            sWidth: '20%'
        }]
    });

    var route_maptable = $('#wpgmp_google_map_route_data_table').dataTable({
        "lengthMenu": [
            [10, 25, 50, 100, 200, 500, -1],
            [10, 25, 50, 100, 200, 500, "All"]
        ],
        "aoColumns": [{
            sWidth: '10%'
        }, {
            sWidth: '35%'
        }, {
            sWidth: '35%'
        }, {
            sWidth: '20%'
        }]
    });

    $('input[name="save_entity_data"]').click(function() {
        var data = maptable.$('input[type="checkbox"]:checked');
        var selected_val = [];
        if (data.length > 0) {
            $.each(data, function(index, chk) {
                selected_val.push($(chk).val());
            });
            $('input[name="map_locations"]').val(selected_val);
        }

        return true;
    });

    $('select[name="select_all"]').change(function() {
        if ($(this).val() == 'select_all')
            $('input[name="map_locations[]"]').attr('checked', true);
        else
            $('input[name="map_locations[]"]').attr('checked', false);

    });

    $('input[name="save_route_data"]').click(function() {
        var data = maptable.$('input[type="checkbox"]:checked');
        var selected_val = [];
        if (data.length > 0) {
            $.each(data, function(index, chk) {
                selected_val.push($(chk).val());
            });
            $('input[name="route_way_points"]').val(selected_val);
        }

        return true;
    });

    $('.switch_onoff').change(function() {
        var target = $(this).data('target');
        if ($(this).attr('type') == 'radio') {
            $(target).closest('.form-group').hide();
            target += '_' + $(this).val();
        }
        if ($(this).is(":checked")) {
            $(target).closest('.form-group').show();
        } else {
            $(target).closest('.form-group').hide();
            if ($(target).hasClass('switch_onoff')) {
                $(target).attr('checked', false);
                $(target).trigger("change");
            }
        }


    });

    $.each($('.switch_onoff'), function(index, element) {
        if (true == $(this).is(":checked")) {
            $(this).trigger("change");
        }

    });

    $('.wpgmp-overview .color').wpColorPicker();
    
    $(".buy_premium .hide_buy_notice").click(function() {
		
		$('.buy_premium').slideUp('slow');
		var ajaxdata = { action: 'wpgmp_hide_buy_notice', _wpgmp_nonce : wpgmp_local.nonce  }
        jQuery.ajax({
				url : wpgmp_local.urlforajax,
				type : 'post',
				dataType: 'json',
				data : ajaxdata,
				beforeSend: function() {},
				success : function( response ) {}

		});

	});

    $(".sample_notice .hide_sample_notice").click(function () {

        $('.sample_notice').slideUp('slow');
        var ajaxdata = { action: 'wpgmp_hide_sample_notice', _wpgmp_nonce: wpgmp_local.nonce }
        jQuery.ajax({
            url: wpgmp_local.urlforajax,
            type: 'post',
            dataType: 'json',
            data: ajaxdata,
            beforeSend: function () { },
            success: function (response) { }

        });

    });

    $(".copy_to_clipboard").click(function () {

        let referrer_to_copy  = $(this).parent('.tooltip').prev('.referrer_to_create').val();
        navigator.clipboard.writeText(referrer_to_copy);
        $('span.tooltiptext').html(wpgmp_local.do_referrer_copy);
        $(this).find('span.tooltiptext').html(wpgmp_local.referrer_copied);
        
    });
	
});

function send_icon_to_map(imagesrc, target) {
     jQuery('#remove_image' + target).show();
     jQuery('#image_' + target).attr('src', imagesrc).show();
     jQuery('#input_' + target).val(imagesrc);
    tb_remove();
}

/**
 * @name MarkerClustererPlus for Google Maps V3
 * @version 2.1.2 [May 28, 2014]
 * @author Gary Little
 * @fileoverview
 * The library creates and manages per-zoom-level clusters for large amounts of markers.
 * <p>
 * This is an enhanced V3 implementation of the
 * <a href="http://gmaps-utility-library-dev.googlecode.com/svn/tags/markerclusterer/"
 * >V2 MarkerClusterer</a> by Xiaoxi Wu. It is based on the
 * <a href="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerclusterer/"
 * >V3 MarkerClusterer</a> port by Luke Mahe. MarkerClustererPlus was created by Gary Little.
 * <p>
 * v2.0 release: MarkerClustererPlus v2.0 is backward compatible with MarkerClusterer v1.0. It
 *  adds support for the <code>ignoreHidden</code>, <code>title</code>, <code>batchSizeIE</code>,
 *  and <code>calculator</code> properties as well as support for four more events. It also allows
 *  greater control over the styling of the text that appears on the cluster marker. The
 *  documentation has been significantly improved and the overall code has been simplified and
 *  polished. Very large numbers of markers can now be managed without causing Javascript timeout
 *  errors on Internet Explorer. Note that the name of the <code>clusterclick</code> event has been
 *  deprecated. The new name is <code>click</code>, so please change your application code now.
 */

/**
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


/**
 * @name ClusterIconStyle
 * @class This class represents the object for values in the <code>styles</code> array passed
 *  to the {@link MarkerClusterer} constructor. The element in this array that is used to
 *  style the cluster icon is determined by calling the <code>calculator</code> function.
 *
 * @property {string} url The URL of the cluster icon image file. Required.
 * @property {number} height The display height (in pixels) of the cluster icon. Required.
 * @property {number} width The display width (in pixels) of the cluster icon. Required.
 * @property {Array} [anchorText] The position (in pixels) from the center of the cluster icon to
 *  where the text label is to be centered and drawn. The format is <code>[yoffset, xoffset]</code>
 *  where <code>yoffset</code> increases as you go down from center and <code>xoffset</code>
 *  increases to the right of center. The default is <code>[0, 0]</code>.
 * @property {Array} [anchorIcon] The anchor position (in pixels) of the cluster icon. This is the
 *  spot on the cluster icon that is to be aligned with the cluster position. The format is
 *  <code>[yoffset, xoffset]</code> where <code>yoffset</code> increases as you go down and
 *  <code>xoffset</code> increases to the right of the top-left corner of the icon. The default
 *  anchor position is the center of the cluster icon.
 * @property {string} [textColor="black"] The color of the label text shown on the
 *  cluster icon.
 * @property {number} [textSize=11] The size (in pixels) of the label text shown on the
 *  cluster icon.
 * @property {string} [textDecoration="none"] The value of the CSS <code>text-decoration</code>
 *  property for the label text shown on the cluster icon.
 * @property {string} [fontWeight="bold"] The value of the CSS <code>font-weight</code>
 *  property for the label text shown on the cluster icon.
 * @property {string} [fontStyle="normal"] The value of the CSS <code>font-style</code>
 *  property for the label text shown on the cluster icon.
 * @property {string} [fontFamily="Arial,sans-serif"] The value of the CSS <code>font-family</code>
 *  property for the label text shown on the cluster icon.
 * @property {string} [backgroundPosition="0 0"] The position of the cluster icon image
 *  within the image defined by <code>url</code>. The format is <code>"xpos ypos"</code>
 *  (the same format as for the CSS <code>background-position</code> property). You must set
 *  this property appropriately when the image defined by <code>url</code> represents a sprite
 *  containing multiple images. Note that the position <i>must</i> be specified in px units.
 */
/**
 * @name ClusterIconInfo
 * @class This class is an object containing general information about a cluster icon. This is
 *  the object that a <code>calculator</code> function returns.
 *
 * @property {string} text The text of the label to be shown on the cluster icon.
 * @property {number} index The index plus 1 of the element in the <code>styles</code>
 *  array to be used to style the cluster icon.
 * @property {string} title The tooltip to display when the mouse moves over the cluster icon.
 *  If this value is <code>undefined</code> or <code>""</code>, <code>title</code> is set to the
 *  value of the <code>title</code> property passed to the MarkerClusterer.
 */
/**
 * A cluster icon.
 *
 * @constructor
 * @extends google.maps.OverlayView
 * @param {Cluster} cluster The cluster with which the icon is to be associated.
 * @param {Array} [styles] An array of {@link ClusterIconStyle} defining the cluster icons
 *  to use for various cluster sizes.
 * @private
 */
function ClusterIcon(cluster, styles) {
    cluster.getMarkerClusterer().extend(ClusterIcon, google.maps.OverlayView);

    this.cluster_ = cluster;
    this.className_ = cluster.getMarkerClusterer().getClusterClass();
    this.styles_ = styles;
    this.center_ = null;
    this.div_ = null;
    this.sums_ = null;
    this.visible_ = false;

    this.setMap(cluster.getMap()); // Note: this causes onAdd to be called
}


/**
 * Adds the icon to the DOM.
 */
ClusterIcon.prototype.onAdd = function() {
    var cClusterIcon = this;
    var cMouseDownInCluster;
    var cDraggingMapByCluster;

    this.div_ = document.createElement("div");
    this.div_.className = this.className_;
    if (this.visible_) {
        this.show();
    }

    this.getPanes().overlayMouseTarget.appendChild(this.div_);

    // Fix for Issue 157
    this.boundsChangedListener_ = google.maps.event.addListener(this.getMap(), "bounds_changed", function() {
        cDraggingMapByCluster = cMouseDownInCluster;
    });

    google.maps.event.addDomListener(this.div_, "mousedown", function() {
        cMouseDownInCluster = true;
        cDraggingMapByCluster = false;
    });

    google.maps.event.addDomListener(this.div_, "click", function(e) {
        cMouseDownInCluster = false;
        if (!cDraggingMapByCluster) {
            var theBounds;
            var mz;
            var mc = cClusterIcon.cluster_.getMarkerClusterer();
            /**
             * This event is fired when a cluster marker is clicked.
             * @name MarkerClusterer#click
             * @param {Cluster} c The cluster that was clicked.
             * @event
             */
            google.maps.event.trigger(mc, "click", cClusterIcon.cluster_);
            google.maps.event.trigger(mc, "clusterclick", cClusterIcon.cluster_); // deprecated name

            // The default click handler follows. Disable it by setting
            // the zoomOnClick property to false.
            if (mc.getZoomOnClick()) {
                // Zoom into the cluster.
                mz = mc.getMaxZoom();
                theBounds = cClusterIcon.cluster_.getBounds();
                mc.getMap().fitBounds(theBounds);
                // There is a fix for Issue 170 here:
                setTimeout(function() {
                    mc.getMap().fitBounds(theBounds);
                    // Don't zoom beyond the max zoom level
                    if (mz !== null && (mc.getMap().getZoom() > mz)) {
                        mc.getMap().setZoom(mz + 1);
                    }
                }, 100);
            }

            // Prevent event propagation to the map:
            e.cancelBubble = true;
            if (e.stopPropagation) {
                e.stopPropagation();
            }
        }
    });

    google.maps.event.addDomListener(this.div_, "mouseover", function() {
        var mc = cClusterIcon.cluster_.getMarkerClusterer();
        /**
         * This event is fired when the mouse moves over a cluster marker.
         * @name MarkerClusterer#mouseover
         * @param {Cluster} c The cluster that the mouse moved over.
         * @event
         */
        google.maps.event.trigger(mc, "mouseover", cClusterIcon.cluster_);
    });

    google.maps.event.addDomListener(this.div_, "mouseout", function() {
        var mc = cClusterIcon.cluster_.getMarkerClusterer();
        /**
         * This event is fired when the mouse moves out of a cluster marker.
         * @name MarkerClusterer#mouseout
         * @param {Cluster} c The cluster that the mouse moved out of.
         * @event
         */
        google.maps.event.trigger(mc, "mouseout", cClusterIcon.cluster_);
    });
};


/**
 * Removes the icon from the DOM.
 */
ClusterIcon.prototype.onRemove = function() {
    if (this.div_ && this.div_.parentNode) {
        this.hide();
        google.maps.event.removeListener(this.boundsChangedListener_);
        google.maps.event.clearInstanceListeners(this.div_);
        this.div_.parentNode.removeChild(this.div_);
        this.div_ = null;
    }
};


/**
 * Draws the icon.
 */
ClusterIcon.prototype.draw = function() {
    if (this.visible_) {
        var pos = this.getPosFromLatLng_(this.center_);
        this.div_.style.top = pos.y + "px";
        this.div_.style.left = pos.x + "px";
    }
};


/**
 * Hides the icon.
 */
ClusterIcon.prototype.hide = function() {
    if (this.div_) {
        this.div_.style.display = "none";
    }
    this.visible_ = false;
};


/**
 * Positions and shows the icon.
 */
ClusterIcon.prototype.show = function() {
    if (this.div_) {
        var img = "";
        // NOTE: values must be specified in px units
        var bp = this.backgroundPosition_.split(" ");
        var spriteH = parseInt(bp[0].replace(/^\s+|\s+$/g, ""), 10);
        var spriteV = parseInt(bp[1].replace(/^\s+|\s+$/g, ""), 10);
        var pos = this.getPosFromLatLng_(this.center_);
        this.div_.style.cssText = this.createCss(pos);
        img = "<img src='" + this.url_ + "' style='position: absolute; top: " + spriteV + "px; left: " + spriteH + "px; ";
        if (!this.cluster_.getMarkerClusterer().enableRetinaIcons_) {
            img += "clip: rect(" + (-1 * spriteV) + "px, " + ((-1 * spriteH) + this.width_) + "px, " +
                ((-1 * spriteV) + this.height_) + "px, " + (-1 * spriteH) + "px);";
        }
        img += "'>";
        this.div_.innerHTML = img + "<div style='" +
            "position: absolute;" +
            "top: " + this.anchorText_[0] + "px;" +
            "left: " + this.anchorText_[1] + "px;" +
            "color: " + this.textColor_ + ";" +
            "font-size: " + this.textSize_ + "px;" +
            "font-family: " + this.fontFamily_ + ";" +
            "font-weight: " + this.fontWeight_ + ";" +
            "font-style: " + this.fontStyle_ + ";" +
            "text-decoration: " + this.textDecoration_ + ";" +
            "text-align: center;" +
            "width: " + this.width_ + "px;" +
            "line-height:" + this.height_ + "px;" +
            "'>" + this.sums_.text + "</div>";
        if (typeof this.sums_.title === "undefined" || this.sums_.title === "") {
            this.div_.title = this.cluster_.getMarkerClusterer().getTitle();
        } else {
            this.div_.title = this.sums_.title;
        }
        this.div_.style.display = "";
    }
    this.visible_ = true;
};


/**
 * Sets the icon styles to the appropriate element in the styles array.
 *
 * @param {ClusterIconInfo} sums The icon label text and styles index.
 */
ClusterIcon.prototype.useStyle = function(sums) {
    this.sums_ = sums;
    var index = Math.max(0, sums.index - 1);
    index = Math.min(this.styles_.length - 1, index);
    var style = this.styles_[index];
    this.url_ = style.url;
    this.height_ = style.height;
    this.width_ = style.width;
    this.anchorText_ = style.anchorText || [0, 0];
    this.anchorIcon_ = style.anchorIcon || [parseInt(this.height_ / 2, 10), parseInt(this.width_ / 2, 10)];
    this.textColor_ = style.textColor || "black";
    this.textSize_ = style.textSize || 11;
    this.textDecoration_ = style.textDecoration || "none";
    this.fontWeight_ = style.fontWeight || "bold";
    this.fontStyle_ = style.fontStyle || "normal";
    this.fontFamily_ = style.fontFamily || "Arial,sans-serif";
    this.backgroundPosition_ = style.backgroundPosition || "0 0";
};


/**
 * Sets the position at which to center the icon.
 *
 * @param {google.maps.LatLng} center The latlng to set as the center.
 */
ClusterIcon.prototype.setCenter = function(center) {
    this.center_ = center;
};


/**
 * Creates the cssText style parameter based on the position of the icon.
 *
 * @param {google.maps.Point} pos The position of the icon.
 * @return {string} The CSS style text.
 */
ClusterIcon.prototype.createCss = function(pos) {
    var style = [];
    style.push("cursor: pointer;");
    style.push("position: absolute; top: " + pos.y + "px; left: " + pos.x + "px;");
    style.push("width: " + this.width_ + "px; height: " + this.height_ + "px;");
    return style.join("");
};


/**
 * Returns the position at which to place the DIV depending on the latlng.
 *
 * @param {google.maps.LatLng} latlng The position in latlng.
 * @return {google.maps.Point} The position in pixels.
 */
ClusterIcon.prototype.getPosFromLatLng_ = function(latlng) {
    var pos = this.getProjection().fromLatLngToDivPixel(latlng);
    pos.x -= this.anchorIcon_[1];
    pos.y -= this.anchorIcon_[0];
    pos.x = parseInt(pos.x, 10);
    pos.y = parseInt(pos.y, 10);
    return pos;
};


/**
 * Creates a single cluster that manages a group of proximate markers.
 *  Used internally, do not call this constructor directly.
 * @constructor
 * @param {MarkerClusterer} mc The <code>MarkerClusterer</code> object with which this
 *  cluster is associated.
 */
function Cluster(mc) {
    this.markerClusterer_ = mc;
    this.map_ = mc.getMap();
    this.gridSize_ = mc.getGridSize();
    this.minClusterSize_ = mc.getMinimumClusterSize();
    this.averageCenter_ = mc.getAverageCenter();
    this.markers_ = [];
    this.center_ = null;
    this.bounds_ = null;
    this.clusterIcon_ = new ClusterIcon(this, mc.getStyles());
}


/**
 * Returns the number of markers managed by the cluster. You can call this from
 * a <code>click</code>, <code>mouseover</code>, or <code>mouseout</code> event handler
 * for the <code>MarkerClusterer</code> object.
 *
 * @return {number} The number of markers in the cluster.
 */
Cluster.prototype.getSize = function() {
    return this.markers_.length;
};


/**
 * Returns the array of markers managed by the cluster. You can call this from
 * a <code>click</code>, <code>mouseover</code>, or <code>mouseout</code> event handler
 * for the <code>MarkerClusterer</code> object.
 *
 * @return {Array} The array of markers in the cluster.
 */
Cluster.prototype.getMarkers = function() {
    return this.markers_;
};


/**
 * Returns the center of the cluster. You can call this from
 * a <code>click</code>, <code>mouseover</code>, or <code>mouseout</code> event handler
 * for the <code>MarkerClusterer</code> object.
 *
 * @return {google.maps.LatLng} The center of the cluster.
 */
Cluster.prototype.getCenter = function() {
    return this.center_;
};


/**
 * Returns the map with which the cluster is associated.
 *
 * @return {google.maps.Map} The map.
 * @ignore
 */
Cluster.prototype.getMap = function() {
    return this.map_;
};


/**
 * Returns the <code>MarkerClusterer</code> object with which the cluster is associated.
 *
 * @return {MarkerClusterer} The associated marker clusterer.
 * @ignore
 */
Cluster.prototype.getMarkerClusterer = function() {
    return this.markerClusterer_;
};


/**
 * Returns the bounds of the cluster.
 *
 * @return {google.maps.LatLngBounds} the cluster bounds.
 * @ignore
 */
Cluster.prototype.getBounds = function() {
    var i;
    var bounds = new google.maps.LatLngBounds(this.center_, this.center_);
    var markers = this.getMarkers();
    for (i = 0; i < markers.length; i++) {
        bounds.extend(markers[i].getPosition());
    }
    return bounds;
};


/**
 * Removes the cluster from the map.
 *
 * @ignore
 */
Cluster.prototype.remove = function() {
    this.clusterIcon_.setMap(null);
    this.markers_ = [];
    delete this.markers_;
};


/**
 * Adds a marker to the cluster.
 *
 * @param {google.maps.Marker} marker The marker to be added.
 * @return {boolean} True if the marker was added.
 * @ignore
 */
Cluster.prototype.addMarker = function(marker) {
    var i;
    var mCount;
    var mz;

    if (this.isMarkerAlreadyAdded_(marker)) {
        return false;
    }

    if (!this.center_) {
        this.center_ = marker.getPosition();
        this.calculateBounds_();
    } else {
        if (this.averageCenter_) {
            var l = this.markers_.length + 1;
            var lat = (this.center_.lat() * (l - 1) + marker.getPosition().lat()) / l;
            var lng = (this.center_.lng() * (l - 1) + marker.getPosition().lng()) / l;
            this.center_ = new google.maps.LatLng(lat, lng);
            this.calculateBounds_();
        }
    }

    marker.isAdded = true;
    this.markers_.push(marker);

    mCount = this.markers_.length;
    mz = this.markerClusterer_.getMaxZoom();
    if (mz !== null && this.map_.getZoom() > mz) {
        // Zoomed in past max zoom, so show the marker.
        if (marker.getMap() !== this.map_) {
            marker.setMap(this.map_);
        }
    } else if (mCount < this.minClusterSize_) {
        // Min cluster size not reached so show the marker.
        if (marker.getMap() !== this.map_) {
            marker.setMap(this.map_);
        }
    } else if (mCount === this.minClusterSize_) {
        // Hide the markers that were showing.
        for (i = 0; i < mCount; i++) {
            this.markers_[i].setMap(null);
        }
    } else {
        marker.setMap(null);
    }

    this.updateIcon_();
    return true;
};


/**
 * Determines if a marker lies within the cluster's bounds.
 *
 * @param {google.maps.Marker} marker The marker to check.
 * @return {boolean} True if the marker lies in the bounds.
 * @ignore
 */
Cluster.prototype.isMarkerInClusterBounds = function(marker) {
    return this.bounds_.contains(marker.getPosition());
};


/**
 * Calculates the extended bounds of the cluster with the grid.
 */
Cluster.prototype.calculateBounds_ = function() {
    var bounds = new google.maps.LatLngBounds(this.center_, this.center_);
    this.bounds_ = this.markerClusterer_.getExtendedBounds(bounds);
};


/**
 * Updates the cluster icon.
 */
Cluster.prototype.updateIcon_ = function() {
    var mCount = this.markers_.length;
    var mz = this.markerClusterer_.getMaxZoom();

    if (mz !== null && this.map_.getZoom() > mz) {
        this.clusterIcon_.hide();
        return;
    }

    if (mCount < this.minClusterSize_) {
        // Min cluster size not yet reached.
        this.clusterIcon_.hide();
        return;
    }

    var numStyles = this.markerClusterer_.getStyles().length;
    var sums = this.markerClusterer_.getCalculator()(this.markers_, numStyles);
    this.clusterIcon_.setCenter(this.center_);
    this.clusterIcon_.useStyle(sums);
    this.clusterIcon_.show();
};


/**
 * Determines if a marker has already been added to the cluster.
 *
 * @param {google.maps.Marker} marker The marker to check.
 * @return {boolean} True if the marker has already been added.
 */
Cluster.prototype.isMarkerAlreadyAdded_ = function(marker) {
    var i;
    if (this.markers_.indexOf) {
        return this.markers_.indexOf(marker) !== -1;
    } else {
        for (i = 0; i < this.markers_.length; i++) {
            if (marker === this.markers_[i]) {
                return true;
            }
        }
    }
    return false;
};


/**
 * @name MarkerClustererOptions
 * @class This class represents the optional parameter passed to
 *  the {@link MarkerClusterer} constructor.
 * @property {number} [gridSize=60] The grid size of a cluster in pixels. The grid is a square.
 * @property {number} [maxZoom=null] The maximum zoom level at which clustering is enabled or
 *  <code>null</code> if clustering is to be enabled at all zoom levels.
 * @property {boolean} [zoomOnClick=true] Whether to zoom the map when a cluster marker is
 *  clicked. You may want to set this to <code>false</code> if you have installed a handler
 *  for the <code>click</code> event and it deals with zooming on its own.
 * @property {boolean} [averageCenter=false] Whether the position of a cluster marker should be
 *  the average position of all markers in the cluster. If set to <code>false</code>, the
 *  cluster marker is positioned at the location of the first marker added to the cluster.
 * @property {number} [minimumClusterSize=2] The minimum number of markers needed in a cluster
 *  before the markers are hidden and a cluster marker appears.
 * @property {boolean} [ignoreHidden=false] Whether to ignore hidden markers in clusters. You
 *  may want to set this to <code>true</code> to ensure that hidden markers are not included
 *  in the marker count that appears on a cluster marker (this count is the value of the
 *  <code>text</code> property of the result returned by the default <code>calculator</code>).
 *  If set to <code>true</code> and you change the visibility of a marker being clustered, be
 *  sure to also call <code>MarkerClusterer.repaint()</code>.
 * @property {string} [title=""] The tooltip to display when the mouse moves over a cluster
 *  marker. (Alternatively, you can use a custom <code>calculator</code> function to specify a
 *  different tooltip for each cluster marker.)
 * @property {function} [calculator=MarkerClusterer.CALCULATOR] The function used to determine
 *  the text to be displayed on a cluster marker and the index indicating which style to use
 *  for the cluster marker. The input parameters for the function are (1) the array of markers
 *  represented by a cluster marker and (2) the number of cluster icon styles. It returns a
 *  {@link ClusterIconInfo} object. The default <code>calculator</code> returns a
 *  <code>text</code> property which is the number of markers in the cluster and an
 *  <code>index</code> property which is one higher than the lowest integer such that
 *  <code>10^i</code> exceeds the number of markers in the cluster, or the size of the styles
 *  array, whichever is less. The <code>styles</code> array element used has an index of
 *  <code>index</code> minus 1. For example, the default <code>calculator</code> returns a
 *  <code>text</code> value of <code>"125"</code> and an <code>index</code> of <code>3</code>
 *  for a cluster icon representing 125 markers so the element used in the <code>styles</code>
 *  array is <code>2</code>. A <code>calculator</code> may also return a <code>title</code>
 *  property that contains the text of the tooltip to be used for the cluster marker. If
 *   <code>title</code> is not defined, the tooltip is set to the value of the <code>title</code>
 *   property for the MarkerClusterer.
 * @property {string} [clusterClass="cluster"] The name of the CSS class defining general styles
 *  for the cluster markers. Use this class to define CSS styles that are not set up by the code
 *  that processes the <code>styles</code> array.
 * @property {Array} [styles] An array of {@link ClusterIconStyle} elements defining the styles
 *  of the cluster markers to be used. The element to be used to style a given cluster marker
 *  is determined by the function defined by the <code>calculator</code> property.
 *  The default is an array of {@link ClusterIconStyle} elements whose properties are derived
 *  from the values for <code>imagePath</code>, <code>imageExtension</code>, and
 *  <code>imageSizes</code>.
 * @property {boolean} [enableRetinaIcons=false] Whether to allow the use of cluster icons that
 * have sizes that are some multiple (typically double) of their actual display size. Icons such
 * as these look better when viewed on high-resolution monitors such as Apple's Retina displays.
 * Note: if this property is <code>true</code>, sprites cannot be used as cluster icons.
 * @property {number} [batchSize=MarkerClusterer.BATCH_SIZE] Set this property to the
 *  number of markers to be processed in a single batch when using a browser other than
 *  Internet Explorer (for Internet Explorer, use the batchSizeIE property instead).
 * @property {number} [batchSizeIE=MarkerClusterer.BATCH_SIZE_IE] When Internet Explorer is
 *  being used, markers are processed in several batches with a small delay inserted between
 *  each batch in an attempt to avoid Javascript timeout errors. Set this property to the
 *  number of markers to be processed in a single batch; select as high a number as you can
 *  without causing a timeout error in the browser. This number might need to be as low as 100
 *  if 15,000 markers are being managed, for example.
 * @property {string} [imagePath=MarkerClusterer.IMAGE_PATH]
 *  The full URL of the root name of the group of image files to use for cluster icons.
 *  The complete file name is of the form <code>imagePath</code>n.<code>imageExtension</code>
 *  where n is the image file number (1, 2, etc.).
 * @property {string} [imageExtension=MarkerClusterer.IMAGE_EXTENSION]
 *  The extension name for the cluster icon image files (e.g., <code>"png"</code> or
 *  <code>"jpg"</code>).
 * @property {Array} [imageSizes=MarkerClusterer.IMAGE_SIZES]
 *  An array of numbers containing the widths of the group of
 *  <code>imagePath</code>n.<code>imageExtension</code> image files.
 *  (The images are assumed to be square.)
 */
/**
 * Creates a MarkerClusterer object with the options specified in {@link MarkerClustererOptions}.
 * @constructor
 * @extends google.maps.OverlayView
 * @param {google.maps.Map} map The Google map to attach to.
 * @param {Array.<google.maps.Marker>} [opt_markers] The markers to be added to the cluster.
 * @param {MarkerClustererOptions} [opt_options] The optional parameters.
 */
function MarkerClusterer(map, opt_markers, opt_options) {
    // MarkerClusterer implements google.maps.OverlayView interface. We use the
    // extend function to extend MarkerClusterer with google.maps.OverlayView
    // because it might not always be available when the code is defined so we
    // look for it at the last possible moment. If it doesn't exist now then
    // there is no point going ahead :)
    this.extend(MarkerClusterer, google.maps.OverlayView);

    opt_markers = opt_markers || [];
    opt_options = opt_options || {};

    this.markers_ = [];
    this.clusters_ = [];
    this.listeners_ = [];
    this.activeMap_ = null;
    this.ready_ = false;

    this.gridSize_ = opt_options.gridSize || 60;
    this.minClusterSize_ = opt_options.minimumClusterSize || 2;
    this.maxZoom_ = opt_options.maxZoom || null;
    this.styles_ = opt_options.styles || [];
    this.title_ = opt_options.title || "";
    this.zoomOnClick_ = true;
    if (opt_options.zoomOnClick !== undefined) {
        this.zoomOnClick_ = opt_options.zoomOnClick;
    }
    this.averageCenter_ = false;
    if (opt_options.averageCenter !== undefined) {
        this.averageCenter_ = opt_options.averageCenter;
    }
    this.ignoreHidden_ = false;
    if (opt_options.ignoreHidden !== undefined) {
        this.ignoreHidden_ = opt_options.ignoreHidden;
    }
    this.enableRetinaIcons_ = false;
    if (opt_options.enableRetinaIcons !== undefined) {
        this.enableRetinaIcons_ = opt_options.enableRetinaIcons;
    }
    this.imagePath_ = opt_options.imagePath || MarkerClusterer.IMAGE_PATH;
    this.imageExtension_ = opt_options.imageExtension || MarkerClusterer.IMAGE_EXTENSION;
    this.imageSizes_ = opt_options.imageSizes || MarkerClusterer.IMAGE_SIZES;
    this.calculator_ = opt_options.calculator || MarkerClusterer.CALCULATOR;
    this.batchSize_ = opt_options.batchSize || MarkerClusterer.BATCH_SIZE;
    this.batchSizeIE_ = opt_options.batchSizeIE || MarkerClusterer.BATCH_SIZE_IE;
    this.clusterClass_ = opt_options.clusterClass || "cluster";

    if (navigator.userAgent.toLowerCase().indexOf("msie") !== -1) {
        // Try to avoid IE timeout when processing a huge number of markers:
        this.batchSize_ = this.batchSizeIE_;
    }

    this.setupStyles_();

    this.addMarkers(opt_markers, true);
    this.setMap(map); // Note: this causes onAdd to be called
}


/**
 * Implementation of the onAdd interface method.
 * @ignore
 */
MarkerClusterer.prototype.onAdd = function() {
    var cMarkerClusterer = this;

    this.activeMap_ = this.getMap();
    this.ready_ = true;

    this.repaint();

    // Add the map event listeners
    this.listeners_ = [
        google.maps.event.addListener(this.getMap(), "zoom_changed", function() {
            cMarkerClusterer.resetViewport_(false);
            // Workaround for this Google bug: when map is at level 0 and "-" of
            // zoom slider is clicked, a "zoom_changed" event is fired even though
            // the map doesn't zoom out any further. In this situation, no "idle"
            // event is triggered so the cluster markers that have been removed
            // do not get redrawn. Same goes for a zoom in at maxZoom.
            if (this.getZoom() === (this.get("minZoom") || 0) || this.getZoom() === this.get("maxZoom")) {
                google.maps.event.trigger(this, "idle");
            }
        }),
        google.maps.event.addListener(this.getMap(), "idle", function() {
            cMarkerClusterer.redraw_();
        })
    ];
};


/**
 * Implementation of the onRemove interface method.
 * Removes map event listeners and all cluster icons from the DOM.
 * All managed markers are also put back on the map.
 * @ignore
 */
MarkerClusterer.prototype.onRemove = function() {
    var i;

    // Put all the managed markers back on the map:
    for (i = 0; i < this.markers_.length; i++) {
        if (this.markers_[i].getMap() !== this.activeMap_) {
            this.markers_[i].setMap(this.activeMap_);
        }
    }

    // Remove all clusters:
    for (i = 0; i < this.clusters_.length; i++) {
        this.clusters_[i].remove();
    }
    this.clusters_ = [];

    // Remove map event listeners:
    for (i = 0; i < this.listeners_.length; i++) {
        google.maps.event.removeListener(this.listeners_[i]);
    }
    this.listeners_ = [];

    this.activeMap_ = null;
    this.ready_ = false;
};


/**
 * Implementation of the draw interface method.
 * @ignore
 */
MarkerClusterer.prototype.draw = function() {};


/**
 * Sets up the styles object.
 */
MarkerClusterer.prototype.setupStyles_ = function() {
    var i, size;
    if (this.styles_.length > 0) {
        return;
    }

    for (i = 0; i < this.imageSizes_.length; i++) {
        size = this.imageSizes_[i];
        this.styles_.push({
            url: this.imagePath_ + (i + 1) + "." + this.imageExtension_,
            height: size,
            width: size
        });
    }
};


/**
 *  Fits the map to the bounds of the markers managed by the clusterer.
 */
MarkerClusterer.prototype.fitMapToMarkers = function() {
    var i;
    var markers = this.getMarkers();
    var bounds = new google.maps.LatLngBounds();
    for (i = 0; i < markers.length; i++) {
        bounds.extend(markers[i].getPosition());
    }

    this.getMap().fitBounds(bounds);
};


/**
 * Returns the value of the <code>gridSize</code> property.
 *
 * @return {number} The grid size.
 */
MarkerClusterer.prototype.getGridSize = function() {
    return this.gridSize_;
};


/**
 * Sets the value of the <code>gridSize</code> property.
 *
 * @param {number} gridSize The grid size.
 */
MarkerClusterer.prototype.setGridSize = function(gridSize) {
    this.gridSize_ = gridSize;
};


/**
 * Returns the value of the <code>minimumClusterSize</code> property.
 *
 * @return {number} The minimum cluster size.
 */
MarkerClusterer.prototype.getMinimumClusterSize = function() {
    return this.minClusterSize_;
};

/**
 * Sets the value of the <code>minimumClusterSize</code> property.
 *
 * @param {number} minimumClusterSize The minimum cluster size.
 */
MarkerClusterer.prototype.setMinimumClusterSize = function(minimumClusterSize) {
    this.minClusterSize_ = minimumClusterSize;
};


/**
 *  Returns the value of the <code>maxZoom</code> property.
 *
 *  @return {number} The maximum zoom level.
 */
MarkerClusterer.prototype.getMaxZoom = function() {
    return this.maxZoom_;
};


/**
 *  Sets the value of the <code>maxZoom</code> property.
 *
 *  @param {number} maxZoom The maximum zoom level.
 */
MarkerClusterer.prototype.setMaxZoom = function(maxZoom) {
    this.maxZoom_ = maxZoom;
};


/**
 *  Returns the value of the <code>styles</code> property.
 *
 *  @return {Array} The array of styles defining the cluster markers to be used.
 */
MarkerClusterer.prototype.getStyles = function() {
    return this.styles_;
};


/**
 *  Sets the value of the <code>styles</code> property.
 *
 *  @param {Array.<ClusterIconStyle>} styles The array of styles to use.
 */
MarkerClusterer.prototype.setStyles = function(styles) {
    this.styles_ = styles;
};


/**
 * Returns the value of the <code>title</code> property.
 *
 * @return {string} The content of the title text.
 */
MarkerClusterer.prototype.getTitle = function() {
    return this.title_;
};


/**
 *  Sets the value of the <code>title</code> property.
 *
 *  @param {string} title The value of the title property.
 */
MarkerClusterer.prototype.setTitle = function(title) {
    this.title_ = title;
};


/**
 * Returns the value of the <code>zoomOnClick</code> property.
 *
 * @return {boolean} True if zoomOnClick property is set.
 */
MarkerClusterer.prototype.getZoomOnClick = function() {
    return this.zoomOnClick_;
};


/**
 *  Sets the value of the <code>zoomOnClick</code> property.
 *
 *  @param {boolean} zoomOnClick The value of the zoomOnClick property.
 */
MarkerClusterer.prototype.setZoomOnClick = function(zoomOnClick) {
    this.zoomOnClick_ = zoomOnClick;
};


/**
 * Returns the value of the <code>averageCenter</code> property.
 *
 * @return {boolean} True if averageCenter property is set.
 */
MarkerClusterer.prototype.getAverageCenter = function() {
    return this.averageCenter_;
};


/**
 *  Sets the value of the <code>averageCenter</code> property.
 *
 *  @param {boolean} averageCenter The value of the averageCenter property.
 */
MarkerClusterer.prototype.setAverageCenter = function(averageCenter) {
    this.averageCenter_ = averageCenter;
};


/**
 * Returns the value of the <code>ignoreHidden</code> property.
 *
 * @return {boolean} True if ignoreHidden property is set.
 */
MarkerClusterer.prototype.getIgnoreHidden = function() {
    return this.ignoreHidden_;
};


/**
 *  Sets the value of the <code>ignoreHidden</code> property.
 *
 *  @param {boolean} ignoreHidden The value of the ignoreHidden property.
 */
MarkerClusterer.prototype.setIgnoreHidden = function(ignoreHidden) {
    this.ignoreHidden_ = ignoreHidden;
};


/**
 * Returns the value of the <code>enableRetinaIcons</code> property.
 *
 * @return {boolean} True if enableRetinaIcons property is set.
 */
MarkerClusterer.prototype.getEnableRetinaIcons = function() {
    return this.enableRetinaIcons_;
};


/**
 *  Sets the value of the <code>enableRetinaIcons</code> property.
 *
 *  @param {boolean} enableRetinaIcons The value of the enableRetinaIcons property.
 */
MarkerClusterer.prototype.setEnableRetinaIcons = function(enableRetinaIcons) {
    this.enableRetinaIcons_ = enableRetinaIcons;
};


/**
 * Returns the value of the <code>imageExtension</code> property.
 *
 * @return {string} The value of the imageExtension property.
 */
MarkerClusterer.prototype.getImageExtension = function() {
    return this.imageExtension_;
};


/**
 *  Sets the value of the <code>imageExtension</code> property.
 *
 *  @param {string} imageExtension The value of the imageExtension property.
 */
MarkerClusterer.prototype.setImageExtension = function(imageExtension) {
    this.imageExtension_ = imageExtension;
};


/**
 * Returns the value of the <code>imagePath</code> property.
 *
 * @return {string} The value of the imagePath property.
 */
MarkerClusterer.prototype.getImagePath = function() {
    return this.imagePath_;
};


/**
 *  Sets the value of the <code>imagePath</code> property.
 *
 *  @param {string} imagePath The value of the imagePath property.
 */
MarkerClusterer.prototype.setImagePath = function(imagePath) {
    this.imagePath_ = imagePath;
};


/**
 * Returns the value of the <code>imageSizes</code> property.
 *
 * @return {Array} The value of the imageSizes property.
 */
MarkerClusterer.prototype.getImageSizes = function() {
    return this.imageSizes_;
};


/**
 *  Sets the value of the <code>imageSizes</code> property.
 *
 *  @param {Array} imageSizes The value of the imageSizes property.
 */
MarkerClusterer.prototype.setImageSizes = function(imageSizes) {
    this.imageSizes_ = imageSizes;
};


/**
 * Returns the value of the <code>calculator</code> property.
 *
 * @return {function} the value of the calculator property.
 */
MarkerClusterer.prototype.getCalculator = function() {
    return this.calculator_;
};


/**
 * Sets the value of the <code>calculator</code> property.
 *
 * @param {function(Array.<google.maps.Marker>, number)} calculator The value
 *  of the calculator property.
 */
MarkerClusterer.prototype.setCalculator = function(calculator) {
    this.calculator_ = calculator;
};


/**
 * Returns the value of the <code>batchSizeIE</code> property.
 *
 * @return {number} the value of the batchSizeIE property.
 */
MarkerClusterer.prototype.getBatchSizeIE = function() {
    return this.batchSizeIE_;
};


/**
 * Sets the value of the <code>batchSizeIE</code> property.
 *
 *  @param {number} batchSizeIE The value of the batchSizeIE property.
 */
MarkerClusterer.prototype.setBatchSizeIE = function(batchSizeIE) {
    this.batchSizeIE_ = batchSizeIE;
};


/**
 * Returns the value of the <code>clusterClass</code> property.
 *
 * @return {string} the value of the clusterClass property.
 */
MarkerClusterer.prototype.getClusterClass = function() {
    return this.clusterClass_;
};


/**
 * Sets the value of the <code>clusterClass</code> property.
 *
 *  @param {string} clusterClass The value of the clusterClass property.
 */
MarkerClusterer.prototype.setClusterClass = function(clusterClass) {
    this.clusterClass_ = clusterClass;
};


/**
 *  Returns the array of markers managed by the clusterer.
 *
 *  @return {Array} The array of markers managed by the clusterer.
 */
MarkerClusterer.prototype.getMarkers = function() {
    return this.markers_;
};


/**
 *  Returns the number of markers managed by the clusterer.
 *
 *  @return {number} The number of markers.
 */
MarkerClusterer.prototype.getTotalMarkers = function() {
    return this.markers_.length;
};


/**
 * Returns the current array of clusters formed by the clusterer.
 *
 * @return {Array} The array of clusters formed by the clusterer.
 */
MarkerClusterer.prototype.getClusters = function() {
    return this.clusters_;
};


/**
 * Returns the number of clusters formed by the clusterer.
 *
 * @return {number} The number of clusters formed by the clusterer.
 */
MarkerClusterer.prototype.getTotalClusters = function() {
    return this.clusters_.length;
};


/**
 * Adds a marker to the clusterer. The clusters are redrawn unless
 *  <code>opt_nodraw</code> is set to <code>true</code>.
 *
 * @param {google.maps.Marker} marker The marker to add.
 * @param {boolean} [opt_nodraw] Set to <code>true</code> to prevent redrawing.
 */
MarkerClusterer.prototype.addMarker = function(marker, opt_nodraw) {
    this.pushMarkerTo_(marker);
    if (!opt_nodraw) {
        this.redraw_();
    }
};


/**
 * Adds an array of markers to the clusterer. The clusters are redrawn unless
 *  <code>opt_nodraw</code> is set to <code>true</code>.
 *
 * @param {Array.<google.maps.Marker>} markers The markers to add.
 * @param {boolean} [opt_nodraw] Set to <code>true</code> to prevent redrawing.
 */
MarkerClusterer.prototype.addMarkers = function(markers, opt_nodraw) {
    var key;
    for (key in markers) {
        if (markers.hasOwnProperty(key)) {
            this.pushMarkerTo_(markers[key]);
        }
    }
    if (!opt_nodraw) {
        this.redraw_();
    }
};


/**
 * Pushes a marker to the clusterer.
 *
 * @param {google.maps.Marker} marker The marker to add.
 */
MarkerClusterer.prototype.pushMarkerTo_ = function(marker) {
    // If the marker is draggable add a listener so we can update the clusters on the dragend:
    if (marker.getDraggable()) {
        var cMarkerClusterer = this;
        google.maps.event.addListener(marker, "dragend", function() {
            if (cMarkerClusterer.ready_) {
                this.isAdded = false;
                cMarkerClusterer.repaint();
            }
        });
    }
    marker.isAdded = false;
    this.markers_.push(marker);
};


/**
 * Removes a marker from the cluster.  The clusters are redrawn unless
 *  <code>opt_nodraw</code> is set to <code>true</code>. Returns <code>true</code> if the
 *  marker was removed from the clusterer.
 *
 * @param {google.maps.Marker} marker The marker to remove.
 * @param {boolean} [opt_nodraw] Set to <code>true</code> to prevent redrawing.
 * @return {boolean} True if the marker was removed from the clusterer.
 */
MarkerClusterer.prototype.removeMarker = function(marker, opt_nodraw) {
    var removed = this.removeMarker_(marker);

    if (!opt_nodraw && removed) {
        this.repaint();
    }

    return removed;
};


/**
 * Removes an array of markers from the cluster. The clusters are redrawn unless
 *  <code>opt_nodraw</code> is set to <code>true</code>. Returns <code>true</code> if markers
 *  were removed from the clusterer.
 *
 * @param {Array.<google.maps.Marker>} markers The markers to remove.
 * @param {boolean} [opt_nodraw] Set to <code>true</code> to prevent redrawing.
 * @return {boolean} True if markers were removed from the clusterer.
 */
MarkerClusterer.prototype.removeMarkers = function(markers, opt_nodraw) {
    var i, r;
    var removed = false;

    for (i = 0; i < markers.length; i++) {
        r = this.removeMarker_(markers[i]);
        removed = removed || r;
    }

    if (!opt_nodraw && removed) {
        this.repaint();
    }

    return removed;
};


/**
 * Removes a marker and returns true if removed, false if not.
 *
 * @param {google.maps.Marker} marker The marker to remove
 * @return {boolean} Whether the marker was removed or not
 */
MarkerClusterer.prototype.removeMarker_ = function(marker) {
    var i;
    var index = -1;
    if (this.markers_.indexOf) {
        index = this.markers_.indexOf(marker);
    } else {
        for (i = 0; i < this.markers_.length; i++) {
            if (marker === this.markers_[i]) {
                index = i;
                break;
            }
        }
    }

    if (index === -1) {
        // Marker is not in our list of markers, so do nothing:
        return false;
    }

    marker.setMap(null);
    this.markers_.splice(index, 1); // Remove the marker from the list of managed markers
    return true;
};


/**
 * Removes all clusters and markers from the map and also removes all markers
 *  managed by the clusterer.
 */
MarkerClusterer.prototype.clearMarkers = function() {
    this.resetViewport_(true);
    this.markers_ = [];
};


/**
 * Recalculates and redraws all the marker clusters from scratch.
 *  Call this after changing any properties.
 */
MarkerClusterer.prototype.repaint = function() {
    var oldClusters = this.clusters_.slice();
    this.clusters_ = [];
    this.resetViewport_(false);
    this.redraw_();

    // Remove the old clusters.
    // Do it in a timeout to prevent blinking effect.
    setTimeout(function() {
        var i;
        for (i = 0; i < oldClusters.length; i++) {
            oldClusters[i].remove();
        }
    }, 0);
};


/**
 * Returns the current bounds extended by the grid size.
 *
 * @param {google.maps.LatLngBounds} bounds The bounds to extend.
 * @return {google.maps.LatLngBounds} The extended bounds.
 * @ignore
 */
MarkerClusterer.prototype.getExtendedBounds = function(bounds) {
    var projection = this.getProjection();

    // Turn the bounds into latlng.
    var tr = new google.maps.LatLng(bounds.getNorthEast().lat(),
        bounds.getNorthEast().lng());
    var bl = new google.maps.LatLng(bounds.getSouthWest().lat(),
        bounds.getSouthWest().lng());

    // Convert the points to pixels and the extend out by the grid size.
    var trPix = projection.fromLatLngToDivPixel(tr);
    trPix.x += this.gridSize_;
    trPix.y -= this.gridSize_;

    var blPix = projection.fromLatLngToDivPixel(bl);
    blPix.x -= this.gridSize_;
    blPix.y += this.gridSize_;

    // Convert the pixel points back to LatLng
    var ne = projection.fromDivPixelToLatLng(trPix);
    var sw = projection.fromDivPixelToLatLng(blPix);

    // Extend the bounds to contain the new bounds.
    bounds.extend(ne);
    bounds.extend(sw);

    return bounds;
};


/**
 * Redraws all the clusters.
 */
MarkerClusterer.prototype.redraw_ = function() {
    this.createClusters_(0);
};


/**
 * Removes all clusters from the map. The markers are also removed from the map
 *  if <code>opt_hide</code> is set to <code>true</code>.
 *
 * @param {boolean} [opt_hide] Set to <code>true</code> to also remove the markers
 *  from the map.
 */
MarkerClusterer.prototype.resetViewport_ = function(opt_hide) {
    var i, marker;
    // Remove all the clusters
    for (i = 0; i < this.clusters_.length; i++) {
        this.clusters_[i].remove();
    }
    this.clusters_ = [];

    // Reset the markers to not be added and to be removed from the map.
    for (i = 0; i < this.markers_.length; i++) {
        marker = this.markers_[i];
        marker.isAdded = false;
        if (opt_hide) {
            marker.setMap(null);
        }
    }
};


/**
 * Calculates the distance between two latlng locations in km.
 *
 * @param {google.maps.LatLng} p1 The first lat lng point.
 * @param {google.maps.LatLng} p2 The second lat lng point.
 * @return {number} The distance between the two points in km.
 * @see http://www.movable-type.co.uk/scripts/latlong.html
 */
MarkerClusterer.prototype.distanceBetweenPoints_ = function(p1, p2) {
    var R = 6371; // Radius of the Earth in km
    var dLat = (p2.lat() - p1.lat()) * Math.PI / 180;
    var dLon = (p2.lng() - p1.lng()) * Math.PI / 180;
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(p1.lat() * Math.PI / 180) * Math.cos(p2.lat() * Math.PI / 180) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c;
    return d;
};


/**
 * Determines if a marker is contained in a bounds.
 *
 * @param {google.maps.Marker} marker The marker to check.
 * @param {google.maps.LatLngBounds} bounds The bounds to check against.
 * @return {boolean} True if the marker is in the bounds.
 */
MarkerClusterer.prototype.isMarkerInBounds_ = function(marker, bounds) {
    return bounds.contains(marker.getPosition());
};


/**
 * Adds a marker to a cluster, or creates a new cluster.
 *
 * @param {google.maps.Marker} marker The marker to add.
 */
MarkerClusterer.prototype.addToClosestCluster_ = function(marker) {
    var i, d, cluster, center;
    var distance = 40000; // Some large number
    var clusterToAddTo = null;
    for (i = 0; i < this.clusters_.length; i++) {
        cluster = this.clusters_[i];
        center = cluster.getCenter();
        if (center) {
            d = this.distanceBetweenPoints_(center, marker.getPosition());
            if (d < distance) {
                distance = d;
                clusterToAddTo = cluster;
            }
        }
    }

    if (clusterToAddTo && clusterToAddTo.isMarkerInClusterBounds(marker)) {
        clusterToAddTo.addMarker(marker);
    } else {
        cluster = new Cluster(this);
        cluster.addMarker(marker);
        this.clusters_.push(cluster);
    }
};


/**
 * Creates the clusters. This is done in batches to avoid timeout errors
 *  in some browsers when there is a huge number of markers.
 *
 * @param {number} iFirst The index of the first marker in the batch of
 *  markers to be added to clusters.
 */
MarkerClusterer.prototype.createClusters_ = function(iFirst) {
    var i, marker;
    var mapBounds;
    var cMarkerClusterer = this;
    if (!this.ready_) {
        return;
    }

    // Cancel previous batch processing if we're working on the first batch:
    if (iFirst === 0) {
        /**
         * This event is fired when the <code>MarkerClusterer</code> begins
         *  clustering markers.
         * @name MarkerClusterer#clusteringbegin
         * @param {MarkerClusterer} mc The MarkerClusterer whose markers are being clustered.
         * @event
         */
        google.maps.event.trigger(this, "clusteringbegin", this);

        if (typeof this.timerRefStatic !== "undefined") {
            clearTimeout(this.timerRefStatic);
            delete this.timerRefStatic;
        }
    }

    // Get our current map view bounds.
    // Create a new bounds object so we don't affect the map.
    //
    // See Comments 9 & 11 on Issue 3651 relating to this workaround for a Google Maps bug:
    if (this.getMap().getZoom() > 3) {
        mapBounds = new google.maps.LatLngBounds(this.getMap().getBounds().getSouthWest(),
            this.getMap().getBounds().getNorthEast());
    } else {
        mapBounds = new google.maps.LatLngBounds(new google.maps.LatLng(85.02070771743472, -178.48388434375), new google.maps.LatLng(-85.08136444384544, 178.00048865625));
    }
    var bounds = this.getExtendedBounds(mapBounds);

    var iLast = Math.min(iFirst + this.batchSize_, this.markers_.length);

    for (i = iFirst; i < iLast; i++) {
        marker = this.markers_[i];
        if (!marker.isAdded && this.isMarkerInBounds_(marker, bounds)) {
            if (!this.ignoreHidden_ || (this.ignoreHidden_ && marker.getVisible())) {
                this.addToClosestCluster_(marker);
            }
        }
    }

    if (iLast < this.markers_.length) {
        this.timerRefStatic = setTimeout(function() {
            cMarkerClusterer.createClusters_(iLast);
        }, 0);
    } else {
        delete this.timerRefStatic;

        /**
         * This event is fired when the <code>MarkerClusterer</code> stops
         *  clustering markers.
         * @name MarkerClusterer#clusteringend
         * @param {MarkerClusterer} mc The MarkerClusterer whose markers are being clustered.
         * @event
         */
        google.maps.event.trigger(this, "clusteringend", this);
    }
};


/**
 * Extends an object's prototype by another's.
 *
 * @param {Object} obj1 The object to be extended.
 * @param {Object} obj2 The object to extend with.
 * @return {Object} The new extended object.
 * @ignore
 */
MarkerClusterer.prototype.extend = function(obj1, obj2) {
    return (function(object) {
        var property;
        for (property in object.prototype) {
            this.prototype[property] = object.prototype[property];
        }
        return this;
    }).apply(obj1, [obj2]);
};


/**
 * The default function for determining the label text and style
 * for a cluster icon.
 *
 * @param {Array.<google.maps.Marker>} markers The array of markers represented by the cluster.
 * @param {number} numStyles The number of marker styles available.
 * @return {ClusterIconInfo} The information resource for the cluster.
 * @constant
 * @ignore
 */
MarkerClusterer.CALCULATOR = function(markers, numStyles) {
    var index = 0;
    var title = "";
    var count = markers.length.toString();

    var dv = count;
    while (dv !== 0) {
        dv = parseInt(dv / 10, 10);
        index++;
    }

    index = Math.min(index, numStyles);
    return {
        text: count,
        index: index,
        title: title
    };
};


/**
 * The number of markers to process in one batch.
 *
 * @type {number}
 * @constant
 */
MarkerClusterer.BATCH_SIZE = 2000;


/**
 * The number of markers to process in one batch (IE only).
 *
 * @type {number}
 * @constant
 */
MarkerClusterer.BATCH_SIZE_IE = 500;


/**
 * The default root name for the marker cluster images.
 *
 * @type {string}
 * @constant
 */
MarkerClusterer.IMAGE_PATH = "http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclustererplus/images/m";


/**
 * The default extension name for the marker cluster images.
 *
 * @type {string}
 * @constant
 */
MarkerClusterer.IMAGE_EXTENSION = "png";


/**
 * The default array of sizes for the marker cluster images.
 *
 * @type {Array.<number>}
 * @constant
 */
MarkerClusterer.IMAGE_SIZES = [53, 56, 66, 78, 90];

/*!
 DataTables 1.10.8
 Â©2008-2014 SpryMedia Ltd - datatables.net/license
*/
(function(Fa, T, k) {
    var S = function(g) {
        function X(a) {
            var b, c, d = {};
            g.each(a, function(e) {
                if ((b = e.match(/^([^A-Z]+?)([A-Z])/)) && -1 !== "a aa ai ao as b fn i m o s ".indexOf(b[1] + " ")) c = e.replace(b[0], b[2].toLowerCase()), d[c] = e, "o" === b[1] && X(a[e])
            });
            a._hungarianMap = d
        }

        function I(a, b, c) {
            a._hungarianMap || X(a);
            var d;
            g.each(b, function(e) {
                d = a._hungarianMap[e];
                if (d !== k && (c || b[d] === k)) "o" === d.charAt(0) ? (b[d] || (b[d] = {}), g.extend(!0, b[d], b[e]), I(a[d], b[d], c)) : b[d] = b[e]
            })
        }

        function S(a) {
            var b = m.defaults.oLanguage,
                c = a.sZeroRecords;
            !a.sEmptyTable && (c && "No data available in table" === b.sEmptyTable) && F(a, a, "sZeroRecords", "sEmptyTable");
            !a.sLoadingRecords && (c && "Loading..." === b.sLoadingRecords) && F(a, a, "sZeroRecords", "sLoadingRecords");
            a.sInfoThousands && (a.sThousands = a.sInfoThousands);
            (a = a.sDecimal) && db(a)
        }

        function eb(a) {
            B(a, "ordering", "bSort");
            B(a, "orderMulti", "bSortMulti");
            B(a, "orderClasses", "bSortClasses");
            B(a, "orderCellsTop", "bSortCellsTop");
            B(a, "order", "aaSorting");
            B(a, "orderFixed", "aaSortingFixed");
            B(a, "paging", "bPaginate");
            B(a, "pagingType", "sPaginationType");
            B(a, "pageLength", "iDisplayLength");
            B(a, "searching", "bFilter");
            "boolean" === typeof a.sScrollX && (a.sScrollX = a.sScrollX ? "100%" : "");
            if (a = a.aoSearchCols)
                for (var b = 0, c = a.length; b < c; b++) a[b] && I(m.models.oSearch, a[b])
        }

        function fb(a) {
            B(a, "orderable", "bSortable");
            B(a, "orderData", "aDataSort");
            B(a, "orderSequence", "asSorting");
            B(a, "orderDataType", "sortDataType");
            var b = a.aDataSort;
            b && !g.isArray(b) && (a.aDataSort = [b])
        }

        function gb(a) {
            var a = a.oBrowser,
                b = g("<div/>").css({
                    position: "fixed",
                    top: 0,
                    left: 0,
                    height: 1,
                    width: 1,
                    overflow: "hidden"
                }).append(g("<div/>").css({
                    position: "absolute",
                    top: 1,
                    left: 1,
                    width: 100,
                    overflow: "scroll"
                }).append(g('<div class="test"/>').css({
                    width: "100%",
                    height: 10
                }))).appendTo("body"),
                c = b.find(".test");
            a.bScrollOversize = 100 === c[0].offsetWidth;
            a.bScrollbarLeft = 1 !== Math.round(c.offset().left);
            a.bBounding = b[0].getBoundingClientRect().width ? !0 : !1;
            b.remove()
        }

        function hb(a, b, c, d, e, f) {
            var h, i = !1;
            c !== k && (h = c, i = !0);
            for (; d !== e;) a.hasOwnProperty(d) && (h = i ? b(h, a[d], d, a) : a[d],
                i = !0, d += f);
            return h
        }

        function Ga(a, b) {
            var c = m.defaults.column,
                d = a.aoColumns.length,
                c = g.extend({}, m.models.oColumn, c, {
                    nTh: b ? b : T.createElement("th"),
                    sTitle: c.sTitle ? c.sTitle : b ? b.innerHTML : "",
                    aDataSort: c.aDataSort ? c.aDataSort : [d],
                    mData: c.mData ? c.mData : d,
                    idx: d
                });
            a.aoColumns.push(c);
            c = a.aoPreSearchCols;
            c[d] = g.extend({}, m.models.oSearch, c[d]);
            ka(a, d, g(b).data())
        }

        function ka(a, b, c) {
            var b = a.aoColumns[b],
                d = a.oClasses,
                e = g(b.nTh);
            if (!b.sWidthOrig) {
                b.sWidthOrig = e.attr("width") || null;
                var f = (e.attr("style") || "").match(/width:\s*(\d+[pxem%]+)/);
                f && (b.sWidthOrig = f[1])
            }
            c !== k && null !== c && (fb(c), I(m.defaults.column, c), c.mDataProp !== k && !c.mData && (c.mData = c.mDataProp), c.sType && (b._sManualType = c.sType), c.className && !c.sClass && (c.sClass = c.className), g.extend(b, c), F(b, c, "sWidth", "sWidthOrig"), c.iDataSort !== k && (b.aDataSort = [c.iDataSort]), F(b, c, "aDataSort"));
            var h = b.mData,
                i = P(h),
                j = b.mRender ? P(b.mRender) : null,
                c = function(a) {
                    return "string" === typeof a && -1 !== a.indexOf("@")
                };
            b._bAttrSrc = g.isPlainObject(h) && (c(h.sort) || c(h.type) || c(h.filter));
            b.fnGetData =
                function(a, b, c) {
                    var d = i(a, b, k, c);
                    return j && b ? j(d, b, a, c) : d
                };
            b.fnSetData = function(a, b, c) {
                return Q(h)(a, b, c)
            };
            "number" !== typeof h && (a._rowReadObject = !0);
            a.oFeatures.bSort || (b.bSortable = !1, e.addClass(d.sSortableNone));
            a = -1 !== g.inArray("asc", b.asSorting);
            c = -1 !== g.inArray("desc", b.asSorting);
            !b.bSortable || !a && !c ? (b.sSortingClass = d.sSortableNone, b.sSortingClassJUI = "") : a && !c ? (b.sSortingClass = d.sSortableAsc, b.sSortingClassJUI = d.sSortJUIAscAllowed) : !a && c ? (b.sSortingClass = d.sSortableDesc, b.sSortingClassJUI =
                d.sSortJUIDescAllowed) : (b.sSortingClass = d.sSortable, b.sSortingClassJUI = d.sSortJUI)
        }

        function Y(a) {
            if (!1 !== a.oFeatures.bAutoWidth) {
                var b = a.aoColumns;
                Ha(a);
                for (var c = 0, d = b.length; c < d; c++) b[c].nTh.style.width = b[c].sWidth
            }
            b = a.oScroll;
            ("" !== b.sY || "" !== b.sX) && Z(a);
            w(a, null, "column-sizing", [a])
        }

        function la(a, b) {
            var c = $(a, "bVisible");
            return "number" === typeof c[b] ? c[b] : null
        }

        function aa(a, b) {
            var c = $(a, "bVisible"),
                c = g.inArray(b, c);
            return -1 !== c ? c : null
        }

        function ba(a) {
            return $(a, "bVisible").length
        }

        function $(a, b) {
            var c = [];
            g.map(a.aoColumns, function(a, e) {
                a[b] && c.push(e)
            });
            return c
        }

        function Ia(a) {
            var b = a.aoColumns,
                c = a.aoData,
                d = m.ext.type.detect,
                e, f, h, i, j, g, l, r, q;
            e = 0;
            for (f = b.length; e < f; e++)
                if (l = b[e], q = [], !l.sType && l._sManualType) l.sType = l._sManualType;
                else if (!l.sType) {
                h = 0;
                for (i = d.length; h < i; h++) {
                    j = 0;
                    for (g = c.length; j < g; j++) {
                        q[j] === k && (q[j] = y(a, j, e, "type"));
                        r = d[h](q[j], a);
                        if (!r && h !== d.length - 1) break;
                        if ("html" === r) break
                    }
                    if (r) {
                        l.sType = r;
                        break
                    }
                }
                l.sType || (l.sType = "string")
            }
        }

        function ib(a, b, c, d) {
            var e, f, h, i, j, n, l = a.aoColumns;
            if (b)
                for (e = b.length - 1; 0 <= e; e--) {
                    n = b[e];
                    var r = n.targets !== k ? n.targets : n.aTargets;
                    g.isArray(r) || (r = [r]);
                    f = 0;
                    for (h = r.length; f < h; f++)
                        if ("number" === typeof r[f] && 0 <= r[f]) {
                            for (; l.length <= r[f];) Ga(a);
                            d(r[f], n)
                        } else if ("number" === typeof r[f] && 0 > r[f]) d(l.length + r[f], n);
                    else if ("string" === typeof r[f]) {
                        i = 0;
                        for (j = l.length; i < j; i++)("_all" == r[f] || g(l[i].nTh).hasClass(r[f])) && d(i, n)
                    }
                }
            if (c) {
                e = 0;
                for (a = c.length; e < a; e++) d(e, c[e])
            }
        }

        function L(a, b, c, d) {
            var e = a.aoData.length,
                f = g.extend(!0, {}, m.models.oRow, {
                    src: c ? "dom" : "data",
                    idx: e
                });
            f._aData = b;
            a.aoData.push(f);
            for (var h = a.aoColumns, i = 0, j = h.length; i < j; i++) c && Ja(a, e, i, y(a, e, i)), h[i].sType = null;
            a.aiDisplayMaster.push(e);
            b = a.rowIdFn(b);
            b !== k && (a.aIds[b] = f);
            (c || !a.oFeatures.bDeferRender) && Ka(a, e, c, d);
            return e
        }

        function ma(a, b) {
            var c;
            b instanceof g || (b = g(b));
            return b.map(function(b, e) {
                c = na(a, e);
                return L(a, c.data, e, c.cells)
            })
        }

        function y(a, b, c, d) {
            var e = a.iDraw,
                f = a.aoColumns[c],
                h = a.aoData[b]._aData,
                i = f.sDefaultContent,
                c = f.fnGetData(h, d, {
                    settings: a,
                    row: b,
                    col: c
                });
            if (c === k) return a.iDrawError !=
                e && null === i && (J(a, 0, "Requested unknown parameter " + ("function" == typeof f.mData ? "{function}" : "'" + f.mData + "'") + " for row " + b, 4), a.iDrawError = e), i;
            if ((c === h || null === c) && null !== i) c = i;
            else if ("function" === typeof c) return c.call(h);
            return null === c && "display" == d ? "" : c
        }

        function Ja(a, b, c, d) {
            a.aoColumns[c].fnSetData(a.aoData[b]._aData, d, {
                settings: a,
                row: b,
                col: c
            })
        }

        function La(a) {
            return g.map(a.match(/(\\.|[^\.])+/g) || [""], function(a) {
                return a.replace(/\\./g, ".")
            })
        }

        function P(a) {
            if (g.isPlainObject(a)) {
                var b = {};
                g.each(a, function(a, c) {
                    c && (b[a] = P(c))
                });
                return function(a, c, f, h) {
                    var i = b[c] || b._;
                    return i !== k ? i(a, c, f, h) : a
                }
            }
            if (null === a) return function(a) {
                return a
            };
            if ("function" === typeof a) return function(b, c, f, h) {
                return a(b, c, f, h)
            };
            if ("string" === typeof a && (-1 !== a.indexOf(".") || -1 !== a.indexOf("[") || -1 !== a.indexOf("("))) {
                var c = function(a, b, f) {
                    var h, i;
                    if ("" !== f) {
                        i = La(f);
                        for (var j = 0, g = i.length; j < g; j++) {
                            f = i[j].match(ca);
                            h = i[j].match(U);
                            if (f) {
                                i[j] = i[j].replace(ca, "");
                                "" !== i[j] && (a = a[i[j]]);
                                h = [];
                                i.splice(0, j + 1);
                                i = i.join(".");
                                j = 0;
                                for (g = a.length; j < g; j++) h.push(c(a[j], b, i));
                                a = f[0].substring(1, f[0].length - 1);
                                a = "" === a ? h : h.join(a);
                                break
                            } else if (h) {
                                i[j] = i[j].replace(U, "");
                                a = a[i[j]]();
                                continue
                            }
                            if (null === a || a[i[j]] === k) return k;
                            a = a[i[j]]
                        }
                    }
                    return a
                };
                return function(b, e) {
                    return c(b, e, a)
                }
            }
            return function(b) {
                return b[a]
            }
        }

        function Q(a) {
            if (g.isPlainObject(a)) return Q(a._);
            if (null === a) return function() {};
            if ("function" === typeof a) return function(b, d, e) {
                a(b, "set", d, e)
            };
            if ("string" === typeof a && (-1 !== a.indexOf(".") || -1 !== a.indexOf("[") ||
                    -1 !== a.indexOf("("))) {
                var b = function(a, d, e) {
                    var e = La(e),
                        f;
                    f = e[e.length - 1];
                    for (var h, i, j = 0, g = e.length - 1; j < g; j++) {
                        h = e[j].match(ca);
                        i = e[j].match(U);
                        if (h) {
                            e[j] = e[j].replace(ca, "");
                            a[e[j]] = [];
                            f = e.slice();
                            f.splice(0, j + 1);
                            h = f.join(".");
                            i = 0;
                            for (g = d.length; i < g; i++) f = {}, b(f, d[i], h), a[e[j]].push(f);
                            return
                        }
                        i && (e[j] = e[j].replace(U, ""), a = a[e[j]](d));
                        if (null === a[e[j]] || a[e[j]] === k) a[e[j]] = {};
                        a = a[e[j]]
                    }
                    if (f.match(U)) a[f.replace(U, "")](d);
                    else a[f.replace(ca, "")] = d
                };
                return function(c, d) {
                    return b(c, d, a)
                }
            }
            return function(b,
                d) {
                b[a] = d
            }
        }

        function Ma(a) {
            return D(a.aoData, "_aData")
        }

        function oa(a) {
            a.aoData.length = 0;
            a.aiDisplayMaster.length = 0;
            a.aiDisplay.length = 0
        }

        function pa(a, b, c) {
            for (var d = -1, e = 0, f = a.length; e < f; e++) a[e] == b ? d = e : a[e] > b && a[e]--; - 1 != d && c === k && a.splice(d, 1)
        }

        function da(a, b, c, d) {
            var e = a.aoData[b],
                f, h = function(c, f) {
                    for (; c.childNodes.length;) c.removeChild(c.firstChild);
                    c.innerHTML = y(a, b, f, "display")
                };
            if ("dom" === c || (!c || "auto" === c) && "dom" === e.src) e._aData = na(a, e, d, d === k ? k : e._aData).data;
            else {
                var i = e.anCells;
                if (i)
                    if (d !==
                        k) h(i[d], d);
                    else {
                        c = 0;
                        for (f = i.length; c < f; c++) h(i[c], c)
                    }
            }
            e._aSortData = null;
            e._aFilterData = null;
            h = a.aoColumns;
            if (d !== k) h[d].sType = null;
            else {
                c = 0;
                for (f = h.length; c < f; c++) h[c].sType = null;
                Na(a, e)
            }
        }

        function na(a, b, c, d) {
            var e = [],
                f = b.firstChild,
                h, i, j = 0,
                n, l = a.aoColumns,
                r = a._rowReadObject,
                d = d || r ? {} : [],
                q = function(a, b) {
                    if ("string" === typeof a) {
                        var c = a.indexOf("@"); - 1 !== c && (c = a.substring(c + 1), Q(a)(d, b.getAttribute(c)))
                    }
                },
                jb = function(a) {
                    if (c === k || c === j) i = l[j], n = g.trim(a.innerHTML), i && i._bAttrSrc ? (Q(i.mData._)(d, n),
                        q(i.mData.sort, a), q(i.mData.type, a), q(i.mData.filter, a)) : r ? (i._setter || (i._setter = Q(i.mData)), i._setter(d, n)) : d[j] = n;
                    j++
                };
            if (f)
                for (; f;) {
                    h = f.nodeName.toUpperCase();
                    if ("TD" == h || "TH" == h) jb(f), e.push(f);
                    f = f.nextSibling
                } else {
                    e = b.anCells;
                    f = 0;
                    for (h = e.length; f < h; f++) jb(e[f])
                }(b = b.getAttribute("id")) && Q(a.rowId)(d, b);
            return {
                data: d,
                cells: e
            }
        }

        function Ka(a, b, c, d) {
            var e = a.aoData[b],
                f = e._aData,
                h = [],
                i, j, g, l, r;
            if (null === e.nTr) {
                i = c || T.createElement("tr");
                e.nTr = i;
                e.anCells = h;
                i._DT_RowIndex = b;
                Na(a, e);
                l = 0;
                for (r = a.aoColumns.length; l <
                    r; l++) {
                    g = a.aoColumns[l];
                    j = c ? d[l] : T.createElement(g.sCellType);
                    h.push(j);
                    if (!c || g.mRender || g.mData !== l) j.innerHTML = y(a, b, l, "display");
                    g.sClass && (j.className += " " + g.sClass);
                    g.bVisible && !c ? i.appendChild(j) : !g.bVisible && c && j.parentNode.removeChild(j);
                    g.fnCreatedCell && g.fnCreatedCell.call(a.oInstance, j, y(a, b, l), f, b, l)
                }
                w(a, "aoRowCreatedCallback", null, [i, f, b])
            }
            e.nTr.setAttribute("role", "row")
        }

        function Na(a, b) {
            var c = b.nTr,
                d = b._aData;
            if (c) {
                var e = a.rowIdFn(d);
                e && (c.id = e);
                d.DT_RowClass && (e = d.DT_RowClass.split(" "),
                    b.__rowc = b.__rowc ? Oa(b.__rowc.concat(e)) : e, g(c).removeClass(b.__rowc.join(" ")).addClass(d.DT_RowClass));
                d.DT_RowAttr && g(c).attr(d.DT_RowAttr);
                d.DT_RowData && g(c).data(d.DT_RowData)
            }
        }

        function kb(a) {
            var b, c, d, e, f, h = a.nTHead,
                i = a.nTFoot,
                j = 0 === g("th, td", h).length,
                n = a.oClasses,
                l = a.aoColumns;
            j && (e = g("<tr/>").appendTo(h));
            b = 0;
            for (c = l.length; b < c; b++) f = l[b], d = g(f.nTh).addClass(f.sClass), j && d.appendTo(e), a.oFeatures.bSort && (d.addClass(f.sSortingClass), !1 !== f.bSortable && (d.attr("tabindex", a.iTabIndex).attr("aria-controls",
                a.sTableId), Pa(a, f.nTh, b))), f.sTitle != d[0].innerHTML && d.html(f.sTitle), Qa(a, "header")(a, d, f, n);
            j && ea(a.aoHeader, h);
            g(h).find(">tr").attr("role", "row");
            g(h).find(">tr>th, >tr>td").addClass(n.sHeaderTH);
            g(i).find(">tr>th, >tr>td").addClass(n.sFooterTH);
            if (null !== i) {
                a = a.aoFooter[0];
                b = 0;
                for (c = a.length; b < c; b++) f = l[b], f.nTf = a[b].cell, f.sClass && g(f.nTf).addClass(f.sClass)
            }
        }

        function fa(a, b, c) {
            var d, e, f, h = [],
                i = [],
                j = a.aoColumns.length,
                n;
            if (b) {
                c === k && (c = !1);
                d = 0;
                for (e = b.length; d < e; d++) {
                    h[d] = b[d].slice();
                    h[d].nTr =
                        b[d].nTr;
                    for (f = j - 1; 0 <= f; f--) !a.aoColumns[f].bVisible && !c && h[d].splice(f, 1);
                    i.push([])
                }
                d = 0;
                for (e = h.length; d < e; d++) {
                    if (a = h[d].nTr)
                        for (; f = a.firstChild;) a.removeChild(f);
                    f = 0;
                    for (b = h[d].length; f < b; f++)
                        if (n = j = 1, i[d][f] === k) {
                            a.appendChild(h[d][f].cell);
                            for (i[d][f] = 1; h[d + j] !== k && h[d][f].cell == h[d + j][f].cell;) i[d + j][f] = 1, j++;
                            for (; h[d][f + n] !== k && h[d][f].cell == h[d][f + n].cell;) {
                                for (c = 0; c < j; c++) i[d + c][f + n] = 1;
                                n++
                            }
                            g(h[d][f].cell).attr("rowspan", j).attr("colspan", n)
                        }
                }
            }
        }

        function M(a) {
            var b = w(a, "aoPreDrawCallback",
                "preDraw", [a]);
            if (-1 !== g.inArray(!1, b)) C(a, !1);
            else {
                var b = [],
                    c = 0,
                    d = a.asStripeClasses,
                    e = d.length,
                    f = a.oLanguage,
                    h = a.iInitDisplayStart,
                    i = "ssp" == z(a),
                    j = a.aiDisplay;
                a.bDrawing = !0;
                h !== k && -1 !== h && (a._iDisplayStart = i ? h : h >= a.fnRecordsDisplay() ? 0 : h, a.iInitDisplayStart = -1);
                var h = a._iDisplayStart,
                    n = a.fnDisplayEnd();
                if (a.bDeferLoading) a.bDeferLoading = !1, a.iDraw++, C(a, !1);
                else if (i) {
                    if (!a.bDestroying && !lb(a)) return
                } else a.iDraw++;
                if (0 !== j.length) {
                    f = i ? a.aoData.length : n;
                    for (i = i ? 0 : h; i < f; i++) {
                        var l = j[i],
                            r = a.aoData[l];
                        null === r.nTr && Ka(a, l);
                        l = r.nTr;
                        if (0 !== e) {
                            var q = d[c % e];
                            r._sRowStripe != q && (g(l).removeClass(r._sRowStripe).addClass(q), r._sRowStripe = q)
                        }
                        w(a, "aoRowCallback", null, [l, r._aData, c, i]);
                        b.push(l);
                        c++
                    }
                } else c = f.sZeroRecords, 1 == a.iDraw && "ajax" == z(a) ? c = f.sLoadingRecords : f.sEmptyTable && 0 === a.fnRecordsTotal() && (c = f.sEmptyTable), b[0] = g("<tr/>", {
                    "class": e ? d[0] : ""
                }).append(g("<td />", {
                    valign: "top",
                    colSpan: ba(a),
                    "class": a.oClasses.sRowEmpty
                }).html(c))[0];
                w(a, "aoHeaderCallback", "header", [g(a.nTHead).children("tr")[0],
                    Ma(a), h, n, j
                ]);
                w(a, "aoFooterCallback", "footer", [g(a.nTFoot).children("tr")[0], Ma(a), h, n, j]);
                d = g(a.nTBody);
                d.children().detach();
                d.append(g(b));
                w(a, "aoDrawCallback", "draw", [a]);
                a.bSorted = !1;
                a.bFiltered = !1;
                a.bDrawing = !1
            }
        }

        function R(a, b) {
            var c = a.oFeatures,
                d = c.bFilter;
            c.bSort && mb(a);
            d ? ga(a, a.oPreviousSearch) : a.aiDisplay = a.aiDisplayMaster.slice();
            !0 !== b && (a._iDisplayStart = 0);
            a._drawHold = b;
            M(a);
            a._drawHold = !1
        }

        function nb(a) {
            var b = a.oClasses,
                c = g(a.nTable),
                c = g("<div/>").insertBefore(c),
                d = a.oFeatures,
                e = g("<div/>", {
                    id: a.sTableId + "_wrapper",
                    "class": b.sWrapper + (a.nTFoot ? "" : " " + b.sNoFooter)
                });
            a.nHolding = c[0];
            a.nTableWrapper = e[0];
            a.nTableReinsertBefore = a.nTable.nextSibling;
            for (var f = a.sDom.split(""), h, i, j, n, l, r, q = 0; q < f.length; q++) {
                h = null;
                i = f[q];
                if ("<" == i) {
                    j = g("<div/>")[0];
                    n = f[q + 1];
                    if ("'" == n || '"' == n) {
                        l = "";
                        for (r = 2; f[q + r] != n;) l += f[q + r], r++;
                        "H" == l ? l = b.sJUIHeader : "F" == l && (l = b.sJUIFooter); - 1 != l.indexOf(".") ? (n = l.split("."), j.id = n[0].substr(1, n[0].length - 1), j.className = n[1]) : "#" == l.charAt(0) ? j.id = l.substr(1, l.length -
                            1) : j.className = l;
                        q += r
                    }
                    e.append(j);
                    e = g(j)
                } else if (">" == i) e = e.parent();
                else if ("l" == i && d.bPaginate && d.bLengthChange) h = ob(a);
                else if ("f" == i && d.bFilter) h = pb(a);
                else if ("r" == i && d.bProcessing) h = qb(a);
                else if ("t" == i) h = rb(a);
                else if ("i" == i && d.bInfo) h = sb(a);
                else if ("p" == i && d.bPaginate) h = tb(a);
                else if (0 !== m.ext.feature.length) {
                    j = m.ext.feature;
                    r = 0;
                    for (n = j.length; r < n; r++)
                        if (i == j[r].cFeature) {
                            h = j[r].fnInit(a);
                            break
                        }
                }
                h && (j = a.aanFeatures, j[i] || (j[i] = []), j[i].push(h), e.append(h))
            }
            c.replaceWith(e);
            a.nHolding = null
        }

        function ea(a, b) {
            var c = g(b).children("tr"),
                d, e, f, h, i, j, n, l, r, q;
            a.splice(0, a.length);
            f = 0;
            for (j = c.length; f < j; f++) a.push([]);
            f = 0;
            for (j = c.length; f < j; f++) {
                d = c[f];
                for (e = d.firstChild; e;) {
                    if ("TD" == e.nodeName.toUpperCase() || "TH" == e.nodeName.toUpperCase()) {
                        l = 1 * e.getAttribute("colspan");
                        r = 1 * e.getAttribute("rowspan");
                        l = !l || 0 === l || 1 === l ? 1 : l;
                        r = !r || 0 === r || 1 === r ? 1 : r;
                        h = 0;
                        for (i = a[f]; i[h];) h++;
                        n = h;
                        q = 1 === l ? !0 : !1;
                        for (i = 0; i < l; i++)
                            for (h = 0; h < r; h++) a[f + h][n + i] = {
                                cell: e,
                                unique: q
                            }, a[f + h].nTr = d
                    }
                    e = e.nextSibling
                }
            }
        }

        function qa(a,
            b, c) {
            var d = [];
            c || (c = a.aoHeader, b && (c = [], ea(c, b)));
            for (var b = 0, e = c.length; b < e; b++)
                for (var f = 0, h = c[b].length; f < h; f++)
                    if (c[b][f].unique && (!d[f] || !a.bSortCellsTop)) d[f] = c[b][f].cell;
            return d
        }

        function ra(a, b, c) {
            w(a, "aoServerParams", "serverParams", [b]);
            if (b && g.isArray(b)) {
                var d = {},
                    e = /(.*?)\[\]$/;
                g.each(b, function(a, b) {
                    var c = b.name.match(e);
                    c ? (c = c[0], d[c] || (d[c] = []), d[c].push(b.value)) : d[b.name] = b.value
                });
                b = d
            }
            var f, h = a.ajax,
                i = a.oInstance,
                j = function(b) {
                    w(a, null, "xhr", [a, b, a.jqXHR]);
                    c(b)
                };
            if (g.isPlainObject(h) &&
                h.data) {
                f = h.data;
                var n = g.isFunction(f) ? f(b, a) : f,
                    b = g.isFunction(f) && n ? n : g.extend(!0, b, n);
                delete h.data
            }
            n = {
                data: b,
                success: function(b) {
                    var c = b.error || b.sError;
                    c && J(a, 0, c);
                    a.json = b;
                    j(b)
                },
                dataType: "json",
                cache: !1,
                type: a.sServerMethod,
                error: function(b, c) {
                    var f = w(a, null, "xhr", [a, null, a.jqXHR]); - 1 === g.inArray(!0, f) && ("parsererror" == c ? J(a, 0, "Invalid JSON response", 1) : 4 === b.readyState && J(a, 0, "Ajax error", 7));
                    C(a, !1)
                }
            };
            a.oAjaxData = b;
            w(a, null, "preXhr", [a, b]);
            a.fnServerData ? a.fnServerData.call(i, a.sAjaxSource,
                g.map(b, function(a, b) {
                    return {
                        name: b,
                        value: a
                    }
                }), j, a) : a.sAjaxSource || "string" === typeof h ? a.jqXHR = g.ajax(g.extend(n, {
                url: h || a.sAjaxSource
            })) : g.isFunction(h) ? a.jqXHR = h.call(i, b, j, a) : (a.jqXHR = g.ajax(g.extend(n, h)), h.data = f)
        }

        function lb(a) {
            return a.bAjaxDataGet ? (a.iDraw++, C(a, !0), ra(a, ub(a), function(b) {
                vb(a, b)
            }), !1) : !0
        }

        function ub(a) {
            var b = a.aoColumns,
                c = b.length,
                d = a.oFeatures,
                e = a.oPreviousSearch,
                f = a.aoPreSearchCols,
                h, i = [],
                j, n, l, r = V(a);
            h = a._iDisplayStart;
            j = !1 !== d.bPaginate ? a._iDisplayLength : -1;
            var q = function(a,
                b) {
                i.push({
                    name: a,
                    value: b
                })
            };
            q("sEcho", a.iDraw);
            q("iColumns", c);
            q("sColumns", D(b, "sName").join(","));
            q("iDisplayStart", h);
            q("iDisplayLength", j);
            var k = {
                draw: a.iDraw,
                columns: [],
                order: [],
                start: h,
                length: j,
                search: {
                    value: e.sSearch,
                    regex: e.bRegex
                }
            };
            for (h = 0; h < c; h++) n = b[h], l = f[h], j = "function" == typeof n.mData ? "function" : n.mData, k.columns.push({
                data: j,
                name: n.sName,
                searchable: n.bSearchable,
                orderable: n.bSortable,
                search: {
                    value: l.sSearch,
                    regex: l.bRegex
                }
            }), q("mDataProp_" + h, j), d.bFilter && (q("sSearch_" + h, l.sSearch),
                q("bRegex_" + h, l.bRegex), q("bSearchable_" + h, n.bSearchable)), d.bSort && q("bSortable_" + h, n.bSortable);
            d.bFilter && (q("sSearch", e.sSearch), q("bRegex", e.bRegex));
            d.bSort && (g.each(r, function(a, b) {
                k.order.push({
                    column: b.col,
                    dir: b.dir
                });
                q("iSortCol_" + a, b.col);
                q("sSortDir_" + a, b.dir)
            }), q("iSortingCols", r.length));
            b = m.ext.legacy.ajax;
            return null === b ? a.sAjaxSource ? i : k : b ? i : k
        }

        function vb(a, b) {
            var c = sa(a, b),
                d = b.sEcho !== k ? b.sEcho : b.draw,
                e = b.iTotalRecords !== k ? b.iTotalRecords : b.recordsTotal,
                f = b.iTotalDisplayRecords !==
                k ? b.iTotalDisplayRecords : b.recordsFiltered;
            if (d) {
                if (1 * d < a.iDraw) return;
                a.iDraw = 1 * d
            }
            oa(a);
            a._iRecordsTotal = parseInt(e, 10);
            a._iRecordsDisplay = parseInt(f, 10);
            d = 0;
            for (e = c.length; d < e; d++) L(a, c[d]);
            a.aiDisplay = a.aiDisplayMaster.slice();
            a.bAjaxDataGet = !1;
            M(a);
            a._bInitComplete || ta(a, b);
            a.bAjaxDataGet = !0;
            C(a, !1)
        }

        function sa(a, b) {
            var c = g.isPlainObject(a.ajax) && a.ajax.dataSrc !== k ? a.ajax.dataSrc : a.sAjaxDataProp;
            return "data" === c ? b.aaData || b[c] : "" !== c ? P(c)(b) : b
        }

        function pb(a) {
            var b = a.oClasses,
                c = a.sTableId,
                d = a.oLanguage,
                e = a.oPreviousSearch,
                f = a.aanFeatures,
                h = '<input type="search" class="' + b.sFilterInput + '"/>',
                i = d.sSearch,
                i = i.match(/_INPUT_/) ? i.replace("_INPUT_", h) : i + h,
                b = g("<div/>", {
                    id: !f.f ? c + "_filter" : null,
                    "class": b.sFilter
                }).append(g("<label/>").append(i)),
                f = function() {
                    var b = !this.value ? "" : this.value;
                    b != e.sSearch && (ga(a, {
                        sSearch: b,
                        bRegex: e.bRegex,
                        bSmart: e.bSmart,
                        bCaseInsensitive: e.bCaseInsensitive
                    }), a._iDisplayStart = 0, M(a))
                },
                h = null !== a.searchDelay ? a.searchDelay : "ssp" === z(a) ? 400 : 0,
                j = g("input", b).val(e.sSearch).attr("placeholder",
                    d.sSearchPlaceholder).bind("keyup.DT search.DT input.DT paste.DT cut.DT", h ? ua(f, h) : f).bind("keypress.DT", function(a) {
                    if (13 == a.keyCode) return !1
                }).attr("aria-controls", c);
            g(a.nTable).on("search.dt.DT", function(b, c) {
                if (a === c) try {
                    j[0] !== T.activeElement && j.val(e.sSearch)
                } catch (f) {}
            });
            return b[0]
        }

        function ga(a, b, c) {
            var d = a.oPreviousSearch,
                e = a.aoPreSearchCols,
                f = function(a) {
                    d.sSearch = a.sSearch;
                    d.bRegex = a.bRegex;
                    d.bSmart = a.bSmart;
                    d.bCaseInsensitive = a.bCaseInsensitive
                };
            Ia(a);
            if ("ssp" != z(a)) {
                wb(a, b.sSearch,
                    c, b.bEscapeRegex !== k ? !b.bEscapeRegex : b.bRegex, b.bSmart, b.bCaseInsensitive);
                f(b);
                for (b = 0; b < e.length; b++) xb(a, e[b].sSearch, b, e[b].bEscapeRegex !== k ? !e[b].bEscapeRegex : e[b].bRegex, e[b].bSmart, e[b].bCaseInsensitive);
                yb(a)
            } else f(b);
            a.bFiltered = !0;
            w(a, null, "search", [a])
        }

        function yb(a) {
            for (var b = m.ext.search, c = a.aiDisplay, d, e, f = 0, h = b.length; f < h; f++) {
                for (var i = [], j = 0, g = c.length; j < g; j++) e = c[j], d = a.aoData[e], b[f](a, d._aFilterData, e, d._aData, j) && i.push(e);
                c.length = 0;
                c.push.apply(c, i)
            }
        }

        function xb(a, b, c, d, e,
            f) {
            if ("" !== b)
                for (var h = a.aiDisplay, d = Ra(b, d, e, f), e = h.length - 1; 0 <= e; e--) b = a.aoData[h[e]]._aFilterData[c], d.test(b) || h.splice(e, 1)
        }

        function wb(a, b, c, d, e, f) {
            var d = Ra(b, d, e, f),
                e = a.oPreviousSearch.sSearch,
                f = a.aiDisplayMaster,
                h;
            0 !== m.ext.search.length && (c = !0);
            h = zb(a);
            if (0 >= b.length) a.aiDisplay = f.slice();
            else {
                if (h || c || e.length > b.length || 0 !== b.indexOf(e) || a.bSorted) a.aiDisplay = f.slice();
                b = a.aiDisplay;
                for (c = b.length - 1; 0 <= c; c--) d.test(a.aoData[b[c]]._sFilterRow) || b.splice(c, 1)
            }
        }

        function Ra(a, b, c, d) {
            a = b ? a : va(a);
            c && (a = "^(?=.*?" + g.map(a.match(/"[^"]+"|[^ ]+/g) || [""], function(a) {
                if ('"' === a.charAt(0)) var b = a.match(/^"(.*)"$/),
                    a = b ? b[1] : a;
                return a.replace('"', "")
            }).join(")(?=.*?") + ").*$");
            return RegExp(a, d ? "i" : "")
        }

        function va(a) {
            return a.replace(Zb, "\\$1")
        }

        function zb(a) {
            var b = a.aoColumns,
                c, d, e, f, h, i, j, g, l = m.ext.type.search;
            c = !1;
            d = 0;
            for (f = a.aoData.length; d < f; d++)
                if (g = a.aoData[d], !g._aFilterData) {
                    i = [];
                    e = 0;
                    for (h = b.length; e < h; e++) c = b[e], c.bSearchable ? (j = y(a, d, e, "filter"), l[c.sType] && (j = l[c.sType](j)), null === j && (j =
                        ""), "string" !== typeof j && j.toString && (j = j.toString())) : j = "", j.indexOf && -1 !== j.indexOf("&") && (wa.innerHTML = j, j = $b ? wa.textContent : wa.innerText), j.replace && (j = j.replace(/[\r\n]/g, "")), i.push(j);
                    g._aFilterData = i;
                    g._sFilterRow = i.join("  ");
                    c = !0
                }
            return c
        }

        function Ab(a) {
            return {
                search: a.sSearch,
                smart: a.bSmart,
                regex: a.bRegex,
                caseInsensitive: a.bCaseInsensitive
            }
        }

        function Bb(a) {
            return {
                sSearch: a.search,
                bSmart: a.smart,
                bRegex: a.regex,
                bCaseInsensitive: a.caseInsensitive
            }
        }

        function sb(a) {
            var b = a.sTableId,
                c = a.aanFeatures.i,
                d = g("<div/>", {
                    "class": a.oClasses.sInfo,
                    id: !c ? b + "_info" : null
                });
            c || (a.aoDrawCallback.push({
                fn: Cb,
                sName: "information"
            }), d.attr("role", "status").attr("aria-live", "polite"), g(a.nTable).attr("aria-describedby", b + "_info"));
            return d[0]
        }

        function Cb(a) {
            var b = a.aanFeatures.i;
            if (0 !== b.length) {
                var c = a.oLanguage,
                    d = a._iDisplayStart + 1,
                    e = a.fnDisplayEnd(),
                    f = a.fnRecordsTotal(),
                    h = a.fnRecordsDisplay(),
                    i = h ? c.sInfo : c.sInfoEmpty;
                h !== f && (i += " " + c.sInfoFiltered);
                i += c.sInfoPostFix;
                i = Db(a, i);
                c = c.fnInfoCallback;
                null !== c && (i =
                    c.call(a.oInstance, a, d, e, f, h, i));
                g(b).html(i)
            }
        }

        function Db(a, b) {
            var c = a.fnFormatNumber,
                d = a._iDisplayStart + 1,
                e = a._iDisplayLength,
                f = a.fnRecordsDisplay(),
                h = -1 === e;
            return b.replace(/_START_/g, c.call(a, d)).replace(/_END_/g, c.call(a, a.fnDisplayEnd())).replace(/_MAX_/g, c.call(a, a.fnRecordsTotal())).replace(/_TOTAL_/g, c.call(a, f)).replace(/_PAGE_/g, c.call(a, h ? 1 : Math.ceil(d / e))).replace(/_PAGES_/g, c.call(a, h ? 1 : Math.ceil(f / e)))
        }

        function ha(a) {
            var b, c, d = a.iInitDisplayStart,
                e = a.aoColumns,
                f;
            c = a.oFeatures;
            var h =
                a.bDeferLoading;
            if (a.bInitialised) {
                nb(a);
                kb(a);
                fa(a, a.aoHeader);
                fa(a, a.aoFooter);
                C(a, !0);
                c.bAutoWidth && Ha(a);
                b = 0;
                for (c = e.length; b < c; b++) f = e[b], f.sWidth && (f.nTh.style.width = u(f.sWidth));
                w(a, null, "preInit", [a]);
                R(a);
                e = z(a);
                if ("ssp" != e || h) "ajax" == e ? ra(a, [], function(c) {
                    var f = sa(a, c);
                    for (b = 0; b < f.length; b++) L(a, f[b]);
                    a.iInitDisplayStart = d;
                    R(a);
                    C(a, !1);
                    ta(a, c)
                }, a) : (C(a, !1), ta(a))
            } else setTimeout(function() {
                ha(a)
            }, 200)
        }

        function ta(a, b) {
            a._bInitComplete = !0;
            (b || a.oInit.aaData) && Y(a);
            w(a, "aoInitComplete", "init", [a, b])
        }

        function Sa(a, b) {
            var c = parseInt(b, 10);
            a._iDisplayLength = c;
            Ta(a);
            w(a, null, "length", [a, c])
        }

        function ob(a) {
            for (var b = a.oClasses, c = a.sTableId, d = a.aLengthMenu, e = g.isArray(d[0]), f = e ? d[0] : d, d = e ? d[1] : d, e = g("<select/>", {
                    name: c + "_length",
                    "aria-controls": c,
                    "class": b.sLengthSelect
                }), h = 0, i = f.length; h < i; h++) e[0][h] = new Option(d[h], f[h]);
            var j = g("<div><label/></div>").addClass(b.sLength);
            a.aanFeatures.l || (j[0].id = c + "_length");
            j.children().append(a.oLanguage.sLengthMenu.replace("_MENU_", e[0].outerHTML));
            g("select",
                j).val(a._iDisplayLength).bind("change.DT", function() {
                Sa(a, g(this).val());
                M(a)
            });
            g(a.nTable).bind("length.dt.DT", function(b, c, f) {
                a === c && g("select", j).val(f)
            });
            return j[0]
        }

        function tb(a) {
            var b = a.sPaginationType,
                c = m.ext.pager[b],
                d = "function" === typeof c,
                e = function(a) {
                    M(a)
                },
                b = g("<div/>").addClass(a.oClasses.sPaging + b)[0],
                f = a.aanFeatures;
            d || c.fnInit(a, b, e);
            f.p || (b.id = a.sTableId + "_paginate", a.aoDrawCallback.push({
                fn: function(a) {
                    if (d) {
                        var b = a._iDisplayStart,
                            g = a._iDisplayLength,
                            n = a.fnRecordsDisplay(),
                            l = -1 ===
                            g,
                            b = l ? 0 : Math.ceil(b / g),
                            g = l ? 1 : Math.ceil(n / g),
                            n = c(b, g),
                            k, l = 0;
                        for (k = f.p.length; l < k; l++) Qa(a, "pageButton")(a, f.p[l], l, n, b, g)
                    } else c.fnUpdate(a, e)
                },
                sName: "pagination"
            }));
            return b
        }

        function Ua(a, b, c) {
            var d = a._iDisplayStart,
                e = a._iDisplayLength,
                f = a.fnRecordsDisplay();
            0 === f || -1 === e ? d = 0 : "number" === typeof b ? (d = b * e, d > f && (d = 0)) : "first" == b ? d = 0 : "previous" == b ? (d = 0 <= e ? d - e : 0, 0 > d && (d = 0)) : "next" == b ? d + e < f && (d += e) : "last" == b ? d = Math.floor((f - 1) / e) * e : J(a, 0, "Unknown paging action: " + b, 5);
            b = a._iDisplayStart !== d;
            a._iDisplayStart =
                d;
            b && (w(a, null, "page", [a]), c && M(a));
            return b
        }

        function qb(a) {
            return g("<div/>", {
                id: !a.aanFeatures.r ? a.sTableId + "_processing" : null,
                "class": a.oClasses.sProcessing
            }).html(a.oLanguage.sProcessing).insertBefore(a.nTable)[0]
        }

        function C(a, b) {
            a.oFeatures.bProcessing && g(a.aanFeatures.r).css("display", b ? "block" : "none");
            w(a, null, "processing", [a, b])
        }

        function rb(a) {
            var b = g(a.nTable);
            b.attr("role", "grid");
            var c = a.oScroll;
            if ("" === c.sX && "" === c.sY) return a.nTable;
            var d = c.sX,
                e = c.sY,
                f = a.oClasses,
                h = b.children("caption"),
                i = h.length ? h[0]._captionSide : null,
                j = g(b[0].cloneNode(!1)),
                n = g(b[0].cloneNode(!1)),
                l = b.children("tfoot");
            c.sX && "100%" === b.attr("width") && b.removeAttr("width");
            l.length || (l = null);
            j = g("<div/>", {
                "class": f.sScrollWrapper
            }).append(g("<div/>", {
                "class": f.sScrollHead
            }).css({
                overflow: "hidden",
                position: "relative",
                border: 0,
                width: d ? !d ? null : u(d) : "100%"
            }).append(g("<div/>", {
                "class": f.sScrollHeadInner
            }).css({
                "box-sizing": "content-box",
                width: c.sXInner || "100%"
            }).append(j.removeAttr("id").css("margin-left", 0).append("top" ===
                i ? h : null).append(b.children("thead"))))).append(g("<div/>", {
                "class": f.sScrollBody
            }).css({
                position: "relative",
                overflow: "auto",
                width: !d ? null : u(d)
            }).append(b));
            l && j.append(g("<div/>", {
                "class": f.sScrollFoot
            }).css({
                overflow: "hidden",
                border: 0,
                width: d ? !d ? null : u(d) : "100%"
            }).append(g("<div/>", {
                "class": f.sScrollFootInner
            }).append(n.removeAttr("id").css("margin-left", 0).append("bottom" === i ? h : null).append(b.children("tfoot")))));
            var b = j.children(),
                k = b[0],
                f = b[1],
                q = l ? b[2] : null;
            if (d) g(f).on("scroll.DT", function() {
                var a =
                    this.scrollLeft;
                k.scrollLeft = a;
                l && (q.scrollLeft = a)
            });
            g(f).css(e && c.bCollapse ? "max-height" : "height", e);
            a.nScrollHead = k;
            a.nScrollBody = f;
            a.nScrollFoot = q;
            a.aoDrawCallback.push({
                fn: Z,
                sName: "scrolling"
            });
            return j[0]
        }

        function Z(a) {
            var b = a.oScroll,
                c = b.sX,
                d = b.sXInner,
                e = b.sY,
                b = b.iBarWidth,
                f = g(a.nScrollHead),
                h = f[0].style,
                i = f.children("div"),
                j = i[0].style,
                n = i.children("table"),
                i = a.nScrollBody,
                l = g(i),
                k = i.style,
                q = g(a.nScrollFoot).children("div"),
                m = q.children("table"),
                o = g(a.nTHead),
                E = g(a.nTable),
                p = E[0],
                t = p.style,
                N = a.nTFoot ? g(a.nTFoot) : null,
                Eb = a.oBrowser,
                w = Eb.bScrollOversize,
                s, v, O, x, y = [],
                z = [],
                A = [],
                B, C = function(a) {
                    a = a.style;
                    a.paddingTop = "0";
                    a.paddingBottom = "0";
                    a.borderTopWidth = "0";
                    a.borderBottomWidth = "0";
                    a.height = 0
                };
            E.children("thead, tfoot").remove();
            x = o.clone().prependTo(E);
            o = o.find("tr");
            v = x.find("tr");
            x.find("th, td").removeAttr("tabindex");
            N && (O = N.clone().prependTo(E), s = N.find("tr"), O = O.find("tr"));
            c || (k.width = "100%", f[0].style.width = "100%");
            g.each(qa(a, x), function(b, c) {
                B = la(a, b);
                c.style.width = a.aoColumns[B].sWidth
            });
            N && H(function(a) {
                a.style.width = ""
            }, O);
            f = E.outerWidth();
            if ("" === c) {
                t.width = "100%";
                if (w && (E.find("tbody").height() > i.offsetHeight || "scroll" == l.css("overflow-y"))) t.width = u(E.outerWidth() - b);
                f = E.outerWidth()
            } else "" !== d && (t.width = u(d), f = E.outerWidth());
            H(C, v);
            H(function(a) {
                A.push(a.innerHTML);
                y.push(u(g(a).css("width")))
            }, v);
            H(function(a, b) {
                a.style.width = y[b]
            }, o);
            g(v).height(0);
            N && (H(C, O), H(function(a) {
                z.push(u(g(a).css("width")))
            }, O), H(function(a, b) {
                a.style.width = z[b]
            }, s), g(O).height(0));
            H(function(a,
                b) {
                a.innerHTML = '<div class="dataTables_sizing" style="height:0;overflow:hidden;">' + A[b] + "</div>";
                a.style.width = y[b]
            }, v);
            N && H(function(a, b) {
                a.innerHTML = "";
                a.style.width = z[b]
            }, O);
            if (E.outerWidth() < f) {
                s = i.scrollHeight > i.offsetHeight || "scroll" == l.css("overflow-y") ? f + b : f;
                if (w && (i.scrollHeight > i.offsetHeight || "scroll" == l.css("overflow-y"))) t.width = u(s - b);
                ("" === c || "" !== d) && J(a, 1, "Possible column misalignment", 6)
            } else s = "100%";
            k.width = u(s);
            h.width = u(s);
            N && (a.nScrollFoot.style.width = u(s));
            !e && w && (k.height =
                u(p.offsetHeight + b));
            c = E.outerWidth();
            n[0].style.width = u(c);
            j.width = u(c);
            d = E.height() > i.clientHeight || "scroll" == l.css("overflow-y");
            e = "padding" + (Eb.bScrollbarLeft ? "Left" : "Right");
            j[e] = d ? b + "px" : "0px";
            N && (m[0].style.width = u(c), q[0].style.width = u(c), q[0].style[e] = d ? b + "px" : "0px");
            l.scroll();
            if ((a.bSorted || a.bFiltered) && !a._drawHold) i.scrollTop = 0
        }

        function H(a, b, c) {
            for (var d = 0, e = 0, f = b.length, h, i; e < f;) {
                h = b[e].firstChild;
                for (i = c ? c[e].firstChild : null; h;) 1 === h.nodeType && (c ? a(h, i, d) : a(h, d), d++), h = h.nextSibling,
                    i = c ? i.nextSibling : null;
                e++
            }
        }

        function Ha(a) {
            var b = a.nTable,
                c = a.aoColumns,
                d = a.oScroll,
                e = d.sY,
                f = d.sX,
                h = d.sXInner,
                i = c.length,
                j = $(a, "bVisible"),
                n = g("th", a.nTHead),
                l = b.getAttribute("width"),
                k = b.parentNode,
                q = !1,
                m, o, p;
            p = a.oBrowser;
            d = p.bScrollOversize;
            (m = b.style.width) && -1 !== m.indexOf("%") && (l = m);
            for (m = 0; m < j.length; m++) o = c[j[m]], null !== o.sWidth && (o.sWidth = Fb(o.sWidthOrig, k), q = !0);
            if (d || !q && !f && !e && i == ba(a) && i == n.length)
                for (m = 0; m < i; m++) c[m].sWidth = u(n.eq(m).width());
            else {
                i = g(b).clone().css("visibility", "hidden").removeAttr("id");
                i.find("tbody tr").remove();
                var t = g("<tr/>").appendTo(i.find("tbody"));
                i.find("thead, tfoot").remove();
                i.append(g(a.nTHead).clone()).append(g(a.nTFoot).clone());
                i.find("tfoot th, tfoot td").css("width", "");
                n = qa(a, i.find("thead")[0]);
                for (m = 0; m < j.length; m++) o = c[j[m]], n[m].style.width = null !== o.sWidthOrig && "" !== o.sWidthOrig ? u(o.sWidthOrig) : "";
                if (a.aoData.length)
                    for (m = 0; m < j.length; m++) q = j[m], o = c[q], g(Gb(a, q)).clone(!1).append(o.sContentPadding).appendTo(t);
                q = g("<div/>").css(f || e ? {
                    position: "absolute",
                    top: 0,
                    left: 0,
                    height: 1,
                    right: 0,
                    overflow: "hidden"
                } : {}).append(i).appendTo(k);
                f && h ? i.width(h) : f ? (i.css("width", "auto"), i.width() < k.clientWidth && i.width(k.clientWidth)) : e ? i.width(k.clientWidth) : l && i.width(l);
                if (f) {
                    for (m = h = 0; m < j.length; m++) o = c[j[m]], e = p.bBounding ? n[m].getBoundingClientRect().width : g(n[m]).outerWidth(), h += null === o.sWidthOrig ? e : parseInt(o.sWidth, 10) + e - g(n[m]).width();
                    i.width(u(h));
                    b.style.width = u(h)
                }
                for (m = 0; m < j.length; m++)
                    if (o = c[j[m]], p = g(n[m]).width()) o.sWidth = u(p);
                b.style.width = u(i.css("width"));
                q.remove()
            }
            l && (b.style.width = u(l));
            if ((l || f) && !a._reszEvt) b = function() {
                g(Fa).bind("resize.DT-" + a.sInstance, ua(function() {
                    Y(a)
                }))
            }, d ? setTimeout(b, 1E3) : b(), a._reszEvt = !0
        }

        function ua(a, b) {
            var c = b !== k ? b : 200,
                d, e;
            return function() {
                var b = this,
                    h = +new Date,
                    i = arguments;
                d && h < d + c ? (clearTimeout(e), e = setTimeout(function() {
                    d = k;
                    a.apply(b, i)
                }, c)) : (d = h, a.apply(b, i))
            }
        }

        function Fb(a, b) {
            if (!a) return 0;
            var c = g("<div/>").css("width", u(a)).appendTo(b || T.body),
                d = c[0].offsetWidth;
            c.remove();
            return d
        }

        function Gb(a, b) {
            var c =
                Hb(a, b);
            if (0 > c) return null;
            var d = a.aoData[c];
            return !d.nTr ? g("<td/>").html(y(a, c, b, "display"))[0] : d.anCells[b]
        }

        function Hb(a, b) {
            for (var c, d = -1, e = -1, f = 0, h = a.aoData.length; f < h; f++) c = y(a, f, b, "display") + "", c = c.replace(ac, ""), c.length > d && (d = c.length, e = f);
            return e
        }

        function u(a) {
            return null === a ? "0px" : "number" == typeof a ? 0 > a ? "0px" : a + "px" : a.match(/\d$/) ? a + "px" : a
        }

        function Ib() {
            var a = m.__scrollbarWidth;
            if (a === k) {
                var b = g("<p/>").css({
                        position: "absolute",
                        top: 0,
                        left: 0,
                        width: "100%",
                        height: 150,
                        padding: 0,
                        overflow: "scroll",
                        visibility: "hidden"
                    }).appendTo("body"),
                    a = b[0].offsetWidth - b[0].clientWidth;
                m.__scrollbarWidth = a;
                b.remove()
            }
            return a
        }

        function V(a) {
            var b, c, d = [],
                e = a.aoColumns,
                f, h, i, j;
            b = a.aaSortingFixed;
            c = g.isPlainObject(b);
            var n = [];
            f = function(a) {
                a.length && !g.isArray(a[0]) ? n.push(a) : n.push.apply(n, a)
            };
            g.isArray(b) && f(b);
            c && b.pre && f(b.pre);
            f(a.aaSorting);
            c && b.post && f(b.post);
            for (a = 0; a < n.length; a++) {
                j = n[a][0];
                f = e[j].aDataSort;
                b = 0;
                for (c = f.length; b < c; b++) h = f[b], i = e[h].sType || "string", n[a]._idx === k && (n[a]._idx = g.inArray(n[a][1],
                    e[h].asSorting)), d.push({
                    src: j,
                    col: h,
                    dir: n[a][1],
                    index: n[a]._idx,
                    type: i,
                    formatter: m.ext.type.order[i + "-pre"]
                })
            }
            return d
        }

        function mb(a) {
            var b, c, d = [],
                e = m.ext.type.order,
                f = a.aoData,
                h = 0,
                i, g = a.aiDisplayMaster,
                n;
            Ia(a);
            n = V(a);
            b = 0;
            for (c = n.length; b < c; b++) i = n[b], i.formatter && h++, Jb(a, i.col);
            if ("ssp" != z(a) && 0 !== n.length) {
                b = 0;
                for (c = g.length; b < c; b++) d[g[b]] = b;
                h === n.length ? g.sort(function(a, b) {
                    var c, e, h, i, g = n.length,
                        j = f[a]._aSortData,
                        k = f[b]._aSortData;
                    for (h = 0; h < g; h++)
                        if (i = n[h], c = j[i.col], e = k[i.col], c = c < e ? -1 : c >
                            e ? 1 : 0, 0 !== c) return "asc" === i.dir ? c : -c;
                    c = d[a];
                    e = d[b];
                    return c < e ? -1 : c > e ? 1 : 0
                }) : g.sort(function(a, b) {
                    var c, h, i, g, j = n.length,
                        k = f[a]._aSortData,
                        m = f[b]._aSortData;
                    for (i = 0; i < j; i++)
                        if (g = n[i], c = k[g.col], h = m[g.col], g = e[g.type + "-" + g.dir] || e["string-" + g.dir], c = g(c, h), 0 !== c) return c;
                    c = d[a];
                    h = d[b];
                    return c < h ? -1 : c > h ? 1 : 0
                })
            }
            a.bSorted = !0
        }

        function Kb(a) {
            for (var b, c, d = a.aoColumns, e = V(a), a = a.oLanguage.oAria, f = 0, h = d.length; f < h; f++) {
                c = d[f];
                var i = c.asSorting;
                b = c.sTitle.replace(/<.*?>/g, "");
                var g = c.nTh;
                g.removeAttribute("aria-sort");
                c.bSortable && (0 < e.length && e[0].col == f ? (g.setAttribute("aria-sort", "asc" == e[0].dir ? "ascending" : "descending"), c = i[e[0].index + 1] || i[0]) : c = i[0], b += "asc" === c ? a.sSortAscending : a.sSortDescending);
                g.setAttribute("aria-label", b)
            }
        }

        function Va(a, b, c, d) {
            var e = a.aaSorting,
                f = a.aoColumns[b].asSorting,
                h = function(a, b) {
                    var c = a._idx;
                    c === k && (c = g.inArray(a[1], f));
                    return c + 1 < f.length ? c + 1 : b ? null : 0
                };
            "number" === typeof e[0] && (e = a.aaSorting = [e]);
            c && a.oFeatures.bSortMulti ? (c = g.inArray(b, D(e, "0")), -1 !== c ? (b = h(e[c], !0), null ===
                b && 1 === e.length && (b = 0), null === b ? e.splice(c, 1) : (e[c][1] = f[b], e[c]._idx = b)) : (e.push([b, f[0], 0]), e[e.length - 1]._idx = 0)) : e.length && e[0][0] == b ? (b = h(e[0]), e.length = 1, e[0][1] = f[b], e[0]._idx = b) : (e.length = 0, e.push([b, f[0]]), e[0]._idx = 0);
            R(a);
            "function" == typeof d && d(a)
        }

        function Pa(a, b, c, d) {
            var e = a.aoColumns[c];
            Wa(b, {}, function(b) {
                !1 !== e.bSortable && (a.oFeatures.bProcessing ? (C(a, !0), setTimeout(function() {
                    Va(a, c, b.shiftKey, d);
                    "ssp" !== z(a) && C(a, !1)
                }, 0)) : Va(a, c, b.shiftKey, d))
            })
        }

        function xa(a) {
            var b = a.aLastSort,
                c = a.oClasses.sSortColumn,
                d = V(a),
                e = a.oFeatures,
                f, h;
            if (e.bSort && e.bSortClasses) {
                e = 0;
                for (f = b.length; e < f; e++) h = b[e].src, g(D(a.aoData, "anCells", h)).removeClass(c + (2 > e ? e + 1 : 3));
                e = 0;
                for (f = d.length; e < f; e++) h = d[e].src, g(D(a.aoData, "anCells", h)).addClass(c + (2 > e ? e + 1 : 3))
            }
            a.aLastSort = d
        }

        function Jb(a, b) {
            var c = a.aoColumns[b],
                d = m.ext.order[c.sSortDataType],
                e;
            d && (e = d.call(a.oInstance, a, b, aa(a, b)));
            for (var f, h = m.ext.type.order[c.sType + "-pre"], i = 0, g = a.aoData.length; i < g; i++)
                if (c = a.aoData[i], c._aSortData || (c._aSortData = []), !c._aSortData[b] || d) f = d ? e[i] : y(a, i, b, "sort"), c._aSortData[b] = h ? h(f) : f
        }

        function ya(a) {
            if (a.oFeatures.bStateSave && !a.bDestroying) {
                var b = {
                    time: +new Date,
                    start: a._iDisplayStart,
                    length: a._iDisplayLength,
                    order: g.extend(!0, [], a.aaSorting),
                    search: Ab(a.oPreviousSearch),
                    columns: g.map(a.aoColumns, function(b, d) {
                        return {
                            visible: b.bVisible,
                            search: Ab(a.aoPreSearchCols[d])
                        }
                    })
                };
                w(a, "aoStateSaveParams", "stateSaveParams", [a, b]);
                a.oSavedState = b;
                a.fnStateSaveCallback.call(a.oInstance, a, b)
            }
        }

        function Lb(a) {
            var b, c, d =
                a.aoColumns;
            if (a.oFeatures.bStateSave) {
                var e = a.fnStateLoadCallback.call(a.oInstance, a);
                if (e && e.time && (b = w(a, "aoStateLoadParams", "stateLoadParams", [a, e]), -1 === g.inArray(!1, b) && (b = a.iStateDuration, !(0 < b && e.time < +new Date - 1E3 * b) && d.length === e.columns.length))) {
                    a.oLoadedState = g.extend(!0, {}, e);
                    e.start !== k && (a._iDisplayStart = e.start, a.iInitDisplayStart = e.start);
                    e.length !== k && (a._iDisplayLength = e.length);
                    e.order !== k && (a.aaSorting = [], g.each(e.order, function(b, c) {
                        a.aaSorting.push(c[0] >= d.length ? [0, c[1]] :
                            c)
                    }));
                    e.search !== k && g.extend(a.oPreviousSearch, Bb(e.search));
                    b = 0;
                    for (c = e.columns.length; b < c; b++) {
                        var f = e.columns[b];
                        f.visible !== k && (d[b].bVisible = f.visible);
                        f.search !== k && g.extend(a.aoPreSearchCols[b], Bb(f.search))
                    }
                    w(a, "aoStateLoaded", "stateLoaded", [a, e])
                }
            }
        }

        function za(a) {
            var b = m.settings,
                a = g.inArray(a, D(b, "nTable"));
            return -1 !== a ? b[a] : null
        }

        function J(a, b, c, d) {
            c = "DataTables warning: " + (a ? "table id=" + a.sTableId + " - " : "") + c;
            d && (c += ". For more information about this error, please see http://datatables.net/tn/" +
                d);
            if (b) Fa.console && console.log && console.log(c);
            else if (b = m.ext, b = b.sErrMode || b.errMode, a && w(a, null, "error", [a, d, c]), "alert" == b) alert(c);
            else {
                if ("throw" == b) throw Error(c);
                "function" == typeof b && b(a, d, c)
            }
        }

        function F(a, b, c, d) {
            g.isArray(c) ? g.each(c, function(c, f) {
                g.isArray(f) ? F(a, b, f[0], f[1]) : F(a, b, f)
            }) : (d === k && (d = c), b[c] !== k && (a[d] = b[c]))
        }

        function Mb(a, b, c) {
            var d, e;
            for (e in b) b.hasOwnProperty(e) && (d = b[e], g.isPlainObject(d) ? (g.isPlainObject(a[e]) || (a[e] = {}), g.extend(!0, a[e], d)) : a[e] = c && "data" !== e && "aaData" !==
                e && g.isArray(d) ? d.slice() : d);
            return a
        }

        function Wa(a, b, c) {
            g(a).bind("click.DT", b, function(b) {
                a.blur();
                c(b)
            }).bind("keypress.DT", b, function(a) {
                13 === a.which && (a.preventDefault(), c(a))
            }).bind("selectstart.DT", function() {
                return !1
            })
        }

        function A(a, b, c, d) {
            c && a[b].push({
                fn: c,
                sName: d
            })
        }

        function w(a, b, c, d) {
            var e = [];
            b && (e = g.map(a[b].slice().reverse(), function(b) {
                return b.fn.apply(a.oInstance, d)
            }));
            null !== c && (b = g.Event(c + ".dt"), g(a.nTable).trigger(b, d), e.push(b.result));
            return e
        }

        function Ta(a) {
            var b = a._iDisplayStart,
                c = a.fnDisplayEnd(),
                d = a._iDisplayLength;
            b >= c && (b = c - d);
            b -= b % d;
            if (-1 === d || 0 > b) b = 0;
            a._iDisplayStart = b
        }

        function Qa(a, b) {
            var c = a.renderer,
                d = m.ext.renderer[b];
            return g.isPlainObject(c) && c[b] ? d[c[b]] || d._ : "string" === typeof c ? d[c] || d._ : d._
        }

        function z(a) {
            return a.oFeatures.bServerSide ? "ssp" : a.ajax || a.sAjaxSource ? "ajax" : "dom"
        }

        function Aa(a, b) {
            var c = [],
                c = Nb.numbers_length,
                d = Math.floor(c / 2);
            b <= c ? c = W(0, b) : a <= d ? (c = W(0, c - 2), c.push("ellipsis"), c.push(b - 1)) : (a >= b - 1 - d ? c = W(b - (c - 2), b) : (c = W(a - d + 2, a + d - 1), c.push("ellipsis"),
                c.push(b - 1)), c.splice(0, 0, "ellipsis"), c.splice(0, 0, 0));
            c.DT_el = "span";
            return c
        }

        function db(a) {
            g.each({
                num: function(b) {
                    return Ba(b, a)
                },
                "num-fmt": function(b) {
                    return Ba(b, a, Xa)
                },
                "html-num": function(b) {
                    return Ba(b, a, Ca)
                },
                "html-num-fmt": function(b) {
                    return Ba(b, a, Ca, Xa)
                }
            }, function(b, c) {
                v.type.order[b + a + "-pre"] = c;
                b.match(/^html\-/) && (v.type.search[b + a] = v.type.search.html)
            })
        }

        function Ob(a) {
            return function() {
                var b = [za(this[m.ext.iApiIndex])].concat(Array.prototype.slice.call(arguments));
                return m.ext.internal[a].apply(this,
                    b)
            }
        }
        var m, v, t, p, s, Ya = {},
            Pb = /[\r\n]/g,
            Ca = /<.*?>/g,
            bc = /^[\w\+\-]/,
            cc = /[\w\+\-]$/,
            Zb = RegExp("(\\/|\\.|\\*|\\+|\\?|\\||\\(|\\)|\\[|\\]|\\{|\\}|\\\\|\\$|\\^|\\-)", "g"),
            Xa = /[',$Â£â‚¬Â¥%\u2009\u202F\u20BD\u20a9\u20BArfk]/gi,
            K = function(a) {
                return !a || !0 === a || "-" === a ? !0 : !1
            },
            Qb = function(a) {
                var b = parseInt(a, 10);
                return !isNaN(b) && isFinite(a) ? b : null
            },
            Rb = function(a, b) {
                Ya[b] || (Ya[b] = RegExp(va(b), "g"));
                return "string" === typeof a && "." !== b ? a.replace(/\./g, "").replace(Ya[b], ".") : a
            },
            Za = function(a, b, c) {
                var d = "string" === typeof a;
                if (K(a)) return !0;
                b && d && (a = Rb(a, b));
                c && d && (a = a.replace(Xa, ""));
                return !isNaN(parseFloat(a)) && isFinite(a)
            },
            Sb = function(a, b, c) {
                return K(a) ? !0 : !(K(a) || "string" === typeof a) ? null : Za(a.replace(Ca, ""), b, c) ? !0 : null
            },
            D = function(a, b, c) {
                var d = [],
                    e = 0,
                    f = a.length;
                if (c !== k)
                    for (; e < f; e++) a[e] && a[e][b] && d.push(a[e][b][c]);
                else
                    for (; e < f; e++) a[e] && d.push(a[e][b]);
                return d
            },
            ia = function(a, b, c, d) {
                var e = [],
                    f = 0,
                    h = b.length;
                if (d !== k)
                    for (; f < h; f++) a[b[f]][c] && e.push(a[b[f]][c][d]);
                else
                    for (; f < h; f++) e.push(a[b[f]][c]);
                return e
            },
            W = function(a, b) {
                var c = [],
                    d;
                b === k ? (b = 0, d = a) : (d = b, b = a);
                for (var e = b; e < d; e++) c.push(e);
                return c
            },
            Tb = function(a) {
                for (var b = [], c = 0, d = a.length; c < d; c++) a[c] && b.push(a[c]);
                return b
            },
            Oa = function(a) {
                var b = [],
                    c, d, e = a.length,
                    f, h = 0;
                d = 0;
                a: for (; d < e; d++) {
                    c = a[d];
                    for (f = 0; f < h; f++)
                        if (b[f] === c) continue a;
                    b.push(c);
                    h++
                }
                return b
            },
            B = function(a, b, c) {
                a[b] !== k && (a[c] = a[b])
            },
            ca = /\[.*?\]$/,
            U = /\(\)$/,
            wa = g("<div>")[0],
            $b = wa.textContent !== k,
            ac = /<.*?>/g;
        m = function(a) {
            this.$ = function(a, b) {
                return this.api(!0).$(a, b)
            };
            this._ = function(a,
                b) {
                return this.api(!0).rows(a, b).data()
            };
            this.api = function(a) {
                return a ? new t(za(this[v.iApiIndex])) : new t(this)
            };
            this.fnAddData = function(a, b) {
                var c = this.api(!0),
                    d = g.isArray(a) && (g.isArray(a[0]) || g.isPlainObject(a[0])) ? c.rows.add(a) : c.row.add(a);
                (b === k || b) && c.draw();
                return d.flatten().toArray()
            };
            this.fnAdjustColumnSizing = function(a) {
                var b = this.api(!0).columns.adjust(),
                    c = b.settings()[0],
                    d = c.oScroll;
                a === k || a ? b.draw(!1) : ("" !== d.sX || "" !== d.sY) && Z(c)
            };
            this.fnClearTable = function(a) {
                var b = this.api(!0).clear();
                (a === k || a) && b.draw()
            };
            this.fnClose = function(a) {
                this.api(!0).row(a).child.hide()
            };
            this.fnDeleteRow = function(a, b, c) {
                var d = this.api(!0),
                    a = d.rows(a),
                    e = a.settings()[0],
                    g = e.aoData[a[0][0]];
                a.remove();
                b && b.call(this, e, g);
                (c === k || c) && d.draw();
                return g
            };
            this.fnDestroy = function(a) {
                this.api(!0).destroy(a)
            };
            this.fnDraw = function(a) {
                this.api(!0).draw(a)
            };
            this.fnFilter = function(a, b, c, d, e, g) {
                e = this.api(!0);
                null === b || b === k ? e.search(a, c, d, g) : e.column(b).search(a, c, d, g);
                e.draw()
            };
            this.fnGetData = function(a, b) {
                var c =
                    this.api(!0);
                if (a !== k) {
                    var d = a.nodeName ? a.nodeName.toLowerCase() : "";
                    return b !== k || "td" == d || "th" == d ? c.cell(a, b).data() : c.row(a).data() || null
                }
                return c.data().toArray()
            };
            this.fnGetNodes = function(a) {
                var b = this.api(!0);
                return a !== k ? b.row(a).node() : b.rows().nodes().flatten().toArray()
            };
            this.fnGetPosition = function(a) {
                var b = this.api(!0),
                    c = a.nodeName.toUpperCase();
                return "TR" == c ? b.row(a).index() : "TD" == c || "TH" == c ? (a = b.cell(a).index(), [a.row, a.columnVisible, a.column]) : null
            };
            this.fnIsOpen = function(a) {
                return this.api(!0).row(a).child.isShown()
            };
            this.fnOpen = function(a, b, c) {
                return this.api(!0).row(a).child(b, c).show().child()[0]
            };
            this.fnPageChange = function(a, b) {
                var c = this.api(!0).page(a);
                (b === k || b) && c.draw(!1)
            };
            this.fnSetColumnVis = function(a, b, c) {
                a = this.api(!0).column(a).visible(b);
                (c === k || c) && a.columns.adjust().draw()
            };
            this.fnSettings = function() {
                return za(this[v.iApiIndex])
            };
            this.fnSort = function(a) {
                this.api(!0).order(a).draw()
            };
            this.fnSortListener = function(a, b, c) {
                this.api(!0).order.listener(a, b, c)
            };
            this.fnUpdate = function(a, b, c, d, e) {
                var g =
                    this.api(!0);
                c === k || null === c ? g.row(b).data(a) : g.cell(b, c).data(a);
                (e === k || e) && g.columns.adjust();
                (d === k || d) && g.draw();
                return 0
            };
            this.fnVersionCheck = v.fnVersionCheck;
            var b = this,
                c = a === k,
                d = this.length;
            c && (a = {});
            this.oApi = this.internal = v.internal;
            for (var e in m.ext.internal) e && (this[e] = Ob(e));
            this.each(function() {
                var f = {},
                    f = 1 < d ? Mb(f, a, !0) : a,
                    e = 0,
                    i, j = this.getAttribute("id"),
                    n = !1,
                    l = m.defaults,
                    r = g(this);
                if ("table" != this.nodeName.toLowerCase()) J(null, 0, "Non-table node initialisation (" + this.nodeName + ")", 2);
                else {
                    eb(l);
                    fb(l.column);
                    I(l, l, !0);
                    I(l.column, l.column, !0);
                    I(l, g.extend(f, r.data()));
                    var q = m.settings,
                        e = 0;
                    for (i = q.length; e < i; e++) {
                        var p = q[e];
                        if (p.nTable == this || p.nTHead.parentNode == this || p.nTFoot && p.nTFoot.parentNode == this) {
                            e = f.bRetrieve !== k ? f.bRetrieve : l.bRetrieve;
                            if (c || e) return p.oInstance;
                            if (f.bDestroy !== k ? f.bDestroy : l.bDestroy) {
                                p.oInstance.fnDestroy();
                                break
                            } else {
                                J(p, 0, "Cannot reinitialise DataTable", 3);
                                return
                            }
                        }
                        if (p.sTableId == this.id) {
                            q.splice(e, 1);
                            break
                        }
                    }
                    if (null === j || "" === j) this.id = j = "DataTables_Table_" +
                        m.ext._unique++;
                    var o = g.extend(!0, {}, m.models.oSettings, {
                        sDestroyWidth: r[0].style.width,
                        sInstance: j,
                        sTableId: j
                    });
                    o.nTable = this;
                    o.oApi = b.internal;
                    o.oInit = f;
                    q.push(o);
                    o.oInstance = 1 === b.length ? b : r.dataTable();
                    eb(f);
                    f.oLanguage && S(f.oLanguage);
                    f.aLengthMenu && !f.iDisplayLength && (f.iDisplayLength = g.isArray(f.aLengthMenu[0]) ? f.aLengthMenu[0][0] : f.aLengthMenu[0]);
                    f = Mb(g.extend(!0, {}, l), f);
                    F(o.oFeatures, f, "bPaginate bLengthChange bFilter bSort bSortMulti bInfo bProcessing bAutoWidth bSortClasses bServerSide bDeferRender".split(" "));
                    F(o, f, ["asStripeClasses", "ajax", "fnServerData", "fnFormatNumber", "sServerMethod", "aaSorting", "aaSortingFixed", "aLengthMenu", "sPaginationType", "sAjaxSource", "sAjaxDataProp", "iStateDuration", "sDom", "bSortCellsTop", "iTabIndex", "fnStateLoadCallback", "fnStateSaveCallback", "renderer", "searchDelay", "rowId", ["iCookieDuration", "iStateDuration"],
                        ["oSearch", "oPreviousSearch"],
                        ["aoSearchCols", "aoPreSearchCols"],
                        ["iDisplayLength", "_iDisplayLength"],
                        ["bJQueryUI", "bJUI"]
                    ]);
                    F(o.oScroll, f, [
                        ["sScrollX", "sX"],
                        ["sScrollXInner",
                            "sXInner"
                        ],
                        ["sScrollY", "sY"],
                        ["bScrollCollapse", "bCollapse"]
                    ]);
                    F(o.oLanguage, f, "fnInfoCallback");
                    A(o, "aoDrawCallback", f.fnDrawCallback, "user");
                    A(o, "aoServerParams", f.fnServerParams, "user");
                    A(o, "aoStateSaveParams", f.fnStateSaveParams, "user");
                    A(o, "aoStateLoadParams", f.fnStateLoadParams, "user");
                    A(o, "aoStateLoaded", f.fnStateLoaded, "user");
                    A(o, "aoRowCallback", f.fnRowCallback, "user");
                    A(o, "aoRowCreatedCallback", f.fnCreatedRow, "user");
                    A(o, "aoHeaderCallback", f.fnHeaderCallback, "user");
                    A(o, "aoFooterCallback",
                        f.fnFooterCallback, "user");
                    A(o, "aoInitComplete", f.fnInitComplete, "user");
                    A(o, "aoPreDrawCallback", f.fnPreDrawCallback, "user");
                    o.rowIdFn = P(f.rowId);
                    j = o.oClasses;
                    f.bJQueryUI ? (g.extend(j, m.ext.oJUIClasses, f.oClasses), f.sDom === l.sDom && "lfrtip" === l.sDom && (o.sDom = '<"H"lfr>t<"F"ip>'), o.renderer) ? g.isPlainObject(o.renderer) && !o.renderer.header && (o.renderer.header = "jqueryui") : o.renderer = "jqueryui" : g.extend(j, m.ext.classes, f.oClasses);
                    r.addClass(j.sTable);
                    if ("" !== o.oScroll.sX || "" !== o.oScroll.sY) o.oScroll.iBarWidth =
                        Ib();
                    o.iInitDisplayStart === k && (o.iInitDisplayStart = f.iDisplayStart, o._iDisplayStart = f.iDisplayStart);
                    null !== f.iDeferLoading && (o.bDeferLoading = !0, e = g.isArray(f.iDeferLoading), o._iRecordsDisplay = e ? f.iDeferLoading[0] : f.iDeferLoading, o._iRecordsTotal = e ? f.iDeferLoading[1] : f.iDeferLoading);
                    var t = o.oLanguage;
                    g.extend(!0, t, f.oLanguage);
                    "" !== t.sUrl && (g.ajax({
                        dataType: "json",
                        url: t.sUrl,
                        success: function(a) {
                            S(a);
                            I(l.oLanguage, a);
                            g.extend(true, t, a);
                            ha(o)
                        },
                        error: function() {
                            ha(o)
                        }
                    }), n = !0);
                    null === f.asStripeClasses &&
                        (o.asStripeClasses = [j.sStripeOdd, j.sStripeEven]);
                    var e = o.asStripeClasses,
                        s = r.children("tbody").find("tr").eq(0); - 1 !== g.inArray(!0, g.map(e, function(a) {
                        return s.hasClass(a)
                    })) && (g("tbody tr", this).removeClass(e.join(" ")), o.asDestroyStripes = e.slice());
                    q = [];
                    e = this.getElementsByTagName("thead");
                    0 !== e.length && (ea(o.aoHeader, e[0]), q = qa(o));
                    if (null === f.aoColumns) {
                        p = [];
                        e = 0;
                        for (i = q.length; e < i; e++) p.push(null)
                    } else p = f.aoColumns;
                    e = 0;
                    for (i = p.length; e < i; e++) Ga(o, q ? q[e] : null);
                    ib(o, f.aoColumnDefs, p, function(a,
                        b) {
                        ka(o, a, b)
                    });
                    if (s.length) {
                        var u = function(a, b) {
                            return a.getAttribute("data-" + b) !== null ? b : null
                        };
                        g.each(na(o, s[0]).cells, function(a, b) {
                            var c = o.aoColumns[a];
                            if (c.mData === a) {
                                var d = u(b, "sort") || u(b, "order"),
                                    e = u(b, "filter") || u(b, "search");
                                if (d !== null || e !== null) {
                                    c.mData = {
                                        _: a + ".display",
                                        sort: d !== null ? a + ".@data-" + d : k,
                                        type: d !== null ? a + ".@data-" + d : k,
                                        filter: e !== null ? a + ".@data-" + e : k
                                    };
                                    ka(o, a)
                                }
                            }
                        })
                    }
                    var v = o.oFeatures;
                    f.bStateSave && (v.bStateSave = !0, Lb(o, f), A(o, "aoDrawCallback", ya, "state_save"));
                    if (f.aaSorting === k) {
                        q =
                            o.aaSorting;
                        e = 0;
                        for (i = q.length; e < i; e++) q[e][1] = o.aoColumns[e].asSorting[0]
                    }
                    xa(o);
                    v.bSort && A(o, "aoDrawCallback", function() {
                        if (o.bSorted) {
                            var a = V(o),
                                b = {};
                            g.each(a, function(a, c) {
                                b[c.src] = c.dir
                            });
                            w(o, null, "order", [o, a, b]);
                            Kb(o)
                        }
                    });
                    A(o, "aoDrawCallback", function() {
                        (o.bSorted || z(o) === "ssp" || v.bDeferRender) && xa(o)
                    }, "sc");
                    gb(o);
                    e = r.children("caption").each(function() {
                        this._captionSide = r.css("caption-side")
                    });
                    i = r.children("thead");
                    0 === i.length && (i = g("<thead/>").appendTo(this));
                    o.nTHead = i[0];
                    i = r.children("tbody");
                    0 === i.length && (i = g("<tbody/>").appendTo(this));
                    o.nTBody = i[0];
                    i = r.children("tfoot");
                    if (0 === i.length && 0 < e.length && ("" !== o.oScroll.sX || "" !== o.oScroll.sY)) i = g("<tfoot/>").appendTo(this);
                    0 === i.length || 0 === i.children().length ? r.addClass(j.sNoFooter) : 0 < i.length && (o.nTFoot = i[0], ea(o.aoFooter, o.nTFoot));
                    if (f.aaData)
                        for (e = 0; e < f.aaData.length; e++) L(o, f.aaData[e]);
                    else(o.bDeferLoading || "dom" == z(o)) && ma(o, g(o.nTBody).children("tr"));
                    o.aiDisplay = o.aiDisplayMaster.slice();
                    o.bInitialised = !0;
                    !1 === n && ha(o)
                }
            });
            b = null;
            return this
        };
        var Ub = [],
            x = Array.prototype,
            dc = function(a) {
                var b, c, d = m.settings,
                    e = g.map(d, function(a) {
                        return a.nTable
                    });
                if (a) {
                    if (a.nTable && a.oApi) return [a];
                    if (a.nodeName && "table" === a.nodeName.toLowerCase()) return b = g.inArray(a, e), -1 !== b ? [d[b]] : null;
                    if (a && "function" === typeof a.settings) return a.settings().toArray();
                    "string" === typeof a ? c = g(a) : a instanceof g && (c = a)
                } else return [];
                if (c) return c.map(function() {
                    b = g.inArray(this, e);
                    return -1 !== b ? d[b] : null
                }).toArray()
            };
        t = function(a, b) {
            if (!(this instanceof t)) return new t(a,
                b);
            var c = [],
                d = function(a) {
                    (a = dc(a)) && c.push.apply(c, a)
                };
            if (g.isArray(a))
                for (var e = 0, f = a.length; e < f; e++) d(a[e]);
            else d(a);
            this.context = Oa(c);
            b && this.push.apply(this, b.toArray ? b.toArray() : b);
            this.selector = {
                rows: null,
                cols: null,
                opts: null
            };
            t.extend(this, this, Ub)
        };
        m.Api = t;
        t.prototype = {
            any: function() {
                return 0 !== this.count()
            },
            concat: x.concat,
            context: [],
            count: function() {
                return this.flatten().length
            },
            each: function(a) {
                for (var b = 0, c = this.length; b < c; b++) a.call(this, this[b], b, this);
                return this
            },
            eq: function(a) {
                var b =
                    this.context;
                return b.length > a ? new t(b[a], this[a]) : null
            },
            filter: function(a) {
                var b = [];
                if (x.filter) b = x.filter.call(this, a, this);
                else
                    for (var c = 0, d = this.length; c < d; c++) a.call(this, this[c], c, this) && b.push(this[c]);
                return new t(this.context, b)
            },
            flatten: function() {
                var a = [];
                return new t(this.context, a.concat.apply(a, this.toArray()))
            },
            join: x.join,
            indexOf: x.indexOf || function(a, b) {
                for (var c = b || 0, d = this.length; c < d; c++)
                    if (this[c] === a) return c;
                return -1
            },
            iterator: function(a, b, c, d) {
                var e = [],
                    f, h, g, j, n, l = this.context,
                    m, q, p = this.selector;
                "string" === typeof a && (d = c, c = b, b = a, a = !1);
                h = 0;
                for (g = l.length; h < g; h++) {
                    var o = new t(l[h]);
                    if ("table" === b) f = c.call(o, l[h], h), f !== k && e.push(f);
                    else if ("columns" === b || "rows" === b) f = c.call(o, l[h], this[h], h), f !== k && e.push(f);
                    else if ("column" === b || "column-rows" === b || "row" === b || "cell" === b) {
                        q = this[h];
                        "column-rows" === b && (m = Da(l[h], p.opts));
                        j = 0;
                        for (n = q.length; j < n; j++) f = q[j], f = "cell" === b ? c.call(o, l[h], f.row, f.column, h, j) : c.call(o, l[h], f, h, j, m), f !== k && e.push(f)
                    }
                }
                return e.length || d ? (a = new t(l, a ?
                    e.concat.apply([], e) : e), b = a.selector, b.rows = p.rows, b.cols = p.cols, b.opts = p.opts, a) : this
            },
            lastIndexOf: x.lastIndexOf || function(a, b) {
                return this.indexOf.apply(this.toArray.reverse(), arguments)
            },
            length: 0,
            map: function(a) {
                var b = [];
                if (x.map) b = x.map.call(this, a, this);
                else
                    for (var c = 0, d = this.length; c < d; c++) b.push(a.call(this, this[c], c));
                return new t(this.context, b)
            },
            pluck: function(a) {
                return this.map(function(b) {
                    return b[a]
                })
            },
            pop: x.pop,
            push: x.push,
            reduce: x.reduce || function(a, b) {
                return hb(this, a, b, 0, this.length,
                    1)
            },
            reduceRight: x.reduceRight || function(a, b) {
                return hb(this, a, b, this.length - 1, -1, -1)
            },
            reverse: x.reverse,
            selector: null,
            shift: x.shift,
            sort: x.sort,
            splice: x.splice,
            toArray: function() {
                return x.slice.call(this)
            },
            to$: function() {
                return g(this)
            },
            toJQuery: function() {
                return g(this)
            },
            unique: function() {
                return new t(this.context, Oa(this))
            },
            unshift: x.unshift
        };
        t.extend = function(a, b, c) {
            if (c.length && b && (b instanceof t || b.__dt_wrapper)) {
                var d, e, f, h = function(a, b, c) {
                    return function() {
                        var d = b.apply(a, arguments);
                        t.extend(d,
                            d, c.methodExt);
                        return d
                    }
                };
                d = 0;
                for (e = c.length; d < e; d++) f = c[d], b[f.name] = "function" === typeof f.val ? h(a, f.val, f) : g.isPlainObject(f.val) ? {} : f.val, b[f.name].__dt_wrapper = !0, t.extend(a, b[f.name], f.propExt)
            }
        };
        t.register = p = function(a, b) {
            if (g.isArray(a))
                for (var c = 0, d = a.length; c < d; c++) t.register(a[c], b);
            else
                for (var e = a.split("."), f = Ub, h, i, c = 0, d = e.length; c < d; c++) {
                    h = (i = -1 !== e[c].indexOf("()")) ? e[c].replace("()", "") : e[c];
                    var j;
                    a: {
                        j = 0;
                        for (var n = f.length; j < n; j++)
                            if (f[j].name === h) {
                                j = f[j];
                                break a
                            }
                        j = null
                    }
                    j || (j = {
                        name: h,
                        val: {},
                        methodExt: [],
                        propExt: []
                    }, f.push(j));
                    c === d - 1 ? j.val = b : f = i ? j.methodExt : j.propExt
                }
        };
        t.registerPlural = s = function(a, b, c) {
            t.register(a, c);
            t.register(b, function() {
                var a = c.apply(this, arguments);
                return a === this ? this : a instanceof t ? a.length ? g.isArray(a[0]) ? new t(a.context, a[0]) : a[0] : k : a
            })
        };
        p("tables()", function(a) {
            var b;
            if (a) {
                b = t;
                var c = this.context;
                if ("number" === typeof a) a = [c[a]];
                else var d = g.map(c, function(a) {
                        return a.nTable
                    }),
                    a = g(d).filter(a).map(function() {
                        var a = g.inArray(this, d);
                        return c[a]
                    }).toArray();
                b = new b(a)
            } else b = this;
            return b
        });
        p("table()", function(a) {
            var a = this.tables(a),
                b = a.context;
            return b.length ? new t(b[0]) : a
        });
        s("tables().nodes()", "table().node()", function() {
            return this.iterator("table", function(a) {
                return a.nTable
            }, 1)
        });
        s("tables().body()", "table().body()", function() {
            return this.iterator("table", function(a) {
                return a.nTBody
            }, 1)
        });
        s("tables().header()", "table().header()", function() {
            return this.iterator("table", function(a) {
                return a.nTHead
            }, 1)
        });
        s("tables().footer()", "table().footer()",
            function() {
                return this.iterator("table", function(a) {
                    return a.nTFoot
                }, 1)
            });
        s("tables().containers()", "table().container()", function() {
            return this.iterator("table", function(a) {
                return a.nTableWrapper
            }, 1)
        });
        p("draw()", function(a) {
            return this.iterator("table", function(b) {
                "page" === a ? M(b) : ("string" === typeof a && (a = "full-hold" === a ? !1 : !0), R(b, !1 === a))
            })
        });
        p("page()", function(a) {
            return a === k ? this.page.info().page : this.iterator("table", function(b) {
                Ua(b, a)
            })
        });
        p("page.info()", function() {
            if (0 === this.context.length) return k;
            var a = this.context[0],
                b = a._iDisplayStart,
                c = a._iDisplayLength,
                d = a.fnRecordsDisplay(),
                e = -1 === c;
            return {
                page: e ? 0 : Math.floor(b / c),
                pages: e ? 1 : Math.ceil(d / c),
                start: b,
                end: a.fnDisplayEnd(),
                length: c,
                recordsTotal: a.fnRecordsTotal(),
                recordsDisplay: d,
                serverSide: "ssp" === z(a)
            }
        });
        p("page.len()", function(a) {
            return a === k ? 0 !== this.context.length ? this.context[0]._iDisplayLength : k : this.iterator("table", function(b) {
                Sa(b, a)
            })
        });
        var Vb = function(a, b, c) {
            if (c) {
                var d = new t(a);
                d.one("draw", function() {
                    c(d.ajax.json())
                })
            }
            if ("ssp" ==
                z(a)) R(a, b);
            else {
                C(a, !0);
                var e = a.jqXHR;
                e && 4 !== e.readyState && e.abort();
                ra(a, [], function(c) {
                    oa(a);
                    for (var c = sa(a, c), d = 0, e = c.length; d < e; d++) L(a, c[d]);
                    R(a, b);
                    C(a, !1)
                })
            }
        };
        p("ajax.json()", function() {
            var a = this.context;
            if (0 < a.length) return a[0].json
        });
        p("ajax.params()", function() {
            var a = this.context;
            if (0 < a.length) return a[0].oAjaxData
        });
        p("ajax.reload()", function(a, b) {
            return this.iterator("table", function(c) {
                Vb(c, !1 === b, a)
            })
        });
        p("ajax.url()", function(a) {
            var b = this.context;
            if (a === k) {
                if (0 === b.length) return k;
                b = b[0];
                return b.ajax ? g.isPlainObject(b.ajax) ? b.ajax.url : b.ajax : b.sAjaxSource
            }
            return this.iterator("table", function(b) {
                g.isPlainObject(b.ajax) ? b.ajax.url = a : b.ajax = a
            })
        });
        p("ajax.url().load()", function(a, b) {
            return this.iterator("table", function(c) {
                Vb(c, !1 === b, a)
            })
        });
        var $a = function(a, b, c, d, e) {
                var f = [],
                    h, i, j, n, l, m;
                j = typeof b;
                if (!b || "string" === j || "function" === j || b.length === k) b = [b];
                j = 0;
                for (n = b.length; j < n; j++) {
                    i = b[j] && b[j].split ? b[j].split(",") : [b[j]];
                    l = 0;
                    for (m = i.length; l < m; l++)(h = c("string" === typeof i[l] ?
                        g.trim(i[l]) : i[l])) && h.length && f.push.apply(f, h)
                }
                a = v.selector[a];
                if (a.length) {
                    j = 0;
                    for (n = a.length; j < n; j++) f = a[j](d, e, f)
                }
                return f
            },
            ab = function(a) {
                a || (a = {});
                a.filter && a.search === k && (a.search = a.filter);
                return g.extend({
                    search: "none",
                    order: "current",
                    page: "all"
                }, a)
            },
            bb = function(a) {
                for (var b = 0, c = a.length; b < c; b++)
                    if (0 < a[b].length) return a[0] = a[b], a[0].length = 1, a.length = 1, a.context = [a.context[b]], a;
                a.length = 0;
                return a
            },
            Da = function(a, b) {
                var c, d, e, f = [],
                    h = a.aiDisplay;
                c = a.aiDisplayMaster;
                var i = b.search;
                d = b.order;
                e = b.page;
                if ("ssp" == z(a)) return "removed" === i ? [] : W(0, c.length);
                if ("current" == e) {
                    c = a._iDisplayStart;
                    for (d = a.fnDisplayEnd(); c < d; c++) f.push(h[c])
                } else if ("current" == d || "applied" == d) f = "none" == i ? c.slice() : "applied" == i ? h.slice() : g.map(c, function(a) {
                    return -1 === g.inArray(a, h) ? a : null
                });
                else if ("index" == d || "original" == d) {
                    c = 0;
                    for (d = a.aoData.length; c < d; c++) "none" == i ? f.push(c) : (e = g.inArray(c, h), (-1 === e && "removed" == i || 0 <= e && "applied" == i) && f.push(c))
                }
                return f
            };
        p("rows()", function(a, b) {
            a === k ? a = "" : g.isPlainObject(a) &&
                (b = a, a = "");
            var b = ab(b),
                c = this.iterator("table", function(c) {
                    var e = b;
                    return $a("row", a, function(a) {
                            var b = Qb(a);
                            if (b !== null && !e) return [b];
                            var i = Da(c, e);
                            if (b !== null && g.inArray(b, i) !== -1) return [b];
                            if (!a) return i;
                            if (typeof a === "function") return g.map(i, function(b) {
                                var e = c.aoData[b];
                                return a(b, e._aData, e.nTr) ? b : null
                            });
                            b = Tb(ia(c.aoData, i, "nTr"));
                            if (a.nodeName && g.inArray(a, b) !== -1) return [a._DT_RowIndex];
                            if (typeof a === "string" && a.charAt(0) === "#") {
                                i = c.aIds[a.replace(/^#/, "")];
                                if (i !== k) return [i.idx]
                            }
                            return g(b).filter(a).map(function() {
                                return this._DT_RowIndex
                            }).toArray()
                        },
                        c, e)
                }, 1);
            c.selector.rows = a;
            c.selector.opts = b;
            return c
        });
        p("rows().nodes()", function() {
            return this.iterator("row", function(a, b) {
                return a.aoData[b].nTr || k
            }, 1)
        });
        p("rows().data()", function() {
            return this.iterator(!0, "rows", function(a, b) {
                return ia(a.aoData, b, "_aData")
            }, 1)
        });
        s("rows().cache()", "row().cache()", function(a) {
            return this.iterator("row", function(b, c) {
                var d = b.aoData[c];
                return "search" === a ? d._aFilterData : d._aSortData
            }, 1)
        });
        s("rows().invalidate()", "row().invalidate()", function(a) {
            return this.iterator("row",
                function(b, c) {
                    da(b, c, a)
                })
        });
        s("rows().indexes()", "row().index()", function() {
            return this.iterator("row", function(a, b) {
                return b
            }, 1)
        });
        s("rows().ids()", "row().id()", function(a) {
            for (var b = [], c = this.context, d = 0, e = c.length; d < e; d++)
                for (var f = 0, g = this[d].length; f < g; f++) {
                    var i = c[d].rowIdFn(c[d].aoData[this[d][f]]._aData);
                    b.push((!0 === a ? "#" : "") + i)
                }
            return new t(c, b)
        });
        s("rows().remove()", "row().remove()", function() {
            var a = this;
            this.iterator("row", function(b, c, d) {
                var e = b.aoData;
                e.splice(c, 1);
                for (var f = 0, g = e.length; f <
                    g; f++) null !== e[f].nTr && (e[f].nTr._DT_RowIndex = f);
                pa(b.aiDisplayMaster, c);
                pa(b.aiDisplay, c);
                pa(a[d], c, !1);
                Ta(b)
            });
            this.iterator("table", function(a) {
                for (var c = 0, d = a.aoData.length; c < d; c++) a.aoData[c].idx = c
            });
            return this
        });
        p("rows.add()", function(a) {
            var b = this.iterator("table", function(b) {
                    var c, f, g, i = [];
                    f = 0;
                    for (g = a.length; f < g; f++) c = a[f], c.nodeName && "TR" === c.nodeName.toUpperCase() ? i.push(ma(b, c)[0]) : i.push(L(b, c));
                    return i
                }, 1),
                c = this.rows(-1);
            c.pop();
            c.push.apply(c, b.toArray());
            return c
        });
        p("row()", function(a,
            b) {
            return bb(this.rows(a, b))
        });
        p("row().data()", function(a) {
            var b = this.context;
            if (a === k) return b.length && this.length ? b[0].aoData[this[0]]._aData : k;
            b[0].aoData[this[0]]._aData = a;
            da(b[0], this[0], "data");
            return this
        });
        p("row().node()", function() {
            var a = this.context;
            return a.length && this.length ? a[0].aoData[this[0]].nTr || null : null
        });
        p("row.add()", function(a) {
            a instanceof g && a.length && (a = a[0]);
            var b = this.iterator("table", function(b) {
                return a.nodeName && "TR" === a.nodeName.toUpperCase() ? ma(b, a)[0] : L(b, a)
            });
            return this.row(b[0])
        });
        var cb = function(a, b) {
                var c = a.context;
                if (c.length && (c = c[0].aoData[b !== k ? b : a[0]]) && c._details) c._details.remove(), c._detailsShow = k, c._details = k
            },
            Wb = function(a, b) {
                var c = a.context;
                if (c.length && a.length) {
                    var d = c[0].aoData[a[0]];
                    if (d._details) {
                        (d._detailsShow = b) ? d._details.insertAfter(d.nTr): d._details.detach();
                        var e = c[0],
                            f = new t(e),
                            g = e.aoData;
                        f.off("draw.dt.DT_details column-visibility.dt.DT_details destroy.dt.DT_details");
                        0 < D(g, "_details").length && (f.on("draw.dt.DT_details", function(a,
                            b) {
                            e === b && f.rows({
                                page: "current"
                            }).eq(0).each(function(a) {
                                a = g[a];
                                a._detailsShow && a._details.insertAfter(a.nTr)
                            })
                        }), f.on("column-visibility.dt.DT_details", function(a, b) {
                            if (e === b)
                                for (var c, d = ba(b), f = 0, k = g.length; f < k; f++) c = g[f], c._details && c._details.children("td[colspan]").attr("colspan", d)
                        }), f.on("destroy.dt.DT_details", function(a, b) {
                            if (e === b)
                                for (var c = 0, d = g.length; c < d; c++) g[c]._details && cb(f, c)
                        }))
                    }
                }
            };
        p("row().child()", function(a, b) {
            var c = this.context;
            if (a === k) return c.length && this.length ? c[0].aoData[this[0]]._details :
                k;
            if (!0 === a) this.child.show();
            else if (!1 === a) cb(this);
            else if (c.length && this.length) {
                var d = c[0],
                    c = c[0].aoData[this[0]],
                    e = [],
                    f = function(a, b) {
                        if (g.isArray(a) || a instanceof g)
                            for (var c = 0, k = a.length; c < k; c++) f(a[c], b);
                        else a.nodeName && "tr" === a.nodeName.toLowerCase() ? e.push(a) : (c = g("<tr><td/></tr>").addClass(b), g("td", c).addClass(b).html(a)[0].colSpan = ba(d), e.push(c[0]))
                    };
                f(a, b);
                c._details && c._details.remove();
                c._details = g(e);
                c._detailsShow && c._details.insertAfter(c.nTr)
            }
            return this
        });
        p(["row().child.show()",
            "row().child().show()"
        ], function() {
            Wb(this, !0);
            return this
        });
        p(["row().child.hide()", "row().child().hide()"], function() {
            Wb(this, !1);
            return this
        });
        p(["row().child.remove()", "row().child().remove()"], function() {
            cb(this);
            return this
        });
        p("row().child.isShown()", function() {
            var a = this.context;
            return a.length && this.length ? a[0].aoData[this[0]]._detailsShow || !1 : !1
        });
        var ec = /^(.+):(name|visIdx|visible)$/,
            Xb = function(a, b, c, d, e) {
                for (var c = [], d = 0, f = e.length; d < f; d++) c.push(y(a, e[d], b));
                return c
            };
        p("columns()",
            function(a, b) {
                a === k ? a = "" : g.isPlainObject(a) && (b = a, a = "");
                var b = ab(b),
                    c = this.iterator("table", function(c) {
                        var e = a,
                            f = b,
                            h = c.aoColumns,
                            i = D(h, "sName"),
                            j = D(h, "nTh");
                        return $a("column", e, function(a) {
                            var b = Qb(a);
                            if (a === "") return W(h.length);
                            if (b !== null) return [b >= 0 ? b : h.length + b];
                            if (typeof a === "function") {
                                var e = Da(c, f);
                                return g.map(h, function(b, f) {
                                    return a(f, Xb(c, f, 0, 0, e), j[f]) ? f : null
                                })
                            }
                            var k = typeof a === "string" ? a.match(ec) : "";
                            if (k) switch (k[2]) {
                                case "visIdx":
                                case "visible":
                                    b = parseInt(k[1], 10);
                                    if (b < 0) {
                                        var m =
                                            g.map(h, function(a, b) {
                                                return a.bVisible ? b : null
                                            });
                                        return [m[m.length + b]]
                                    }
                                    return [la(c, b)];
                                case "name":
                                    return g.map(i, function(a, b) {
                                        return a === k[1] ? b : null
                                    })
                            } else return g(j).filter(a).map(function() {
                                return g.inArray(this, j)
                            }).toArray()
                        }, c, f)
                    }, 1);
                c.selector.cols = a;
                c.selector.opts = b;
                return c
            });
        s("columns().header()", "column().header()", function() {
            return this.iterator("column", function(a, b) {
                return a.aoColumns[b].nTh
            }, 1)
        });
        s("columns().footer()", "column().footer()", function() {
            return this.iterator("column",
                function(a, b) {
                    return a.aoColumns[b].nTf
                }, 1)
        });
        s("columns().data()", "column().data()", function() {
            return this.iterator("column-rows", Xb, 1)
        });
        s("columns().dataSrc()", "column().dataSrc()", function() {
            return this.iterator("column", function(a, b) {
                return a.aoColumns[b].mData
            }, 1)
        });
        s("columns().cache()", "column().cache()", function(a) {
            return this.iterator("column-rows", function(b, c, d, e, f) {
                return ia(b.aoData, f, "search" === a ? "_aFilterData" : "_aSortData", c)
            }, 1)
        });
        s("columns().nodes()", "column().nodes()", function() {
            return this.iterator("column-rows",
                function(a, b, c, d, e) {
                    return ia(a.aoData, e, "anCells", b)
                }, 1)
        });
        s("columns().visible()", "column().visible()", function(a, b) {
            return this.iterator("column", function(c, d) {
                if (a === k) return c.aoColumns[d].bVisible;
                var e = c.aoColumns,
                    f = e[d],
                    h = c.aoData,
                    i, j, n;
                if (a !== k && f.bVisible !== a) {
                    if (a) {
                        var l = g.inArray(!0, D(e, "bVisible"), d + 1);
                        i = 0;
                        for (j = h.length; i < j; i++) n = h[i].nTr, e = h[i].anCells, n && n.insertBefore(e[d], e[l] || null)
                    } else g(D(c.aoData, "anCells", d)).detach();
                    f.bVisible = a;
                    fa(c, c.aoHeader);
                    fa(c, c.aoFooter);
                    if (b === k ||
                        b) Y(c), (c.oScroll.sX || c.oScroll.sY) && Z(c);
                    w(c, null, "column-visibility", [c, d, a]);
                    ya(c)
                }
            })
        });
        s("columns().indexes()", "column().index()", function(a) {
            return this.iterator("column", function(b, c) {
                return "visible" === a ? aa(b, c) : c
            }, 1)
        });
        p("columns.adjust()", function() {
            return this.iterator("table", function(a) {
                Y(a)
            }, 1)
        });
        p("column.index()", function(a, b) {
            if (0 !== this.context.length) {
                var c = this.context[0];
                if ("fromVisible" === a || "toData" === a) return la(c, b);
                if ("fromData" === a || "toVisible" === a) return aa(c, b)
            }
        });
        p("column()",
            function(a, b) {
                return bb(this.columns(a, b))
            });
        p("cells()", function(a, b, c) {
            g.isPlainObject(a) && (a.row === k ? (c = a, a = null) : (c = b, b = null));
            g.isPlainObject(b) && (c = b, b = null);
            if (null === b || b === k) return this.iterator("table", function(b) {
                var d = a,
                    e = ab(c),
                    f = b.aoData,
                    h = Da(b, e),
                    i = Tb(ia(f, h, "anCells")),
                    j = g([].concat.apply([], i)),
                    l, n = b.aoColumns.length,
                    m, p, t, s, u, v;
                return $a("cell", d, function(a) {
                    var c = typeof a === "function";
                    if (a === null || a === k || c) {
                        m = [];
                        p = 0;
                        for (t = h.length; p < t; p++) {
                            l = h[p];
                            for (s = 0; s < n; s++) {
                                u = {
                                    row: l,
                                    column: s
                                };
                                if (c) {
                                    v = b.aoData[l];
                                    a(u, y(b, l, s), v.anCells ? v.anCells[s] : null) && m.push(u)
                                } else m.push(u)
                            }
                        }
                        return m
                    }
                    return g.isPlainObject(a) ? [a] : j.filter(a).map(function(a, b) {
                        l = b.parentNode._DT_RowIndex;
                        return {
                            row: l,
                            column: g.inArray(b, f[l].anCells)
                        }
                    }).toArray()
                }, b, e)
            });
            var d = this.columns(b, c),
                e = this.rows(a, c),
                f, h, i, j, n, l = this.iterator("table", function(a, b) {
                    f = [];
                    h = 0;
                    for (i = e[b].length; h < i; h++) {
                        j = 0;
                        for (n = d[b].length; j < n; j++) f.push({
                            row: e[b][h],
                            column: d[b][j]
                        })
                    }
                    return f
                }, 1);
            g.extend(l.selector, {
                cols: b,
                rows: a,
                opts: c
            });
            return l
        });
        s("cells().nodes()", "cell().node()", function() {
            return this.iterator("cell", function(a, b, c) {
                return (a = a.aoData[b].anCells) ? a[c] : k
            }, 1)
        });
        p("cells().data()", function() {
            return this.iterator("cell", function(a, b, c) {
                return y(a, b, c)
            }, 1)
        });
        s("cells().cache()", "cell().cache()", function(a) {
            a = "search" === a ? "_aFilterData" : "_aSortData";
            return this.iterator("cell", function(b, c, d) {
                return b.aoData[c][a][d]
            }, 1)
        });
        s("cells().render()", "cell().render()", function(a) {
            return this.iterator("cell", function(b, c, d) {
                return y(b,
                    c, d, a)
            }, 1)
        });
        s("cells().indexes()", "cell().index()", function() {
            return this.iterator("cell", function(a, b, c) {
                return {
                    row: b,
                    column: c,
                    columnVisible: aa(a, c)
                }
            }, 1)
        });
        s("cells().invalidate()", "cell().invalidate()", function(a) {
            return this.iterator("cell", function(b, c, d) {
                da(b, c, a, d)
            })
        });
        p("cell()", function(a, b, c) {
            return bb(this.cells(a, b, c))
        });
        p("cell().data()", function(a) {
            var b = this.context,
                c = this[0];
            if (a === k) return b.length && c.length ? y(b[0], c[0].row, c[0].column) : k;
            Ja(b[0], c[0].row, c[0].column, a);
            da(b[0], c[0].row,
                "data", c[0].column);
            return this
        });
        p("order()", function(a, b) {
            var c = this.context;
            if (a === k) return 0 !== c.length ? c[0].aaSorting : k;
            "number" === typeof a ? a = [
                [a, b]
            ] : g.isArray(a[0]) || (a = Array.prototype.slice.call(arguments));
            return this.iterator("table", function(b) {
                b.aaSorting = a.slice()
            })
        });
        p("order.listener()", function(a, b, c) {
            return this.iterator("table", function(d) {
                Pa(d, a, b, c)
            })
        });
        p(["columns().order()", "column().order()"], function(a) {
            var b = this;
            return this.iterator("table", function(c, d) {
                var e = [];
                g.each(b[d],
                    function(b, c) {
                        e.push([c, a])
                    });
                c.aaSorting = e
            })
        });
        p("search()", function(a, b, c, d) {
            var e = this.context;
            return a === k ? 0 !== e.length ? e[0].oPreviousSearch.sSearch : k : this.iterator("table", function(e) {
                e.oFeatures.bFilter && ga(e, g.extend({}, e.oPreviousSearch, {
                    sSearch: a + "",
                    bRegex: null === b ? !1 : b,
                    bSmart: null === c ? !0 : c,
                    bCaseInsensitive: null === d ? !0 : d
                }), 1)
            })
        });
        s("columns().search()", "column().search()", function(a, b, c, d) {
            return this.iterator("column", function(e, f) {
                var h = e.aoPreSearchCols;
                if (a === k) return h[f].sSearch;
                e.oFeatures.bFilter &&
                    (g.extend(h[f], {
                        sSearch: a + "",
                        bRegex: null === b ? !1 : b,
                        bSmart: null === c ? !0 : c,
                        bCaseInsensitive: null === d ? !0 : d
                    }), ga(e, e.oPreviousSearch, 1))
            })
        });
        p("state()", function() {
            return this.context.length ? this.context[0].oSavedState : null
        });
        p("state.clear()", function() {
            return this.iterator("table", function(a) {
                a.fnStateSaveCallback.call(a.oInstance, a, {})
            })
        });
        p("state.loaded()", function() {
            return this.context.length ? this.context[0].oLoadedState : null
        });
        p("state.save()", function() {
            return this.iterator("table", function(a) {
                ya(a)
            })
        });
        m.versionCheck = m.fnVersionCheck = function(a) {
            for (var b = m.version.split("."), a = a.split("."), c, d, e = 0, f = a.length; e < f; e++)
                if (c = parseInt(b[e], 10) || 0, d = parseInt(a[e], 10) || 0, c !== d) return c > d;
            return !0
        };
        m.isDataTable = m.fnIsDataTable = function(a) {
            var b = g(a).get(0),
                c = !1;
            g.each(m.settings, function(a, e) {
                var f = e.nScrollHead ? g("table", e.nScrollHead)[0] : null,
                    h = e.nScrollFoot ? g("table", e.nScrollFoot)[0] : null;
                if (e.nTable === b || f === b || h === b) c = !0
            });
            return c
        };
        m.tables = m.fnTables = function(a) {
            var b = !1;
            g.isPlainObject(a) && (b =
                a.api, a = a.visible);
            var c = g.map(m.settings, function(b) {
                if (!a || a && g(b.nTable).is(":visible")) return b.nTable
            });
            return b ? new t(c) : c
        };
        m.util = {
            throttle: ua,
            escapeRegex: va
        };
        m.camelToHungarian = I;
        p("$()", function(a, b) {
            var c = this.rows(b).nodes(),
                c = g(c);
            return g([].concat(c.filter(a).toArray(), c.find(a).toArray()))
        });
        g.each(["on", "one", "off"], function(a, b) {
            p(b + "()", function() {
                var a = Array.prototype.slice.call(arguments);
                a[0].match(/\.dt\b/) || (a[0] += ".dt");
                var d = g(this.tables().nodes());
                d[b].apply(d, a);
                return this
            })
        });
        p("clear()", function() {
            return this.iterator("table", function(a) {
                oa(a)
            })
        });
        p("settings()", function() {
            return new t(this.context, this.context)
        });
        p("init()", function() {
            var a = this.context;
            return a.length ? a[0].oInit : null
        });
        p("data()", function() {
            return this.iterator("table", function(a) {
                return D(a.aoData, "_aData")
            }).flatten()
        });
        p("destroy()", function(a) {
            a = a || !1;
            return this.iterator("table", function(b) {
                var c = b.nTableWrapper.parentNode,
                    d = b.oClasses,
                    e = b.nTable,
                    f = b.nTBody,
                    h = b.nTHead,
                    i = b.nTFoot,
                    j = g(e),
                    f = g(f),
                    k = g(b.nTableWrapper),
                    l = g.map(b.aoData, function(a) {
                        return a.nTr
                    }),
                    p;
                b.bDestroying = !0;
                w(b, "aoDestroyCallback", "destroy", [b]);
                a || (new t(b)).columns().visible(!0);
                k.unbind(".DT").find(":not(tbody *)").unbind(".DT");
                g(Fa).unbind(".DT-" + b.sInstance);
                e != h.parentNode && (j.children("thead").detach(), j.append(h));
                i && e != i.parentNode && (j.children("tfoot").detach(), j.append(i));
                b.aaSorting = [];
                b.aaSortingFixed = [];
                xa(b);
                g(l).removeClass(b.asStripeClasses.join(" "));
                g("th, td", h).removeClass(d.sSortable + " " + d.sSortableAsc +
                    " " + d.sSortableDesc + " " + d.sSortableNone);
                b.bJUI && (g("th span." + d.sSortIcon + ", td span." + d.sSortIcon, h).detach(), g("th, td", h).each(function() {
                    var a = g("div." + d.sSortJUIWrapper, this);
                    g(this).append(a.contents());
                    a.detach()
                }));
                f.children().detach();
                f.append(l);
                h = a ? "remove" : "detach";
                j[h]();
                k[h]();
                !a && c && (c.insertBefore(e, b.nTableReinsertBefore), j.css("width", b.sDestroyWidth).removeClass(d.sTable), (p = b.asDestroyStripes.length) && f.children().each(function(a) {
                    g(this).addClass(b.asDestroyStripes[a % p])
                }));
                c = g.inArray(b, m.settings); - 1 !== c && m.settings.splice(c, 1)
            })
        });
        g.each(["column", "row", "cell"], function(a, b) {
            p(b + "s().every()", function(a) {
                return this.iterator(b, function(d, e, f, g, i) {
                    a.call((new t(d))[b](e, "cell" === b ? f : k), e, f, g, i)
                })
            })
        });
        p("i18n()", function(a, b, c) {
            var d = this.context[0],
                a = P(a)(d.oLanguage);
            a === k && (a = b);
            c !== k && g.isPlainObject(a) && (a = a[c] !== k ? a[c] : a._);
            return a.replace("%d", c)
        });
        m.version = "1.10.8";
        m.settings = [];
        m.models = {};
        m.models.oSearch = {
            bCaseInsensitive: !0,
            sSearch: "",
            bRegex: !1,
            bSmart: !0
        };
        m.models.oRow = {
            nTr: null,
            anCells: null,
            _aData: [],
            _aSortData: null,
            _aFilterData: null,
            _sFilterRow: null,
            _sRowStripe: "",
            src: null,
            idx: -1
        };
        m.models.oColumn = {
            idx: null,
            aDataSort: null,
            asSorting: null,
            bSearchable: null,
            bSortable: null,
            bVisible: null,
            _sManualType: null,
            _bAttrSrc: !1,
            fnCreatedCell: null,
            fnGetData: null,
            fnSetData: null,
            mData: null,
            mRender: null,
            nTh: null,
            nTf: null,
            sClass: null,
            sContentPadding: null,
            sDefaultContent: null,
            sName: null,
            sSortDataType: "std",
            sSortingClass: null,
            sSortingClassJUI: null,
            sTitle: null,
            sType: null,
            sWidth: null,
            sWidthOrig: null
        };
        m.defaults = {
            aaData: null,
            aaSorting: [
                [0, "asc"]
            ],
            aaSortingFixed: [],
            ajax: null,
            aLengthMenu: [10, 25, 50, 100],
            aoColumns: null,
            aoColumnDefs: null,
            aoSearchCols: [],
            asStripeClasses: null,
            bAutoWidth: !0,
            bDeferRender: !1,
            bDestroy: !1,
            bFilter: !0,
            bInfo: !0,
            bJQueryUI: !1,
            bLengthChange: !0,
            bPaginate: !0,
            bProcessing: !1,
            bRetrieve: !1,
            bScrollCollapse: !1,
            bServerSide: !1,
            bSort: !0,
            bSortMulti: !0,
            bSortCellsTop: !1,
            bSortClasses: !0,
            bStateSave: !1,
            fnCreatedRow: null,
            fnDrawCallback: null,
            fnFooterCallback: null,
            fnFormatNumber: function(a) {
                return a.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                    this.oLanguage.sThousands)
            },
            fnHeaderCallback: null,
            fnInfoCallback: null,
            fnInitComplete: null,
            fnPreDrawCallback: null,
            fnRowCallback: null,
            fnServerData: null,
            fnServerParams: null,
            fnStateLoadCallback: function(a) {
                try {
                    return JSON.parse((-1 === a.iStateDuration ? sessionStorage : localStorage).getItem("DataTables_" + a.sInstance + "_" + location.pathname))
                } catch (b) {}
            },
            fnStateLoadParams: null,
            fnStateLoaded: null,
            fnStateSaveCallback: function(a, b) {
                try {
                    (-1 === a.iStateDuration ? sessionStorage : localStorage).setItem("DataTables_" + a.sInstance +
                        "_" + location.pathname, JSON.stringify(b))
                } catch (c) {}
            },
            fnStateSaveParams: null,
            iStateDuration: 7200,
            iDeferLoading: null,
            iDisplayLength: 10,
            iDisplayStart: 0,
            iTabIndex: 0,
            oClasses: {},
            oLanguage: {
                oAria: {
                    sSortAscending: ": activate to sort column ascending",
                    sSortDescending: ": activate to sort column descending"
                },
                oPaginate: {
                    sFirst: "First",
                    sLast: "Last",
                    sNext: "Next",
                    sPrevious: "Previous"
                },
                sEmptyTable: "No data available in table",
                sInfo: "Showing _START_ to _END_ of _TOTAL_ entries",
                sInfoEmpty: "Showing 0 to 0 of 0 entries",
                sInfoFiltered: "(filtered from _MAX_ total entries)",
                sInfoPostFix: "",
                sDecimal: "",
                sThousands: ",",
                sLengthMenu: "Show _MENU_ entries",
                sLoadingRecords: "Loading...",
                sProcessing: "Processing...",
                sSearch: "Search:",
                sSearchPlaceholder: "",
                sUrl: "",
                sZeroRecords: "No matching records found"
            },
            oSearch: g.extend({}, m.models.oSearch),
            sAjaxDataProp: "data",
            sAjaxSource: null,
            sDom: "lfrtip",
            searchDelay: null,
            sPaginationType: "simple_numbers",
            sScrollX: "",
            sScrollXInner: "",
            sScrollY: "",
            sServerMethod: "GET",
            renderer: null,
            rowId: "DT_RowId"
        };
        X(m.defaults);
        m.defaults.column = {
            aDataSort: null,
            iDataSort: -1,
            asSorting: ["asc", "desc"],
            bSearchable: !0,
            bSortable: !0,
            bVisible: !0,
            fnCreatedCell: null,
            mData: null,
            mRender: null,
            sCellType: "td",
            sClass: "",
            sContentPadding: "",
            sDefaultContent: null,
            sName: "",
            sSortDataType: "std",
            sTitle: null,
            sType: null,
            sWidth: null
        };
        X(m.defaults.column);
        m.models.oSettings = {
            oFeatures: {
                bAutoWidth: null,
                bDeferRender: null,
                bFilter: null,
                bInfo: null,
                bLengthChange: null,
                bPaginate: null,
                bProcessing: null,
                bServerSide: null,
                bSort: null,
                bSortMulti: null,
                bSortClasses: null,
                bStateSave: null
            },
            oScroll: {
                bCollapse: null,
                iBarWidth: 0,
                sX: null,
                sXInner: null,
                sY: null
            },
            oLanguage: {
                fnInfoCallback: null
            },
            oBrowser: {
                bScrollOversize: !1,
                bScrollbarLeft: !1,
                bBounding: !1
            },
            ajax: null,
            aanFeatures: [],
            aoData: [],
            aiDisplay: [],
            aiDisplayMaster: [],
            aIds: {},
            aoColumns: [],
            aoHeader: [],
            aoFooter: [],
            oPreviousSearch: {},
            aoPreSearchCols: [],
            aaSorting: null,
            aaSortingFixed: [],
            asStripeClasses: null,
            asDestroyStripes: [],
            sDestroyWidth: 0,
            aoRowCallback: [],
            aoHeaderCallback: [],
            aoFooterCallback: [],
            aoDrawCallback: [],
            aoRowCreatedCallback: [],
            aoPreDrawCallback: [],
            aoInitComplete: [],
            aoStateSaveParams: [],
            aoStateLoadParams: [],
            aoStateLoaded: [],
            sTableId: "",
            nTable: null,
            nTHead: null,
            nTFoot: null,
            nTBody: null,
            nTableWrapper: null,
            bDeferLoading: !1,
            bInitialised: !1,
            aoOpenRows: [],
            sDom: null,
            searchDelay: null,
            sPaginationType: "two_button",
            iStateDuration: 0,
            aoStateSave: [],
            aoStateLoad: [],
            oSavedState: null,
            oLoadedState: null,
            sAjaxSource: null,
            sAjaxDataProp: null,
            bAjaxDataGet: !0,
            jqXHR: null,
            json: k,
            oAjaxData: k,
            fnServerData: null,
            aoServerParams: [],
            sServerMethod: null,
            fnFormatNumber: null,
            aLengthMenu: null,
            iDraw: 0,
            bDrawing: !1,
            iDrawError: -1,
            _iDisplayLength: 10,
            _iDisplayStart: 0,
            _iRecordsTotal: 0,
            _iRecordsDisplay: 0,
            bJUI: null,
            oClasses: {},
            bFiltered: !1,
            bSorted: !1,
            bSortCellsTop: null,
            oInit: null,
            aoDestroyCallback: [],
            fnRecordsTotal: function() {
                return "ssp" == z(this) ? 1 * this._iRecordsTotal : this.aiDisplayMaster.length
            },
            fnRecordsDisplay: function() {
                return "ssp" == z(this) ? 1 * this._iRecordsDisplay : this.aiDisplay.length
            },
            fnDisplayEnd: function() {
                var a = this._iDisplayLength,
                    b = this._iDisplayStart,
                    c = b + a,
                    d = this.aiDisplay.length,
                    e = this.oFeatures,
                    f = e.bPaginate;
                return e.bServerSide ? !1 === f || -1 === a ? b + d : Math.min(b + a, this._iRecordsDisplay) : !f || c > d || -1 === a ? d : c
            },
            oInstance: null,
            sInstance: null,
            iTabIndex: 0,
            nScrollHead: null,
            nScrollFoot: null,
            aLastSort: [],
            oPlugins: {},
            rowIdFn: null,
            rowId: null
        };
        m.ext = v = {
            buttons: {},
            classes: {},
            errMode: "alert",
            feature: [],
            search: [],
            selector: {
                cell: [],
                column: [],
                row: []
            },
            internal: {},
            legacy: {
                ajax: null
            },
            pager: {},
            renderer: {
                pageButton: {},
                header: {}
            },
            order: {},
            type: {
                detect: [],
                search: {},
                order: {}
            },
            _unique: 0,
            fnVersionCheck: m.fnVersionCheck,
            iApiIndex: 0,
            oJUIClasses: {},
            sVersion: m.version
        };
        g.extend(v, {
            afnFiltering: v.search,
            aTypes: v.type.detect,
            ofnSearch: v.type.search,
            oSort: v.type.order,
            afnSortData: v.order,
            aoFeatures: v.feature,
            oApi: v.internal,
            oStdClasses: v.classes,
            oPagination: v.pager
        });
        g.extend(m.ext.classes, {
            sTable: "dataTable",
            sNoFooter: "no-footer",
            sPageButton: "paginate_button",
            sPageButtonActive: "current",
            sPageButtonDisabled: "disabled",
            sStripeOdd: "odd",
            sStripeEven: "even",
            sRowEmpty: "dataTables_empty",
            sWrapper: "dataTables_wrapper",
            sFilter: "dataTables_filter",
            sInfo: "dataTables_info",
            sPaging: "dataTables_paginate paging_",
            sLength: "dataTables_length",
            sProcessing: "dataTables_processing",
            sSortAsc: "sorting_asc",
            sSortDesc: "sorting_desc",
            sSortable: "sorting",
            sSortableAsc: "sorting_asc_disabled",
            sSortableDesc: "sorting_desc_disabled",
            sSortableNone: "sorting_disabled",
            sSortColumn: "sorting_",
            sFilterInput: "",
            sLengthSelect: "",
            sScrollWrapper: "dataTables_scroll",
            sScrollHead: "dataTables_scrollHead",
            sScrollHeadInner: "dataTables_scrollHeadInner",
            sScrollBody: "dataTables_scrollBody",
            sScrollFoot: "dataTables_scrollFoot",
            sScrollFootInner: "dataTables_scrollFootInner",
            sHeaderTH: "",
            sFooterTH: "",
            sSortJUIAsc: "",
            sSortJUIDesc: "",
            sSortJUI: "",
            sSortJUIAscAllowed: "",
            sSortJUIDescAllowed: "",
            sSortJUIWrapper: "",
            sSortIcon: "",
            sJUIHeader: "",
            sJUIFooter: ""
        });
        var Ea = "",
            Ea = "",
            G = Ea + "ui-state-default",
            ja = Ea + "css_right ui-icon ui-icon-",
            Yb = Ea + "fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix";
        g.extend(m.ext.oJUIClasses, m.ext.classes, {
            sPageButton: "fg-button ui-button " +
                G,
            sPageButtonActive: "ui-state-disabled",
            sPageButtonDisabled: "ui-state-disabled",
            sPaging: "dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_",
            sSortAsc: G + " sorting_asc",
            sSortDesc: G + " sorting_desc",
            sSortable: G + " sorting",
            sSortableAsc: G + " sorting_asc_disabled",
            sSortableDesc: G + " sorting_desc_disabled",
            sSortableNone: G + " sorting_disabled",
            sSortJUIAsc: ja + "triangle-1-n",
            sSortJUIDesc: ja + "triangle-1-s",
            sSortJUI: ja + "carat-2-n-s",
            sSortJUIAscAllowed: ja + "carat-1-n",
            sSortJUIDescAllowed: ja +
                "carat-1-s",
            sSortJUIWrapper: "DataTables_sort_wrapper",
            sSortIcon: "DataTables_sort_icon",
            sScrollHead: "dataTables_scrollHead " + G,
            sScrollFoot: "dataTables_scrollFoot " + G,
            sHeaderTH: G,
            sFooterTH: G,
            sJUIHeader: Yb + " ui-corner-tl ui-corner-tr",
            sJUIFooter: Yb + " ui-corner-bl ui-corner-br"
        });
        var Nb = m.ext.pager;
        g.extend(Nb, {
            simple: function() {
                return ["previous", "next"]
            },
            full: function() {
                return ["first", "previous", "next", "last"]
            },
            numbers: function(a, b) {
                return [Aa(a, b)]
            },
            simple_numbers: function(a, b) {
                return ["previous", Aa(a,
                    b), "next"]
            },
            full_numbers: function(a, b) {
                return ["first", "previous", Aa(a, b), "next", "last"]
            },
            _numbers: Aa,
            numbers_length: 7
        });
        g.extend(!0, m.ext.renderer, {
            pageButton: {
                _: function(a, b, c, d, e, f) {
                    var h = a.oClasses,
                        i = a.oLanguage.oPaginate,
                        j, k, l = 0,
                        m = function(b, d) {
                            var p, q, t, s, u = function(b) {
                                Ua(a, b.data.action, true)
                            };
                            p = 0;
                            for (q = d.length; p < q; p++) {
                                s = d[p];
                                if (g.isArray(s)) {
                                    t = g("<" + (s.DT_el || "div") + "/>").appendTo(b);
                                    m(t, s)
                                } else {
                                    j = null;
                                    k = "";
                                    switch (s) {
                                        case "ellipsis":
                                            b.append('<span class="ellipsis">&#x2026;</span>');
                                            break;
                                        case "first":
                                            j = i.sFirst;
                                            k = s + (e > 0 ? "" : " " + h.sPageButtonDisabled);
                                            break;
                                        case "previous":
                                            j = i.sPrevious;
                                            k = s + (e > 0 ? "" : " " + h.sPageButtonDisabled);
                                            break;
                                        case "next":
                                            j = i.sNext;
                                            k = s + (e < f - 1 ? "" : " " + h.sPageButtonDisabled);
                                            break;
                                        case "last":
                                            j = i.sLast;
                                            k = s + (e < f - 1 ? "" : " " + h.sPageButtonDisabled);
                                            break;
                                        default:
                                            j = s + 1;
                                            k = e === s ? h.sPageButtonActive : ""
                                    }
                                    if (j !== null) {
                                        t = g("<a>", {
                                            "class": h.sPageButton + " " + k,
                                            "aria-controls": a.sTableId,
                                            "data-dt-idx": l,
                                            tabindex: a.iTabIndex,
                                            id: c === 0 && typeof s === "string" ? a.sTableId + "_" + s : null
                                        }).html(j).appendTo(b);
                                        Wa(t, {
                                            action: s
                                        }, u);
                                        l++
                                    }
                                }
                            }
                        },
                        p;
                    try {
                        p = g(b).find(T.activeElement).data("dt-idx")
                    } catch (t) {}
                    m(g(b).empty(), d);
                    p && g(b).find("[data-dt-idx=" + p + "]").focus()
                }
            }
        });
        g.extend(m.ext.type.detect, [function(a, b) {
            var c = b.oLanguage.sDecimal;
            return Za(a, c) ? "num" + c : null
        }, function(a) {
            if (a && !(a instanceof Date) && (!bc.test(a) || !cc.test(a))) return null;
            var b = Date.parse(a);
            return null !== b && !isNaN(b) || K(a) ? "date" : null
        }, function(a, b) {
            var c = b.oLanguage.sDecimal;
            return Za(a, c, !0) ? "num-fmt" + c : null
        }, function(a, b) {
            var c = b.oLanguage.sDecimal;
            return Sb(a, c) ? "html-num" + c : null
        }, function(a, b) {
            var c = b.oLanguage.sDecimal;
            return Sb(a, c, !0) ? "html-num-fmt" + c : null
        }, function(a) {
            return K(a) || "string" === typeof a && -1 !== a.indexOf("<") ? "html" : null
        }]);
        g.extend(m.ext.type.search, {
            html: function(a) {
                return K(a) ? a : "string" === typeof a ? a.replace(Pb, " ").replace(Ca, "") : ""
            },
            string: function(a) {
                return K(a) ? a : "string" === typeof a ? a.replace(Pb, " ") : a
            }
        });
        var Ba = function(a, b, c, d) {
            if (0 !== a && (!a || "-" === a)) return -Infinity;
            b && (a = Rb(a, b));
            a.replace && (c && (a = a.replace(c, "")),
                d && (a = a.replace(d, "")));
            return 1 * a
        };
        g.extend(v.type.order, {
            "date-pre": function(a) {
                return Date.parse(a) || 0
            },
            "html-pre": function(a) {
                return K(a) ? "" : a.replace ? a.replace(/<.*?>/g, "").toLowerCase() : a + ""
            },
            "string-pre": function(a) {
                return K(a) ? "" : "string" === typeof a ? a.toLowerCase() : !a.toString ? "" : a.toString()
            },
            "string-asc": function(a, b) {
                return a < b ? -1 : a > b ? 1 : 0
            },
            "string-desc": function(a, b) {
                return a < b ? 1 : a > b ? -1 : 0
            }
        });
        db("");
        g.extend(!0, m.ext.renderer, {
            header: {
                _: function(a, b, c, d) {
                    g(a.nTable).on("order.dt.DT", function(e,
                        f, g, i) {
                        if (a === f) {
                            e = c.idx;
                            b.removeClass(c.sSortingClass + " " + d.sSortAsc + " " + d.sSortDesc).addClass(i[e] == "asc" ? d.sSortAsc : i[e] == "desc" ? d.sSortDesc : c.sSortingClass)
                        }
                    })
                },
                jqueryui: function(a, b, c, d) {
                    g("<div/>").addClass(d.sSortJUIWrapper).append(b.contents()).append(g("<span/>").addClass(d.sSortIcon + " " + c.sSortingClassJUI)).appendTo(b);
                    g(a.nTable).on("order.dt.DT", function(e, f, g, i) {
                        if (a === f) {
                            e = c.idx;
                            b.removeClass(d.sSortAsc + " " + d.sSortDesc).addClass(i[e] == "asc" ? d.sSortAsc : i[e] == "desc" ? d.sSortDesc : c.sSortingClass);
                            b.find("span." + d.sSortIcon).removeClass(d.sSortJUIAsc + " " + d.sSortJUIDesc + " " + d.sSortJUI + " " + d.sSortJUIAscAllowed + " " + d.sSortJUIDescAllowed).addClass(i[e] == "asc" ? d.sSortJUIAsc : i[e] == "desc" ? d.sSortJUIDesc : c.sSortingClassJUI)
                        }
                    })
                }
            }
        });
        m.render = {
            number: function(a, b, c, d, e) {
                return {
                    display: function(f) {
                        if ("number" !== typeof f && "string" !== typeof f) return f;
                        var g = 0 > f ? "-" : "",
                            f = Math.abs(parseFloat(f)),
                            i = parseInt(f, 10),
                            f = c ? b + (f - i).toFixed(c).substring(2) : "";
                        return g + (d || "") + i.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                            a) + f + (e || "")
                    }
                }
            }
        };
        g.extend(m.ext.internal, {
            _fnExternApiFunc: Ob,
            _fnBuildAjax: ra,
            _fnAjaxUpdate: lb,
            _fnAjaxParameters: ub,
            _fnAjaxUpdateDraw: vb,
            _fnAjaxDataSrc: sa,
            _fnAddColumn: Ga,
            _fnColumnOptions: ka,
            _fnAdjustColumnSizing: Y,
            _fnVisibleToColumnIndex: la,
            _fnColumnIndexToVisible: aa,
            _fnVisbleColumns: ba,
            _fnGetColumns: $,
            _fnColumnTypes: Ia,
            _fnApplyColumnDefs: ib,
            _fnHungarianMap: X,
            _fnCamelToHungarian: I,
            _fnLanguageCompat: S,
            _fnBrowserDetect: gb,
            _fnAddData: L,
            _fnAddTr: ma,
            _fnNodeToDataIndex: function(a, b) {
                return b._DT_RowIndex !==
                    k ? b._DT_RowIndex : null
            },
            _fnNodeToColumnIndex: function(a, b, c) {
                return g.inArray(c, a.aoData[b].anCells)
            },
            _fnGetCellData: y,
            _fnSetCellData: Ja,
            _fnSplitObjNotation: La,
            _fnGetObjectDataFn: P,
            _fnSetObjectDataFn: Q,
            _fnGetDataMaster: Ma,
            _fnClearTable: oa,
            _fnDeleteIndex: pa,
            _fnInvalidate: da,
            _fnGetRowElements: na,
            _fnCreateTr: Ka,
            _fnBuildHead: kb,
            _fnDrawHead: fa,
            _fnDraw: M,
            _fnReDraw: R,
            _fnAddOptionsHtml: nb,
            _fnDetectHeader: ea,
            _fnGetUniqueThs: qa,
            _fnFeatureHtmlFilter: pb,
            _fnFilterComplete: ga,
            _fnFilterCustom: yb,
            _fnFilterColumn: xb,
            _fnFilter: wb,
            _fnFilterCreateSearch: Ra,
            _fnEscapeRegex: va,
            _fnFilterData: zb,
            _fnFeatureHtmlInfo: sb,
            _fnUpdateInfo: Cb,
            _fnInfoMacros: Db,
            _fnInitialise: ha,
            _fnInitComplete: ta,
            _fnLengthChange: Sa,
            _fnFeatureHtmlLength: ob,
            _fnFeatureHtmlPaginate: tb,
            _fnPageChange: Ua,
            _fnFeatureHtmlProcessing: qb,
            _fnProcessingDisplay: C,
            _fnFeatureHtmlTable: rb,
            _fnScrollDraw: Z,
            _fnApplyToChildren: H,
            _fnCalculateColumnWidths: Ha,
            _fnThrottle: ua,
            _fnConvertToWidth: Fb,
            _fnGetWidestNode: Gb,
            _fnGetMaxLenString: Hb,
            _fnStringToCss: u,
            _fnScrollBarWidth: Ib,
            _fnSortFlatten: V,
            _fnSort: mb,
            _fnSortAria: Kb,
            _fnSortListener: Va,
            _fnSortAttachListener: Pa,
            _fnSortingClasses: xa,
            _fnSortData: Jb,
            _fnSaveState: ya,
            _fnLoadState: Lb,
            _fnSettingsFromNode: za,
            _fnLog: J,
            _fnMap: F,
            _fnBindAction: Wa,
            _fnCallbackReg: A,
            _fnCallbackFire: w,
            _fnLengthOverflow: Ta,
            _fnRenderer: Qa,
            _fnDataSource: z,
            _fnRowAttributes: Na,
            _fnCalculateEnd: function() {}
        });
        g.fn.dataTable = m;
        g.fn.dataTableSettings = m.settings;
        g.fn.dataTableExt = m.ext;
        g.fn.DataTable = function(a) {
            return g(this).dataTable(a).api()
        };
        g.each(m, function(a,
            b) {
            g.fn.DataTable[a] = b
        });
        return g.fn.dataTable
    };
    "function" === typeof define && define.amd ? define("datatables", ["jquery"], S) : "object" === typeof exports ? module.exports = S(require("jquery")) : jQuery && !jQuery.fn.dataTable && S(jQuery)
})(window, document);
