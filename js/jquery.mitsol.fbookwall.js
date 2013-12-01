/*------------------------------------------------------------------------
# mitsol facebook wall feed
# ------------------------------------------------------------------------
# author  Mitsol
# copyright Copyright (c) 2013 Mitsol - Development Team
# @license - GPLv2 or later http://www.gnu.org/licenses/old-licenses/gpl-2.0.html 
# Websites http://extensions.programminghelp24.com 
-------------------------------------------------------------------------*/

(function($) { //allows to use $ inside of a block of code without permanently overwriting $ //http://docs.jquery.com/Using_jQuery_with_Other_Libraries			 
		  
	$.fn.Ms_fwall = function(options) {
		
		var opts = $.extend({}, $.fn.Ms_fwall.defaults, options);
		var meta = this;		
		return meta.each(function() {
			$this = $(this);
			var o = $.meta ? $.extend({}, opts, $this.data()) : opts;
			var output = '';
			var avatarBaseURL;
			var baseData;
			var likeSummary;
			var mainData;
			var graphURL = "https://graph.facebook.com/";			
			/******************************************************************************************************
			 * Load base data
			 ******************************************************************************************************/			 
			meta.addClass('msfb-wall').addClass('loading').html('');
			$.ajax({
				url: graphURL+o.id+'?access_token='+o.accessToken,
				dataType: "jsonp",
				success: function(data, textStatus, XMLHttpRequest){
					initBase(data);
				}
			});			
			/******************************************************************************************************
			 * Load feed data
			 ******************************************************************************************************/
			 
			var initBase = function(data){
				baseData = data;
				var mainId=data.id
				
				if(data==false){
					meta.removeClass('loading').html('The alias you requested do not exist: '+o.id);
					return false;
				};
				
				if(data.error){
					meta.removeClass('loading').html(data.error.message);
					return false;
				};
				var type = (o.showGuestEntries=='true'||o.showGuestEntries==true) ? 'feed' : 'posts'; //if showGuest false = posts
				$.ajax({
					//async: false,
				    cache:false,
					url: graphURL+o.id+"/"+type+"?limit="+o.max+'&access_token='+o.accessToken,
					dataType: "jsonp",
					success:function (data, textStatus, XMLHttpRequest) {
						meta.removeClass('loading');//bef4
                        initWall(data);
                        //mainData=data;
					},
					complete:function () 
					{						
				    }
					
				});
			}
			/******************************************************************************************************
			 * Parse feed data / wall
			 ******************************************************************************************************/
			 
			var initWall = function(data){				
				data = data.data;				
				var max = data.length;
				var thisAvatar, isBase, hasBaseLink, thisDesc;
				
				for(var k=0;k<max;k++){
				  if(data[k].type=="status")//||(data[k].type="link")) //free version
				  {
					// Shortcut ------------------------------------------------------------------------------------------------------------------------------
					isBase = (data[k].from.id==baseData.id);
					hasBaseLink = isBase&&(exists(baseData.link));
					if(!o.showGuestEntries&&!isBase) continue;
					
					// Box -----------------------------------------------------------------------------------------------------------------------------------
					output += (k==0) ? '<div class="msfb-layout msfb-wall-box msfb-wall-box-first">' : '<div class="msfb-layout msfb-wall-box">';			
					if(o.showavatar==1){						
					output += '<div class="avatar"><a href="https://www.facebook.com/profile.php?id='+data[k].from.id+'" target="_blank">';
					output += '<img class="msfb-wall-avatar" src="'+getAvatarURL(data[k].from.id)+'" />';
					output += '</a></div>';	
					}
					output += '<div class="msfb-wall-data">';					
					output += '<span class="msfb-wall-message">';
					output += '<a href="https://www.facebook.com/profile.php?id='+data[k].from.id+'" class="msfb-wall-message-from" target="_blank">'+data[k].from.name+'</a> ';
					 
					  if(exists(data[k].message)) output += '<span style="display:block;margin-top:4px;">'+modText(data[k].message)+'</span>'; 										
					  if(exists(data[k].story)) output += '<span style="display:block;margin-top:4px;">'+modText(data[k].story)+'</span>';										
					
					output += '</span>';
														
					if(o.showdate==1) {
						output += '<span class="msfb-wall-date">';
						if(exists(data[k].icon)) output += '<img class="msfb-wall-icon" src="'+data[k].icon+'" title="'+data[k].type+'" alt="" />';
						output += formatDate(data[k].created_time);
						if(o.show_like==1)
						{  
						   var mspost_id= data[k].id.split("_");   						   
						   output += '<a style="margin-left:5px;cursor:pointer;cursor:hand; font-weight:normal;" id="msfb-likepost_'+k+'" href="https://www.facebook.com/'+mspost_id[0]+'/posts/'+mspost_id[1]+'" target="_blank" >Like</a>';
						}
						
						output +='</span>'; 
					}
					else{ 
						output += '<span class="msfb-wall-date">';					
						if(o.show_like==1)
						{ 
							var mspost_id= data[k].id.split("_");  							  
							output += '<a style="margin-left:5px;cursor:pointer;cursor:hand;font-weight:normal;" id="msfb-likepost_'+k+'" href="https://www.facebook.com/'+mspost_id[0]+'/posts/'+mspost_id[1]+'" target="_blank" >Like</a>';	
						}
						
						output +='</span>'; 
					}			
					// Likes ----------------------------------------------------------------------------------------------------------------------------------										
					// Comments -------------------------------------------------------------------------------------------------------------------------------					
					output += '</div>';
					output += '<div class="msfb-wall-clean"></div>';
					output += '</div>';
				} 
			  }
				
				// No data found --------------------------------------------------------------------------------------------
				if(max==0){				
					
					output += '<div class="msfb-wall-box-first">';
					output += '<img class="msfb-wall-avatar" src="'+getAvatarURL(baseData.id)+'" />';
					output += '<div class="msfb-wall-data">';
					output += '<span class="msfb-wall-message"><span class="msfb-wall-message-from">'+baseData.name+'</span> '+o.translateErrorNoData+'</span>';					
					output += '</div>';
					output += '</div>';
				}
				meta.hide().html(output).fadeIn(700);							   														
							
			}			
			/******************************************************************************************************
			 * Get Avatars
			 ******************************************************************************************************/
			
			function getAvatarURL(id){
				var avatarURL;
				if(id==baseData.id){ avatarURL = (o.useAvatarAlternative) ? o.avatarAlternative : graphURL+id+'/picture?type=square'; }
				else{ avatarURL = (o.useAvatarExternal) ? o.avatarExternal : graphURL+id+'/picture?type=square'; }
				return avatarURL;
			}
			 
			function formatDate(dateStr){
				var year, month, day, hour, minute, dateUTC, date, ampm, d, time;
				var iso = (dateStr.indexOf(' ')==-1&&dateStr.substr(4,1)=='-'&&dateStr.substr(7,1)=='-'&&dateStr.substr(10,1)=='T') ? true : false;

				if(iso){
					year = dateStr.substr(0,4);
					month = parseInt((dateStr.substr(5,1)=='0') ? dateStr.substr(6,1) : dateStr.substr(5,2))-1;
					day = dateStr.substr(8,2);
					hour = dateStr.substr(11,2);
					minute = dateStr.substr(14,2);
					dateUTC = Date.UTC(year, month, day, hour, minute);
					date = new Date(dateUTC);
				}else{
					d = dateStr.split(' ');
					if(d.length!=6||d[4]!='at')
						return dateStr;
					time = d[5].split(':');
					ampm = time[1].substr(2);
					minute = time[1].substr(0,2);
					hour = parseInt(time[0]);
					if(ampm=='pm')hour+=12;
					date = new Date(d[1]+' '+d[2]+' '+d[3] +' '+ hour+':'+minute);
					date.setTime(date.getTime()-(1000*60*60*7));
				}
				day = (date.getDate()<10)?'0'+date.getDate():date.getDate();
				month = date.getMonth()+1;
				month = (month<10)?'0'+month:month;
				hour = date.getHours();
				minute = (date.getMinutes()<10)?'0'+date.getMinutes():date.getMinutes();
				if(o.timeConversion==24){
					ampm = (hour<12) ? 'am' : 'pm';
					if(hour==0)hour==12;
					else if(hour>12)hour=hour-12;
					if(hour<10)hour='0'+hour;					
					if(o.date_format=='us'){										
					return month+'.'+day+'.'+date.getFullYear()+' '+o.translateAt+' '+hour+':'+minute+' '+ampm;;							
					}
					return day+'.'+month+'.'+date.getFullYear()+' '+o.translateAt+' '+hour+':'+minute+' '+ampm;
				}	
				if(o.date_format=='us'){
				return month+'.'+day+'.'+date.getFullYear()+' '+o.translateAt+' '+hour+':'+minute+' '+ampm;;						
				}
				return day+'.'+month+'.'+date.getFullYear()+' '+o.translateAt+' '+hour+':'+minute+' '+ampm;;
			}
			
			/******************************************************************************************************
			 * Helper Function
			 ******************************************************************************************************/
			 
			function exists(data){
				if(!data || data==null || data=='undefined' || typeof(data)=='undefined') return false;
				else return true;
			}
			
			function modText(text){
				return nl2br(autoLink(escapeTags(text)));
			}
			
			function escapeTags(str){
				return str.replace(/</g,'&lt;').replace(/>/g,'&gt;');
			}
			
			function nl2br(str){
				return str.replace(/(\r\n)|(\n\r)|\r|\n/g,"<br>");
			}
			
			function autoLink(str){
				return str.replace(/((http|https|ftp):\/\/[\w?=&.\/-;#~%-]+(?![\w\s?&.\/;#~%"=-]*>))/g, '<a href="$1" target="_blank">$1</a>');
			}

		});
	};
	 
	$.fn.Ms_fwall.defaults = {
		avatarAlternative:		'avatar-alternative.jpg',
		avatarExternal:			'avatar-external.jpg',
		id: 					'mitsol12',
		max:					5,
		showGuestEntries:		true,
		translateAt:			'at',		
		translateErrorNoData:	'has not shared any information.',
		timeConversion:			24,
		useAvatarAlternative:	false,
		useAvatarExternal:		false,		
		showdate:				'',
		accessToken:			'',
		showavatar:				'1',				
		date_format:			'',
		show_like:              '1',
	};									

})(jQuery);
