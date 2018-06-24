$(function(){
    var platform = (function(){
		var ua = window.navigator.userAgent;
		// console.log(ua);
		if( ua.indexOf( 'Mac OS X' ) >= 0 ){
			return 'mac';
		}else if( ua.indexOf( 'Windows' ) >= 0 ){
			return 'win';
		}
		return 'unknown';
    })();
    // alert(platform);

    $('.platform--mac').hide();
    $('.platform--win').hide();
    $('.platform--linux').hide();
    $('.platform--unknown').hide();
    switch(platform){
        case "mac":
            $('.platform--mac').show();
            break;
        case "win":
            $('.platform--win').show();
            break;
        case "linux":
            $('.platform--linux').show();
            break;
        default:
            $('.platform--unknown').show();
            break;
    }
});