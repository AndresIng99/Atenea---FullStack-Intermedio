$(window).on('load', function(){


	// Add youtube thumbail image
	$('#music tbody tr').addClass('list');
	$('.list').each(function() {
		var youtube_video_id	=	$(this).attr('data-url');
		if (youtube_video_id.length == 11) {
			 var video_thumbnail = $('<img src="https://i.ytimg.com/vi/'+ youtube_video_id +'/hqdefault.jpg" class="img-responsive">');
			 $(this).find('.thumb').append(video_thumbnail);
		}		
		var jd	=	$(this).index()+1
		$(this).find('td').eq(0).text(jd)
	});

	// select no of li
	var noOfLi	=	$('.list').length; // Total no of li
	var showNo 	=  $('.show-row select').val()
	$('.show-row select').on('change', function(e){
		showNo 	=	$(this).val();
		myRemoveClass();		
	});


	

	//select function
	function myRemoveClass() {
		//Pagination		
		var showNoOfLi	=	showNo,  //  Show now of li
			showPage	=	Math.ceil(noOfLi/showNo), // pagination list
			counter,
			no 			=	0,
			start		=	no,
			end			=	showNoOfLi;

		$('.pagination').empty()
		for(counter = 1; counter <= showPage; counter++){
		 	$('<li><a href="javascript:void(0)" data-lt="'+counter+'">'+ counter +'</a></li>').appendTo('.pagination');
		 	$('.pagination li').eq(0).addClass('active');
		 }	
		$('#music tbody tr').removeClass('active-item').hide()
		$('#music tbody tr').slice(start, end).show().addClass('active-item');

		$('.prev').prop('disabled', true).parent('li').addClass('disabled');
		$('.next').prop('disabled', false).parent('li').removeClass('disabled');

		// click on pagination
		function myfunction(controller) {
			return function () {
				if (controller == 'nextPagination') {
					no++;
					$('.pagination li').removeClass('active')
					$('.pagination li').eq(no).addClass('active');
					start1 = showNoOfLi*no;					
					end1 = showNoOfLi*(no+1);
					$('#music tbody tr').removeClass('active-item').hide();
					$('#music tbody tr').slice(start1, end1).show().addClass('active-item');
					$('.prev').prop('disabled', false).parent('li').removeClass('disabled');
					if(end1 >= noOfLi){					
						$('.next').prop('disabled', true).parent('li').addClass('disabled');		
					}
				}
				else if(controller == 'prevPagination') {
					no--;
					$('.pagination li').removeClass('active')
					$('.pagination li').eq(no).addClass('active');
					start1 = showNoOfLi*no;					
					end1 = showNoOfLi*(no+1);
					$('#music tbody tr').removeClass('active-item').hide();
					$('#music tbody tr').slice(start1, end1).show().addClass('active-item');
					$('.next').prop('disabled', false).parent('li').removeClass('disabled');
					
					if(no === 0){					
						$('.prev').prop('disabled', true).parent('li').addClass('disabled');		
					}
				}
				else if(controller == 'dots') {
					$('.pagination li').removeClass('active');
					var thisIndex = $(this).addClass('active').index();
					no = thisIndex;
					start1 = showNoOfLi*no;					
					end1 = showNoOfLi*(no+1);
					$('#music tbody tr').removeClass('active-item').hide();
					$('#music tbody tr').slice(start1, end1).show().addClass('active-item');

					if(no > 0){
						$('.prev').prop('disabled', false).parent('li').removeClass('disabled');
					}else{
						$('.prev').prop('disabled', true).parent('li').addClass('disabled');
					}					
					if(end1 >= noOfLi){	
									
						$('.next').prop('disabled', true).parent('li').addClass('disabled');		
					}else{
						$('.next').prop('disabled', false).parent('li').removeClass('disabled');
					}
				}
			}
		}

		$('.wrapper').on('click','.next', myfunction('nextPagination'));
		$('.wrapper').on('click','.prev', myfunction('prevPagination'));
		$('.wrapper').on('click','.pagination li', myfunction('dots'));
	}

	

	myRemoveClass()



	
	
	//live search box
	$('.search-row input').on('keyup', function() {
		var value = $(this).val();
		var patt = new RegExp(value, "i");
		console.log(patt)
		$('#music').find('.active-item').each(function() {
			if (!($(this).find('td').text().search(patt) >= 0)) {
				$(this).not('.myHead').hide();
			}
			if (($(this).find('td').text().search(patt) >= 0)) {
				$(this).show();
			}

		});
	});



	// play video

	$('.wrapper').on('click','.playBtn', function(){
		var videoId 	=	$(this).parents('tr').attr('data-url')
		var videoWidth = $('.video_body').width(),
			videoHeight = $('.video_body').height(),
			iframe = $('<iframe width="'
	                + videoWidth
	                + '" height="'
	                + videoHeight
	                + '" src="https://www.youtube.com/embed/'
	                + videoId
	                + '" frameborder="0" allowfullscreen></iframe>');
		$('.video_body').html(iframe);
		$('.video_box').fadeIn(500)
		$('body').addClass('modal-open');
	});

	$('.modal-close').click(function(){
		$('.video_box').fadeOut(500)
		$('body').removeClass('modal-open');
	})
	
	
})





