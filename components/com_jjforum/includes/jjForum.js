// JavaScript Document

jQuery(document).ready( function($){
	$('.JJimageLink').live('click',function(event){
		event.preventDefault();
		$.fancybox({href:this.href});
	});
	
	$('.jjForum_login').live('click',function(event){
		event.preventDefault();
		$.fancybox({href:jjForum_base + 'components/com_jjforum/includes/login.php'});
	});
	
//	$('#jjForum_register').fancybox({
//		href: jjForum_base + 'index.php?option=com_users&view=registration&tmpl=component',
//		type:'iframe'
//	});

	$('.reply_wrapper ul li:last-child').addClass('JJlast-child');


	$('#JJimage').uploadify({
		'swf'    : jjForum_base + 'components/com_jjforum/includes/uploadify/uploadify.swf',
		'uploader'    : jjForum_base + 'components/com_jjforum/includes/uploadify/uploadify.php',
		'cancelImg' : jjForum_base + 'components/com_jjforum/includes/uploadify/cancel.png',
        'onUploadError' : function(file, errorCode, errorMsg, errorString) {
            $('#JJimageQueue').html(errorMsg);
        },
		'onUploadSuccess' : function(file, data, response) {
				$('#JJimageUploader').hide();
				$('label[for=JJimage]').hide();
				$('#JJimageQueue').fadeOut();
				$('#JJfile').val(data);
		},
		'fileObjName' : 'image',
		'fileSizeLimit' : '750KB',
		'fileTypeExts'     : '*.gif; *.jpg; *.jpeg; *.png', 	
		'fileTypeDesc'    : 'Image Files',
		'removeCompleted' : false,
		'auto'      : true,
		'uploadLimit' : 1
	});

	$('.jjForum_logout').live('click', function(event){
		event.preventDefault();		
	//	FB.logout();
		var token = $(this).next().attr('name');
		$.ajax({
			url: jjForum_base + "index.php?option=com_jjforum&view=user&task=user.logout&"+ token +"=1",
			success: function(data){
				location.reload();
			}
		});
	});

	//tags
	$('.JJtags').tokenInput(jjForum_base + 'components/com_jjforum/includes/tags/getTags.php', {
		hintText: "<span class='JJblue'>Type in Tags delimited by colon...</span>",
		preventDuplicates: true,
		tokenValue:'name',
		searchingText: "<span class='JJblue'>Searching from existing Tags...</span>"
	});

	$('#JJnew_post').click(function(event){
		event.preventDefault();
		var params = $(this).attr('id');
		var rel = $(this).attr('rel');
		$("#JJpost").htmlarea();
		$('#JJparams').val(params);
		$('#JJrel').val(rel);
		//show reply form
		$('body').append('<div id="JJOverlay"></div>');
		$('#JJpostFormWrapper').fadeIn().animate({top:30})
		return false;
	})
	
	$('.JJnew_reply,.JJreply,.JJreply2').live('click', function(event){
		event.preventDefault();
		var params = $(this).attr('id');
		var rel = $(this).attr('rel');
		$("#JJreplytxt").htmlarea();
		$('#JJparams').val(params);
		$('#JJrel').val(rel);
		//show reply form
		$('body').append('<div id="JJOverlay"></div>');
		$('#JJreplyFormWrapper').fadeIn().animate({top:30})
		return false;
	})

	$('.JJcancelForm').click(function(event){
		event.preventDefault();
		$('#JJOverlay').remove();
		$('#JJreplyFormWrapper').fadeOut();
		$('#JJpostFormWrapper').fadeOut();
	})

	$('.JJtitle').live('click',function(event){
		event.preventDefault();
		var params = $(this).attr('id');
		$(this).parent().next('.JJpostTxt').toggle(300);
		//IE 7-8 bug fix - cant use hasClass
		var opened = $(this).attr('rel');
		var loaded = $(this).attr('rev');
		if(opened != 'open'){
			$('html,body').animate({scrollTop: $(this).offset().top});
			$(this).siblings('.JJIntro,.JJcreatedDate').fadeOut(); 
			$.cookie('jjtitle', params);
			$(this).attr('rel','open');
		} else {
			$(this).siblings('.JJIntro,.JJcreatedDate').fadeIn();
			$.cookie('jjtitle', null);
			$(this).attr('rel','closed');
		}
		$(this).toggleClass('open');
		if(loaded != 'loaded'){
			$(this).attr('rev','loaded');
			var repliesCon = $(this).parent().next().children('.reply_wrapper');
			repliesCon.addClass('JJloading');
			$.ajax({
				url: jjForum_base + 'components/com_jjforum/includes/replies.php?params=' + params,
				success: function(data){
					repliesCon.html(data);
					repliesCon.removeClass('JJloading');
				}
			});		
		}
	});
	
//	$('.JJvotesPlusOne,.JJvotesMinusOne').dblclick(function(){alert('');return false;});
	$('.JJvotesPlusOne,.JJvotesMinusOne').click(function(event){
		event.preventDefault();
		$links = $(this).parent().children('a');
		$span  = $(this).parent().children('span');
		var id = $(this).parent().attr('id');
		var params = $(this).attr('rel');
		$links.hide(100);
		$.ajax({
			url: jjForum_base + 'components/com_jjforum/includes/votes.php?params=' + params,
			success: function(data){
				$span.html(data);
				$span.after('<small>Thank you <br>for voting</small>').fadeIn(300);
				$span.next().delay(2000).fadeOut(400);
				$.cookie(id, id,{ expires: 5 });
			}
		});		
	});

	$('.JJvotes').each( function(){
		var thisId = $(this).attr('id');
		if(thisId == $.cookie(thisId)){
			$(this).children('a').remove();
			$(this).append('already voted');
		}
	});

	$(".JJsimlink").live('focus',function(){
		this.select();
		$(this).animate({width:'40%'})
	});

	$('#jjForumSubmitPost').click( function(event){
		event.preventDefault();
		var $thisBtn               = $(this);
		var $this               = $('#JJnewPostForm');
		var JJtopic             = $('#JJtopic', $this);
		var JJpost              = $('#JJpost', $this);
		var JJtags              = $('#JJtags', $this);
		var JJfile              = $('#JJfile', $this);
		var JJcurruri           = $('#JJcurruri', $this);
		var JJvideo_provider    = $('#JJvideo_provider', $this);
		var JJvideo_id          = $('#JJvideo_id', $this);
		var JJcatid             = $('#JJcatid', $this);
		var JJnotify            = $('#JJnotify', $this);
		if(!JJtopic.val()){
			alert('Must have topic text');
			JJtopic.addClass('JJError');
			return false;
		} else {
			JJtopic.removeClass('JJError');
			$thisBtn.attr('disabled','disabled');
		//	$('#JJJimage').uploadifyClearQueue();
		}
		
		$.ajax({
			type: "POST",
			data: 'option=com_jjforum&view=posts&task=posts.newpost&jjForum[JJtopic]=' + JJtopic.val() + '&jjForum[JJpost]=' + JJpost.val() + '&jjForum[JJtags]=' + JJtags.val() + '&jjForum[JJvideo_provider]=' + JJvideo_provider.val() + '&jjForum[JJcurruri]=' + JJcurruri.val() + '&jjForum[JJfile]=' + JJfile.val() + '&jjForum[JJvideo_id]=' + JJvideo_id.val() + '&jjForum[JJcatid]=' + JJcatid.val() + '&jjForum[JJnotify]=' + JJnotify.val(),
			url: jjForum_base + 'index.php',
			success: function(data){
				$('html,body').animate({scrollTop: $("#JJnewPostWrapper").offset().top});
				$('#JJnewPostWrapper').before(data);
				JJtopic.val('');
				$('#JJnewPostForm .token-input-list').remove();
				JJtags.tokenInput(jjForum_base + 'components/com_jjforum/includes/tags/getTags.php', {
					hintText: "Type in Tags delimited by colon...",
					preventDuplicates: true,
					tokenValue:'name',
					searchingText: "Searching from existing Tags..."
				});
				JJtags.val('');
				JJfile.val('');
				JJvideo_provider.val('');
				JJvideo_id.val('');
				$("#JJpost").htmlarea("dispose");
				JJpost.val('');
				JJnotify.val('');
			//	$('#JJimage').uploadifyClearQueue();
				$('#JJimageQueue').html('');
				$('label[for=JJimage]').show();
				$('#JJOverlay').remove();
				$('#JJpostFormWrapper').fadeOut();
				$('#JJimageUploader').show();
				$thisBtn.attr('disabled',false);
			}
		});		
		
	});

	$('#jjForumSubmitReply').click( function(event){
		event.preventDefault();
		var $this               = $('#JJnewReplyForm');
		var JJtopic             = $('#JJtopic', $this);
		var JJpost              = $('#JJreplytxt', $this);
		var JJtags              = $('#JJtags', $this);
		var JJparams            = $('#JJparams', $this);
		var JJrel               = $('#JJrel', $this);
		if(!JJtopic.val()){
			alert('Must have topic text');
			JJtopic.addClass('JJError');
		} else {
			JJtopic.removeClass('JJError');
		}
		if(JJrel.val() == 'post2' || JJrel.val() == 'thread2')
		var quote = 1;
		else 
		var quote = 0;
		
		$.ajax({
			type: "POST",
			data: 'option=com_jjforum&view=posts&task=posts.newreply&jjForum[JJtopic]=' + JJtopic.val() + '&jjForum[JJpost]=' + JJpost.val() + '&jjForum[JJtags]=' + JJtags.val() + '&jjForum[JJparams]=' + JJparams.val() + '&jjForum[JJquote]=' + quote,
			url: jjForum_base + 'index.php',
			success: function(data){
				//set the data
				if(JJrel.val() == 'thread' || JJrel.val() == 'thread2'){
					if (!$('.reply-'+JJparams.val()+' ul').length){
						$('.reply-'+JJparams.val()).append('<ul></ul>');
						var newOne = $('.reply-'+JJparams.val()+' > ul').append(data);
					}else {
						var newOne = $('.reply-'+JJparams.val()+' ul li:last').after(data);
					}
				}
				else if(JJrel.val() == 'post' || JJrel.val() == 'post2'){
					if (!$('.replies-'+JJparams.val()+' ul').length){
						$('.replies-'+JJparams.val()).append('<ul></ul>');
						var newOne = $('.replies-'+JJparams.val()+' > ul').append(data);
					}else {
						var newOne = $('.replies-'+JJparams.val()+' > ul > li:last').after(data);
					}
				}
				$('html,body').animate({scrollTop: newOne.offset().top});
				//clear the form data
				JJtopic.val('');
				JJpost.val('');
				$('#JJnewReplyForm .token-input-list').remove();
				JJtags.tokenInput(jjForum_base + 'components/com_jjforum/includes/tags/getTags.php', {
					hintText: "Type in Tags delimited by colon...",
					preventDuplicates: true,
					tokenValue:'name',
					searchingText: "Searching from existing Tags..."
				});
				JJtags.val('');
				$("#JJreplytxt").htmlarea("dispose");
				JJpost.val('');
				$('#JJOverlay').remove();
				$('#JJreplyFormWrapper').fadeOut();
			}
		});		
		
	});

	$('.JJremovePost,.JJremoveThread').live('click', function(event){
		event.preventDefault();
		var postid = $(this).attr('id');
		$this = $(this)
		$.ajax({
			type: "POST",
			data: 'option=com_jjforum&view=posts&task=posts.removepost&postid=' + postid ,
			url: jjForum_base + 'index.php',
			success: function(data){
				$this.parent().next().remove();
				$this.parent().remove();
			}
		});		
		
	});

	
	if($.cookie('jjtitle') != 'null'){
		var JJtogglerItem = $('#'+$.cookie('jjtitle'));
		if(!JJtogglerItem.hasClass('JJsingle'))
		JJtogglerItem.trigger('click');
	}
	$('.JJsingle').trigger('click');

//videos lightbox
	$(".youtube").live('click', function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'width'			: 640,
		//	'height'		: 385,
			'href'			: 'http://www.youtube.com/v/'+$(this).attr("rel")+'',
			'type'			: 'swf',
			'swf'			: {
			'wmode'				: 'transparent',
			'allowfullscreen'	: 'true'
			}
		});
		return false;
	});
	$(".vimeo").live('click', function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'width'			: 640,
		//	'height'		: 225,
			'href'			: 'http://player.vimeo.com/video/'+$(this).attr("rel")+'?title=0&portrait=0',
			'type'			: 'iframe'
		});
		return false;
	});
	$(".google").live('click', function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'width'			: 640,
		//	'height'		: 385,
			'href'			: 'http://video.google.com/googleplayer.swf?docid='+$(this).attr("rel")+'&hl=en&fs=true',
			'type'			: 'swf',
			'swf'			: {
			'wmode'				: 'transparent',
			'allowfullscreen'	: 'true'
			}
		});
		return false;
	});
	$(".123video").live('click', function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'width'			: 640,
		//	'height'		: 385,
			'href'			: 'http://www.123video.nl/123video_emb.swf?mediaSrc='+$(this).attr("rel"),
			'type'			: 'swf',
			'swf'			: {
			'wmode'				: 'transparent',
			'allowfullscreen'	: 'true'
			}
		});
		return false;
	});
	$(".aniboom").live('click', function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'width'			: 640,
		//	'height'		: 385,
			'href'			: 'http://api.aniboom.com/e/'+$(this).attr("rel"),
			'type'			: 'swf',
			'swf'			: {
			'wmode'				: 'transparent',
			'allowfullscreen'	: 'true'
			}
		});
		return false;
	});
	$(".flickr").live('click', function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'width'			: 640,
		//	'height'		: 385,
			'href'			: 'http://www.flickr.com/apps/video/stewart.swf.v71377',
			'type'			: 'swf',
			'swf'			: {
			'wmode'				: 'transparent',
			'allowfullscreen'	: 'true',
			'flashvars'         : 'intl_lang=en-us&div_id=stewart_swf'+$(this).attr("rel")+'_div&flickr_notracking=true&flickr_target=_self&flickr_h=385&flickr_w=640&flickr_no_logo=true&onsite=true&flickr_noAutoPlay=false&in_photo_gne=true&photo_secret=6e33ea4246&photo_id='+$(this).attr("rel")+'&flickr_doSmall=true'
			}
		});
		return false;
	});
	$(".metacafe").live('click', function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'width'			: 640,
		//	'height'		: 385,
			'href'			: 'http://www.metacafe.com/fplayer/'+$(this).attr("rel")+'.swf',
			'type'			: 'swf',
			'swf'			: {
			'wmode'				: 'transparent'			
			}
		});
		return false;
	});
	$(".myspace").live('click', function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'width'			: 640,
		//	'height'		: 385,
			'href'			: 'http://mediaservices.myspace.com/services/media/embed.aspx/m='+$(this).attr("rel")+',t=1,mt=video',
			'type'			: 'swf',
			'swf'			: {
			'wmode'				: 'transparent'			
			}
		});
		return false;
	});
	$(".myvideo").live('click', function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'width'			: 640,
		//	'height'		: 385,
			'href'			: 'http://www.myvideo.de/movie/'+$(this).attr("rel"),
			'type'			: 'swf',
			'swf'			: {
			'wmode'				: 'transparent'			
			}
		});
		return false;
	});
	$(".sohu").live('click', function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'width'			: 640,
		//	'height'		: 385,
			'href'			: 'http://share.vrs.sohu.com/my/v.swf&id='+$(this).attr("rel")+'&skinNum=2&topBar=1',
			'type'			: 'swf',
			'swf'			: {
			'wmode'				: 'transparent'			
			}
		});
		return false;
	});
	$(".yahoo").live('click', function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'width'			: 640,
		//	'height'		: 385,
			'href'			: 'http://d.yimg.com/nl/vyc/site/player.swf',
			'type'			: 'swf',
			'swf'			: {
				'wmode'				: 'transparent'	,		
				'flashvars'			: 'vid='+$(this).attr("rel")+'&amp;autoPlay=false&amp;volume=100&amp;enableFullScreen=1'			
			}
		});
		return false;
	});


});

