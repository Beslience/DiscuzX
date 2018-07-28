var j =  jQuery.noConflict();
(function(j) {
	j.fn.fullScreen = function(settings) {//首页焦点区满屏背景广告切换
		var defaults = {
			time: 5000,
			css: 'full-screen-slides-pagination'
		};
		var settings = j.extend(defaults, settings);
		return this.each(function(){
			var jthis = j(this);
		    var size = jthis.find("li").size();
		    var now = 0;
		    var enter = 0;
		    var speed = settings.time;
		    jthis.find("li:gt(0)").hide();
			var btn = '<ul class="' + settings.css + '">';
			for (var i = 0; i < size; i++) {
				btn += '<li>' + '<a href="javascript:void(0)">' + (i + 1) + '</a>' + '</li>';
			}
			btn += "</ul>";
			jthis.after(btn);
			var jpagination = jthis.next();
			jpagination.find("li").first().addClass('current');
			jpagination.find("li").click(function() {
        		var change = j(this).index();
        		j(this).addClass('current').siblings('li').removeClass('current');
        		jthis.find("li").eq(change).css('z-index', '800').show();
        		jthis.find("li").eq(now).css('z-index', '900').fadeOut(400,
        		function() {
        			jthis.find("li").eq(change).fadeIn(500);
        		});
        		now = change;
			}).mouseenter(function() {
        		enter = 1;
        	}).mouseleave(function() {
        		enter = 0;
        	});
        	function slide() {
        		var change = now + 1;
        		if (enter == 0){
        			if (change == size) {
        				change = 0;
        			}
        			jpagination.find("li").eq(change).trigger("click");
        		}
        		setTimeout(slide, speed);
        	}
        	setTimeout(slide, speed);
		});
	}
	j.fn.jfocus = function(settings) {//首页焦点广告图切换
		var defaults = {
			time: 5000
		};
		var settings = j.extend(defaults, settings);
		return this.each(function(){
			var jthis = j(this);
			var sWidth = jthis.width();
			var len = jthis.find("ul li").length;
			var index = 0;
			var picTimer;
			var btn = "<div class='pagination'>";
			for (var i = 0; i < len; i++) {
				btn += "<span></span>";
			}
			btn += "</div><div class='arrow pre'></div><div class='arrow next'></div>";
			jthis.append(btn);
			jthis.find(".pagination span").css("opacity", 0.4).mouseenter(function() {
				index = jthis.find(".pagination span").index(this);
				showPics(index);
			}).eq(0).trigger("mouseenter");
			jthis.find(".arrow").css("opacity", 0.0).hover(function() {
				j(this).stop(true, false).animate({
					"opacity": "0.5"
				},
				300);
			},
			function() {
				j(this).stop(true, false).animate({
					"opacity": "0"
				},
				300);
			});
			jthis.find(".pre").click(function() {
				index -= 1;
				if (index == -1) {
					index = len - 1;
				}
				showPics(index);
			});
			jthis.find(".next").click(function() {
				index += 1;
				if (index == len) {
					index = 0;
				}
				showPics(index);
			});
			jthis.find("ul").css("width", sWidth * (len));
			jthis.hover(function() {
				clearInterval(picTimer);
			},
			function() {
				picTimer = setInterval(function() {
					showPics(index);
					index++;
					if (index == len) {
						index = 0;
					}
				},
				settings.time);
			}).trigger("mouseleave");
			function showPics(index) {
				var nowLeft = -index * sWidth;
				jthis.find("ul").stop(true, false).animate({
					"left": nowLeft
				},
				300);
				jthis.find(".pagination span").stop(true, false).animate({
					"opacity": "0.4"
				},
				300).eq(index).stop(true, false).animate({
					"opacity": "1"
				},
				300);
			}
		});
	}
	j.fn.jfade = function(settings) {//首页标准模块中间多图广告鼠标触及凸显
		var defaults = {
			start_opacity: "1",
			high_opacity: "1",
			low_opacity: ".1",
			timing: "500"
		};
		var settings = j.extend(defaults, settings);
		settings.element = j(this);
		//set opacity to start
		j(settings.element).css("opacity", settings.start_opacity);
		//mouse over
		j(settings.element).hover(
		//mouse in
		function() {
			j(this).stop().animate({
				opacity: settings.high_opacity
			},
			settings.timing); //100% opacity for hovered object
			j(this).siblings().stop().animate({
				opacity: settings.low_opacity
			},
			settings.timing); //dimmed opacity for other objects
		},
		//mouse out
		function() {
			j(this).stop().animate({
				opacity: settings.start_opacity
			},
			settings.timing); //return hovered object to start opacity
			j(this).siblings().stop().animate({
				opacity: settings.start_opacity
			},
			settings.timing); // return other objects to start opacity
		});
		return this;
	}
})(jQuery);
	function takeCount() {
	    setTimeout("takeCount()", 1000);
	    j(".time-remain").each(function(){
	        var obj = j(this);
	        var tms = obj.attr("count_down");
	        if (tms>0) {
	            tms = parseInt(tms)-1;
                var days = Math.floor(tms / (1 * 60 * 60 * 24));
                var hours = Math.floor(tms / (1 * 60 * 60)) % 24;
                var minutes = Math.floor(tms / (1 * 60)) % 60;
                var seconds = Math.floor(tms / 1) % 60;

                if (days < 0) days = 0;
                if (hours < 0) hours = 0;
                if (minutes < 0) minutes = 0;
                if (seconds < 0) seconds = 0;
                obj.find("[time_id='d']").html(days);
                obj.find("[time_id='h']").html(hours);
                obj.find("[time_id='m']").html(minutes);
                obj.find("[time_id='s']").html(seconds);
                obj.attr("count_down",tms);
	        }
	    });
	}
	function update_screen_focus(){
	    var ap_ids = '';//广告位编号
	    j(".full-screen-slides li[ap_id]").each(function(){
	        var ap_id = j(this).attr("ap_id");
	        ap_ids += '&ap_ids[]='+ap_id;
	    });
	    j(".jfocus-trigeminy a[ap_id]").each(function(){
	        var ap_id = j(this).attr("ap_id");
	        ap_ids += '&ap_ids[]='+ap_id;
	    });
	    if (ap_ids != '') {
    		j.ajax({
    			type: "GET",
    			url: SHOP_SITE_URL+'/index.php?act=adv&op=get_adv_list'+ap_ids,
    			dataType:"jsonp",
    			async: true,
    		    success: function(adv_list){
            	    j(".full-screen-slides li[ap_id]").each(function(){
            	        var obj = j(this);
            	        var ap_id = obj.attr("ap_id");
            	        var color = obj.attr("color");
            	        if (typeof adv_list[ap_id] !== "undefined") {
            	            var adv = adv_list[ap_id];
            	            obj.css("background",color+' url('+adv['adv_img']+') no-repeat center top');
            	            obj.find("a").attr("title",adv['adv_title']);
            	            obj.find("a").attr("href",adv['adv_url']);
    					}
            	    });
            	    j(".jfocus-trigeminy a[ap_id]").each(function(){
            	        var obj = j(this);
            	        var ap_id = obj.attr("ap_id");
            	        if (typeof adv_list[ap_id] !== "undefined") {
            	            var adv = adv_list[ap_id];
            	            obj.attr("title",adv['adv_title']);
            	            obj.attr("href",adv['adv_url']);
            	            obj.find("img").attr("alt",adv['adv_title']);
            	            obj.find("img").attr("src",adv['adv_img']);
    					}
            	    });
    		    }
    		});
	    }
	}
