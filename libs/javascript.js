function getXMLHttpRequest() {
	try {
		req = new XMLHttpRequest();
	} catch(err1) {
		try {
			req = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (err2) {
			try {
				req = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (err3) {
				req = false;
			}
		}
	}
	return req;
}

jQuery.fn.center = function () {
    this.css("position","absolute");
    var top = ($(window).height() - this.height()) / 2 + $(window).scrollTop();
    this.css("top", (top > 0 ? top : 0) + "px");
    var left = ( $(window).width() - this.width() ) / 2 + $(window).scrollLeft();
    this.css("left",  (left > 0 ? left : 0) + "px");
    return this;
}

jQuery.fn.expand = function () {
    this.css("position","absolute");
    this.css("top", "0px");
    this.css("left", "0px");
    this.css("height", $(window).height() + "px");
    this.css("width", $(window).width() + "px");
    return this;
}