function logginAjax($this){
	var user = jQuery($this).find( 'input[name="username"]' ).val();
	var pass = jQuery($this).find( 'input[name="password"]' ).val();
	var token = jQuery($this).find( 'input[type="hidden"]' ).attr('name');
	jQuery('.JJlogin').addClass('JJloading');
	jQuery.ajax({
		url: jjForum_base + "index.php?option=com_jjforum&view=user&task=user.login&username=" + user + "&password=" + pass + "&"+ token +"=1",
		success: function(data){
			if(data == 'loggedin'){
				location.reload();
			} else { 
			//	jQuery('.JJlogin').removeClass('JJloading');
				alert('Please try again');
				location.reload();
			}
		}
	});
	return false;
}

(function(a){a.cookie=function(b,c,d){if(arguments.length>1&&(!/Object/.test(Object.prototype.toString.call(c))||c===null||c===undefined)){d=a.extend({},d);if(c===null||c===undefined){d.expires=-1}if(typeof d.expires==="number"){var e=d.expires,f=d.expires=new Date;f.setDate(f.getDate()+e)}c=String(c);return document.cookie=[encodeURIComponent(b),"=",d.raw?c:encodeURIComponent(c),d.expires?"; expires="+d.expires.toUTCString():"",d.path?"; path="+d.path:"",d.domain?"; domain="+d.domain:"",d.secure?"; secure":""].join("")}d=c||{};var g=d.raw?function(a){return a}:decodeURIComponent;var h=document.cookie.split("; ");for(var i=0,j;j=h[i]&&h[i].split("=");i++){if(g(j[0])===b)return g(j[1]||"")}return null}})(jQuery)