j(function(){
	setTimeout("takeCount()", 1000);
    //首页Tab标签卡滑门切换
    j(".tabs-nav > li > h3").bind('mouseover', (function(e) {
    	if (e.target == this) {
    		var tabs = j(this).parent().parent().children("li");
    		var panels = j(this).parent().parent().parent().children(".tabs-panel");
    		var index = j.inArray(this, j(this).parent().parent().find("h3"));
    		if (panels.eq(index)[0]) {
    			tabs.removeClass("tabs-selected").eq(index).addClass("tabs-selected");
    			panels.addClass("tabs-hide").eq(index).removeClass("tabs-hide");
    		}
    	}
    }));

	j('.jfocus-trigeminy > ul > li > a').jfade({
		start_opacity: "1",
		high_opacity: "1",
		low_opacity: ".5",
		timing: "200"
	});
	j('.fade-img > a').jfade({
		start_opacity: "1",
		high_opacity: "1",
		low_opacity: ".5",
		timing: "500"
	});
	j('.middle-goods-list > ul > li').jfade({
		start_opacity: "0.9",
		high_opacity: "1",
		low_opacity: ".25",
		timing: "500"
	});
	j('.recommend-brand > ul > li').jfade({
		start_opacity: "1",
		high_opacity: "1",
		low_opacity: ".5",
		timing: "500"
	});

    j(".full-screen-slides").fullScreen();
    j(".jfocus-trigeminy").jfocus();
	j(".right-side-focus").jfocus();
	j(".groupbuy").jfocus({time:8000});
	j("#saleDiscount").jfocus({time:8000});
//	j("a[href='']").removeAttr("target").attr("href","javascript:void(0)");
	
	//右侧滚动条
	j(document).scroll(function(){
            var scrTop = (document.body.scrollTop || document.documentElement.scrollTop);
            if (scrTop > 200)
            {
                j(".fix_right .back").show();
            } else
            {
                j(".fix_right .back").hide();
            }
    });
    j(".fix_right .back").click(function(){
    	j("html, body").animate({
   			 scrollTop: 0
  			}, 120);
    });
});

