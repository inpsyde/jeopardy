jQuery.noConflict();
( function( $ ) {
    joepardy = {
        init : function () {
			var pads = joepardy.get_all_joepardy_term_ids();
			$.each( pads, function( key, value ) { 
				var cookie = Cookies[ 'question_' + key ];
				if ( cookie ) {
					$( '#category_' + key ).fadeOut( function () {
						$( '#question_' + key ).fadeIn().css( 'display', 'block' );
					} );
				}
			} );
        },
        
        get_all_joepardy_term_ids : function () {
        	var post_vars = {
				action: 'get_all_joepardy_term_ids'
			};
			var pads = $.ajax( {
				url: ajaxurl,
				data: post_vars,
				async: false,
				dataType: 'json',
				success: function ( response ) {
					return response;
				}
			} ).responseText;
			pads = $.parseJSON( pads );
			return pads;
        },
        
        get_answer : function ( id ) {
        	$( '#category_' + id ).fadeOut( function () {
        		$( '#answer_' + id ).fadeIn().css( { 'display': 'block', 'position': 'relative', 'z-index': '1000', 'width': '958px', 'height': '608px' } );
        		joepardy.move( '#answer_' + id );
        		$( '#answer_' + id + ' .close ' ).live( 'click', function () {
        			$( '#answer_' + id ).fadeOut();
        			$( '#category_' + id ).fadeIn();
        			return false;
        		} );
        	} );
        },
        
        move : function ( element ) {
        	var class_list = $( element ).attr( 'class' ).split(/\s+/);
        	var main_width = 192;
        	var main_height = 122;
        	$.each( class_list, function( index, item ) {
        		if ( 2 == item.length ) {
        			var position = item.substring( 1 );
        			if ( 1 != position ) {
        				position = position - 1;
        				if ( 'x' == item.substring( 0, 1 ) ) {
        					var move_left = position * main_width;
        					$( element ).css( 'margin-left', '-' + move_left + 'px' );
        				}
        				else if ( 'y' == item.substring( 0, 1 ) ) {
        					var move_top = position * main_height;
        					$( element ).css( 'margin-top', '-' + move_top + 'px' );
        				}
        			}
        		}
        	} );
        },
        
        get_question : function ( id ) {
        	$( '#answer_' + id ).css( 'z-index', '0' ).fadeOut( function () {
        		$( '#question_' + id ).fadeIn().css( 'display', 'block' );
        		Cookies.create( 'question_' + id, 'display', 360 );
        	} );
        },
        
        refresh_game : function () {
        	var pads = joepardy.get_all_joepardy_term_ids();
			$.each( pads, function( key, value ) { 
				Cookies.erase( 'question_' + key );
			} );
			location.reload( true );
        }
    };
    $( document ).ready( function( $ ) { joepardy.init(); } );
} )( jQuery );

/**
 * Cookie Object
 */
var Cookies = {
    init: function () {
        var allCookies = document.cookie.split( '; ' );
        for (var i=0;i<allCookies.length;i++) {
            var cookiePair = allCookies[i].split( '=' );
            this[cookiePair[0]] = cookiePair[1];
        }
    },
    create: function ( name, value, days ) {
        if ( days ) {
            var date = new Date();
            date.setTime( date.getTime() + ( days*24*60*60*1000 ) );
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"=" + value + expires + "; path=/";
        this[name] = value;
    },
    erase: function ( name ) {
        this.create( name,'',-1 );
        this[name] = undefined;
    }
};
Cookies.init();