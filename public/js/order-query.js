$(document).ready(function(){	
	$('select').select2({
		width: '100%'
	});
	var spinner = new Spinner().spin()
	$('.load').append(spinner.el)
})

$('#header').change(function(){
	$.ajax({
		url: '/api/orders/'+$(this).val(),
		method: 'POST',
		beforeSend: function(){
			$('#line-select').prop('disabled', true)
			$('#line-select').children().remove();
			$('.load').fadeIn();
		},
		success: function(data){
			$.each(data, function(id, value){
				$('#line-select').append('<option value="'+value+'">'+value+'</option>');
			});
		},
		complete: function(){
			$('.load').fadeOut();
			$('#line-select').prop('disabled', false);			
		}
	})
});