//top划过效果
j(function(){
	j(".login_wrap ul li").hover(function(){
		j(this).css("background","#fff");
		j(this).children(".user_index").show();
	},function(){
		j(this).css("background","none");
		j(this).children(".user_index").hide();
	})
});

//工具首页banner
j(function(){
	var numpic = j('#slides li').size()-1;
	var nownow = 0;
	var inout = 0;
	var TT = 0;
	var SPEED = 7000;


	j('#slides li').eq(0).siblings('li').css({'display':'none'});


	var ulstart = '<ul id="pagination">',
		ulcontent = '',
		ulend = '</ul>';
	ADDLI();
	var pagination = j('#pagination li');
	var paginationwidth = j('#pagination').width();
	j('#pagination').css('margin-left',(470-paginationwidth))
	
	pagination.eq(0).addClass('current')
		
	function ADDLI(){
		//var lilicount = numpic + 1;
		for(var i = 0; i <= numpic; i++){
			ulcontent += '<li>' + '<a href="#">' + (i+1) + '</a>' + '</li>';
		}
		
		j('#slides').after(ulstart + ulcontent + ulend);	
	}

	pagination.on('click',DOTCHANGE)
	
	function DOTCHANGE(){
		
		var changenow = j(this).index();
		
		j('#slides li').eq(nownow).css('z-index','900');
		j('#slides li').eq(changenow).css({'z-index':'800'}).show();
		pagination.eq(changenow).addClass('current').siblings('li').removeClass('current');
		j('#slides li').eq(nownow).fadeOut(400,function(){j('#slides li').eq(changenow).fadeIn(500);});
		nownow = changenow;
	}
	
	pagination.mouseenter(function(){
		inout = 1;
	})
	
	pagination.mouseleave(function(){
		inout = 0;
	})
	
	function GOGO(){
		
		var NN = nownow+1;
		
		if( inout == 1 ){
			} else {
			if(nownow < numpic){
			j('#slides li').eq(nownow).css('z-index','900');
			j('#slides li').eq(NN).css({'z-index':'800'}).show();
			pagination.eq(NN).addClass('current').siblings('li').removeClass('current');
			j('#slides li').eq(nownow).fadeOut(400,function(){j('#slides li').eq(NN).fadeIn(500);});
			nownow += 1;

		}else{
			NN = 0;
			j('#slides li').eq(nownow).css('z-index','900');
			j('#slides li').eq(NN).stop(true,true).css({'z-index':'800'}).show();
			j('#slides li').eq(nownow).fadeOut(400,function(){j('#slides li').eq(0).fadeIn(500);});
			pagination.eq(NN).addClass('current').siblings('li').removeClass('current');

			nownow=0;

			}
		}
		TT = setTimeout(GOGO, SPEED);
	}
	
	TT = setTimeout(GOGO, SPEED); 

});

//导航转换
		j(function(){
			j(".nav-main-right a").mouseover(function(){
					j(this).addClass("special").siblings().removeClass("special");
				})
		});
		










