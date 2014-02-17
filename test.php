<?
	include 'includes.php';
createuser("mjessop", "password", 3);
exit;


	echo "\n";
?>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript">
    var jq=jQuery.noConflict();
    jq(document).ready( function(){
        jq(document).keydown(function(event){
            // -- here comes your code of function --
		console.log("stuff");
            jq("#keycode").html(event.which); // example code, event.which captures key index
        });
    });
</script>
</head>
<body>
<input type="text" onkeypress="console.log('more stuff');"></input>
    <div id="keycode">Press any Key to see its index</div>
</body>
