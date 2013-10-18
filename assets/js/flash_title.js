(function () {



window.flashTitle = function (newMsg, howManyTimes) {
	//alert(timeout);

    	function step() {
	        document.title = (document.title == original) ? newMsg : original;

	        if (--howManyTimes > 0) {
	            timeout = setTimeout(step, 1000);
	        };
	    };

	    howManyTimes = parseInt(howManyTimes);

	    if (isNaN(howManyTimes)) {
	        howManyTimes = 5;
	    };

	    clearTimeout(timeout);

	    step();
	
};

window.cancelFlashTitle = function () {
    clearTimeout(timeout);
    document.title = original;
};



}());