function showTodoList() 
{ 
	var doc = top.document; 
	var domain = 'todoist.com'; 
	var width = 800; 
	var height = 420; //Helpers 
	
	function getWindowSize(doc) { 
		doc = doc || top.document; 
		var win_w, win_h; 
		if (self.innerHeight) { 
			win_w = self.innerWidth; 
			win_h = self.innerHeight; 
		} 
		else if (doc.documentElement && doc.documentElement.clientHeight) 
		{ 
			win_w = doc.documentElement.clientWidth; 
			win_h = doc.documentElement.clientHeight; 
		} else if (doc.body) { 
			win_w = doc.body.clientWidth; 
			win_h = doc.body.clientHeight; 
		} 
		return {
			'w': win_w, 'h': win_h
		}; 
	} 
		
	function getScrollTop() { 
		var t; 
		if (doc.documentElement && doc.documentElement.scrollTop) 
			t = doc.documentElement.scrollTop; 
		else if (doc.body) 
			t = doc.body.scrollTop; 
			return t; 
	} 
	
	function listen(evnt, elem, func) { 
		if (elem.addEventListener) 
		{ 
			elem.addEventListener(evnt, func, false); 
		} 
		else if (elem.attachEvent) 
		{ 
			// IE DOM 
			var r = elem.attachEvent("on"+evnt, func); 
			return r; 
		} 
	} 
	//Place the element in the right 
	
	function placeWindow() 
	{ 
		var win_size = getWindowSize(); 
		iframe.height = height - top_frame.offsetHeight; 
		//iframe.height = 600; 
		//holder.style.top = (getScrollTop() + win_size.h - holder.offsetHeight - 2) + 'px'; 
		//holder.style.left = (win_size.w - holder.offsetWidth - 30) + 'px'; 
	} 
	//Builders 
	var cur_elm = doc.getElementById('todoist_holder'); 
	if(cur_elm && cur_elm.style.display != 'none') 
	{ 
		cur_elm.style.display = 'none'; 
		return ; 
	} 
	else if(cur_elm) 
	{ 
		cur_elm.style.display = 'block'; 
		return ; 
	} 
	
	//Create holder 
	var holder = doc.createElement('div'); 
	holder.id = 'todoist_holder'; 
	//holder.style.position = "absolute"; 
	holder.style.position = "relative"; 
	holder.style.width = (width-2) + "px"; 
	//holder.style.height = height + "px";
	holder.style.height = "auto";
	holder.style.backgroundColor = '#fff'; 
	//holder.style.border = "1px solid #555"; 
	holder.style.fontFamily = "sans-serif"; 
	holder.style.fontSize = "12px"; 
	holder.style.top = "0px"; 
	holder.style.zIndex = 134343443; 
	var iframe = doc.createElement('iframe'); 
	iframe.blah = 'hello world'; 
	//Create the top 
	var top_frame = doc.createElement('div'); 
	//top_frame.style.color = "#fff"; 
	//top_frame.style.padding = "2px"; 
	top_frame.style.border = "1px solid #999"; 
	top_frame.style.backgroundColor = "#555"; 
	top_frame.style.cursor = "pointer"; 
	top_frame.style.textAlign = "center"; 
	holder.style.fontSize = "14px"; 
	top_frame.appendChild(doc.createTextNode('Todoist tasks'));
	listen('click', top_frame, function() { 
		if(holder.collapsed) 
		{ 
			//holder.style.height = height + "px"; 
			iframe.style.display = 'block'; 
			holder.collapsed = false; 
			holder.style.width = width + 'px'; 
			placeWindow(); 
		} 
		else 
		{ 
			//holder.style.height = top_frame.offsetHeight + "px"; 
			iframe.style.display = 'none'; 
			holder.collapsed = true; 
			holder.style.width = (width-150) + 'px'; 
			placeWindow(); 
		} 
	}); 

	//holder.appendChild(top_frame); 
	//Crate the iframe 
	iframe.src = 'http://'+domain+'/?mini=1'; 
	iframe.id = 'todoist_iframe'; 
	iframe.frameBorder = 0; 
	iframe.width = width-0; 
	iframe.height = "500px";
	iframe.border = 0; 
	iframe.style.margin = '0px'; 
	iframe.style.padding = '0px'; 
	holder.appendChild(iframe); 
	var body = doc.getElementsByTagName('body')[0]; 
	holder.style.visibility = 'hidden'; 
	document.getElementById('home').appendChild(holder);
	document.getElementById('home').appendChild(document.createElement('br'));
	document.getElementById('home').appendChild(document.createElement('br'));
	
	//body.appendChild(holder); 
	//listen('scroll', window, placeWindow); 
	//listen('resize', window, placeWindow); 
	//placeWindow(); 
	holder.style.visibility = 'visible'; 
	var CUR_HREF = null; 
	iframe.onload = function() { 
		function locationPasser() { 
			if(CUR_HREF != top.location.toString()) 
			{
				CUR_HREF = top.location.toString(); 
				setTimeout(function() { 
					var data_to_send = CUR_HREF + '--/--' + top.document.title; 
					iframe.contentWindow.postMessage(data_to_send, '*');
				}, 200);
			} 
		} 
		setInterval(locationPasser, 200); 
	} 
}
