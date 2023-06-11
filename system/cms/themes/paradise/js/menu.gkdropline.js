window.addEvent('load', function() {
	var main = document.id('gkDropMain');
	var sub = document.id('gkDropSub');
	
	if(main) {
		var submenus = document.id('gkSubmenu').getElements('#gkDropSub > ul');
		var currentsub = null;
		
		submenus.each(function(el, i) {
			if(el.hasClass('active')) currentsub = submenus[i];
		});
		
		main.getElements('li').each(function(el, i) {
			el.addEvent('mouseenter', function() {
				if(currentsub) {
					currentsub.setStyle('left', '-999em'); 
					submenus.setProperty('class', '');
				}
                
				currentsub = submenus[i];
				currentsub.setStyle('left', 'auto');
				currentsub.setProperty('class', 'active');
			});
		});
	}
});  