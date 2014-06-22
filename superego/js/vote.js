
$(function(){

	$("a.vote_up").click(
    function(){
    	the_id = $(this).attr('id');
		$.ajax({
			type: "POST",
			data: "action=vote_up&id="+$(this).attr("id"),
			url: "votes.php",
			success: function(msg)
			{
				$("span#votes_count"+the_id).html(msg);
				$("span#votes_count"+the_id).fadeIn();
			}
		});
	});
	

	$("a.vote_down").click(
    function(){
    	the_id = $(this).attr('id');
	
		$.ajax({
			type: "POST",
			data: "action=vote_down&id="+$(this).attr("id"),
			url: "votes.php",
			success: function(msg)
			{
				$("span#votes_count"+the_id).html(msg);
				$("span#votes_count"+the_id).fadeIn();
			}
		});
	});


});	
