$(document).ready(function(){

	var mediauploader;
	$('#upload-button').on('click',function(e){

		e.preventDefault();
		if(mediauploader){
			mediauploader.open();
			return;
		}
		mediauploader=wp.media.frames.file_frame=wp.media({
			title:'choose a profile picture',
			button:{
			text:'choose picture'
		},
		multiple: false

		});
		mediauploader.on('select',function(){
			attachment=mediauploader.state().get('selection').first().toJSON();
			$('#profile-picture').val(attachment.url)
		});
		mediauploader.open();
	});
	$('#delete-picture').on('click',function(e){
		e.preventDefault();
		var answer = confirm("Are you sure you want to remove your profile picture ?");
		if( answer == true){
			$('#profile-picture').val('');
			$('.prolific-general-form').submit();
		}
		return;
	});
});