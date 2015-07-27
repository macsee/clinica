
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Autocomplete - Default functionality</title>
	<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
	<link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<style>
	.ui-widget {
		font-size: 30pt;
	}
	.ui-dialog {
		position: relative;
		margin: auto;
	}
	</style>
	<script>
	    $(function() {
	        $( "#dialog-confirm" ).dialog({
				autoOpen: false,
	            resizable: false,
				width: 800,
	            height:240,
	            modal: true,
	            buttons: {
	                "Delete all items": function() {
	                    $( this ).dialog( "close" );
	                },
					"No": function() {
	                    $( this ).dialog( "close" );
					},
	                Cancel: function() {
	                    $( this ).dialog( "close" );
	                }
	            }
	        });
	
			$( ".dialog-link" ).click(function( event ) {
						$( "#dialog-confirm" ).dialog( "open" );
						event.preventDefault();
			});
	    });
	    </script>
	</head>
	<body>
		<div class="dialog-link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>Open Dialog</div>
		<div class="dialog-link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>Open Dialog</div>
	<div id="dialog-confirm" title="Empty the recycle bin?">
		
	</div>
	</body>
	</html>