var	token = $('input[name=_token]').val();



//Component Type Selected ************************************************************
$('.btn-table').click(function(){
	$('#CreateButton').prop('disabled', false);
	$('.createType').text($(this).text());
	$('.selected-Type').val($(this).val());

});

//Browse buttons functions ***********************************************************

function CreateNew(){
	$('#showall-div').hide();
	$('#SearchDiv').hide();
	$('#create-new-div').show("fade");
}

function ShowAll(){
	$('#create-new-div').hide();
	$('#SearchDiv').hide();
	$('#showall-div').show("fade");

}

function Search(){
	$('#showall-div').hide();
	$('#create-new-div').hide();
	$('#SearchDiv').show('fade');
}

function ShowWarn() {
	return $(".wrapper").overhang({
				type: "warn",
				message: "Please select component type",
				duration: 2
			});
}

function PopulateRefs(Ref, Attribute) {
	var table = $('.selected-Type').val();
	$.ajax({
			url: window.location.href + '/getRefs',
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			data: {table : table, ref: Ref}
		}).success(function(data){
			$('#'+Attribute+'-select').empty();
			$.each(data, function(key, value){
				$('#'+Attribute+'-select').append('<option value=' + value + '>' + value + '</option>');
			});
			$('#'+Attribute+'Label').hide();
			$('#'+Attribute+'-select').select2();
			$('#'+Attribute+'-select-div').show();
		});
}

      //Prepare Delete ******************************************************************

   function PrepareDelete(btn){
   	
      	$('#dl-type').val($(btn).data('type'));
      	$('#dl-table').val($(btn).data('table'));
      	$('#dl-id').val($(btn).data('id'));
      };



$(document).ready(function(){


//Symbol Toggle ********************************************************************
$('input[name=SymType]').on('ifClicked', function(event){
	var table = $('.selected-Type').val();
	if(event.target.value == 'Existing'){
		if (table == 'null') { 
			return ShowWarn();
		}
		PopulateRefs('Library_Ref', 'symbol');
	}
	else {
		$('#symbol-select-div').hide();
		$('#symbolLabel').show();

	}

});

	//Footprint Toggle *************************************************************
	$('input[name=FTPTType]').on('ifClicked', function(event){
		var table = $('.selected-Type').val();
		if(event.target.value == 'Existing'){
			if (table == 'null') { 
			return ShowWarn();
		}
		PopulateRefs('Footprint_Ref', 'footprint');
		}
		else {

			$('#footprintLabel').show();
			$('#footprint-select-div').hide();

		}

	});

	//Datasheet Toggle *************************************************************
	$('input[name=DSType]').on('ifClicked', function(event){
		var table = $('.selected-Type').val();
		if(event.target.value == 'Existing'){
			if (table == 'null') { 
			return ShowWarn();
		}
		 PopulateRefs('ComponentLink1URL', 'Datasheet');
		}
		else {
			$('#Datasheet-select-div').hide();
			$('#DatasheetLabel').show();
			

		}

	});


	//Show All Clicked **********************************************************************
	$('.ShowAll-btn').click(function(){
		var table = $('.selected-Type').val();
		if (table === '' || table === 'null') {
			$(".wrapper").overhang({
				type: "warn",
				message: "Please select component type",
				duration: 2
			});
		}
		else{
			$.ajax({
				url: window.location.href + '/ShowAll',
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				data: {table : table}
			}).success(function(data){
				$('#show-all-table-body').empty();
				$('#show-all-table-body').append(data);
				$('#show-all-table').DataTable();

			});
		}
	});

		// Search button clicked ***************************************************************
		$('.SearchBtn').click(function(){
			var table = $('.selected-Type').val();
			var SearchBy = $('select[name=SearchBy]').val();
			var keyword = $('input[name=SearchKeyword]').val();
			$.ajax({
				url: window.location.href + '/search',
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				data: {table: table, SearchBy : SearchBy, keyword : keyword}
			}).success(function(partsTable){
				$('#search-result-table-body').empty();
				$('#search-result-table-body').append(partsTable);
				$('#search-result-table').DataTable();
				$('#searchResultDiv').show("fade");
			});
		});


		// Enter Pressed for Ajax ************************************************************
		$('input[name=SearchKeyword]').keyup(function () {
			if (event.keyCode == 13) {
				event.preventDefault();
				$('.SearchBtn').trigger('click');
			}
		});

		$('#octo-keyword').keyup(function () {
			if (event.keyCode == 13) {
				event.preventDefault();
				$('#octoBtn').trigger('click');
			}
		});

	// Confirm delete for Altium Parts ********************************************************
	// $('#confirmDeletePart').on('show.bs.modal', function (e) {

	// 	$type = $(e.relatedTarget).attr('data-type');
	// 	$(this).find('.modal-body input[name=type]').val($type);
	// 	$table = $(e.relatedTarget).attr('data-table');
	// 	$(this).find('.modal-body input[name=table]').val($table);
	// 	$id = $(e.relatedTarget).attr('data-id');
	// 	$(this).find('.modal-body input[name=id]').val($id);

 //      // Pass form reference to modal for submission on yes/ok
 //      var form = $(e.relatedTarget).closest('form');
 //      $(this).find('.modal-footer #confirm').data('form', form);

 //  });
 //      // Form confirm (yes/ok) handler, submits form 
 //      $('#confirmDeletePart').find('.modal-footer #confirm').on('click', function(){
 //      	$(this).data('form').submit();
 //      });


//document Ready function
});

