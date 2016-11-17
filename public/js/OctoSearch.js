	var myresults;
	var supp_Count = 1;

function OctoSearch(){
		$("#octo-table-body").html('');
		var url = "http://octopart.com/api/v3/parts/search";

		url += "?callback=?";
		url += "&apikey=a49294f9";

		var args = {
			q: $("#octo-keyword").val(),
			start: 0,
			limit: 10,
			'filter[queries][]' : 'offers.seller.name:Digi-Key offers.packaging:Cut-Tape',


		};

		$.getJSON(url, args, function(search_response) {

			myresults = search_response['results'];
			$.each(myresults, function(i,result){
				var Description = result.snippet;
				var manuf = result.item.manufacturer.name;
				var mpn = result.item.mpn;
				var offers = result.item.offers;
				var buff ="";
				$('#octo-table-body').append('<tr class="offers">\
					<td>'+ Description+ '</td>\
					<td>' + manuf + '</td>\
					<td>' + mpn + '</td>\
				</tr>\
				<tr class="offer">\
					<td id="offer_td'+i+'" colspan="5"></td></tr>'); 
							$.each(offers, function(j,offer){
								buff += '<tr><td>' + offer.seller.name + '</td><td>' + offer.sku + '</td><td>' + offer.in_stock_quantity + '</td><td><button class="btn btn-primary" onclick="addSupplier('+ i +','+ j +')"><i class="fa fa-plus"></i></button></td></tr>';
							});
							$('#offer_td'+ i).append('<table class="table table-hover"><thead><tr><th>Supplier</th><th>Supplier PN</th><th>Stock</th></tr></thead><tbody>' + buff + '</tbody></table>');
							buff = '';
							
						});


		}).done(function(){
			$('.table-expandable').each(function () {
				var table = $(this);
				table.children('thead').children('tr').append('<th></th>');
				table.children('tbody').children('tr').filter('.offer').hide();
				table.children('tbody').children('tr').filter('.offers').click(function () {
					var element = $(this);
					element.next('.offer').toggle('fast');
					element.find(".table-expandable-arrow").toggleClass("up");
				});
				table.children('tbody').children('tr').filter('.offers').each(function () {
					var element = $(this);
					element.append('<td><div class="table-expandable-arrow"></div></td>');
				});
			});

		});

	}


	function addSupplier(i , j){
		var supplier = myresults[i].item.offers[j].seller.name;
		var supplierPN =  myresults[i].item.offers[j].sku;
		if (supp_Count > 3) {
			$(".wrapper").overhang({
				type: "error",
				message: "You can only add up to 3 supplier links !!!"
				
			});
		}
		else if (1 < supp_Count && supp_Count <= 3) {
			$('#supply_chain').append(
				'<div class="row">	\
				<div class="col-xs-2">\
					<label for="Supplier_'+supp_Count+'">Supplier '+supp_Count+'</label>\
				</div>\
				<div class="col-xs-3">\
					<input type="text" id="Supplier_'+supp_Count+'" class="form-control" placeholder="Supplier '+supp_Count+'">\
				</div>\
				<div class="col-xs-2">\
					<label for="Supplier_Part_Number_'+supp_Count+'">Supplier PN '+supp_Count+'</label>\
				</div>\
				<div class="col-xs-3">\
					<input type="text" id="Supplier_Part_Number_'+supp_Count+'" class="form-control" placeholder="Supplier PN '+supp_Count+'">\
				</div>\
			</div>'
			);
			$('#Supplier_'+supp_Count+'').val(supplier);
			$('#Supplier_Part_Number_'+supp_Count+'').val(supplierPN);
			++supp_Count;
		}
		else if(supp_Count === 1){
			$('#Supplier_1').val(supplier);
			$('#Supplier_Part_Number_1').val(supplierPN);
			++supp_Count;
		}


	}