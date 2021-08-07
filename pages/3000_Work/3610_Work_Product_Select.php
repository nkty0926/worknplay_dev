<?php include_once 'pages/3000_Work/3000_Work_header.php'; $products = $CONF['products']; ?>
	<!-- form#formSelectProduct -->
	<form class="py-3 py-lg-5" id="formSelectProduct" method="post" action="/Work/Product/Order">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-12">

			<h3><?= $products[0] ?></h3>

			<!-- table : <?= $products[0] ?> -->
			<table class="table table-bordered table-hover text-center">
				<thead class="thead-light">
					<tr>
						<th width="50%">PACKAGE</th>
						<th width="30%">PRICE</th>
						<th width="20%">SELECT</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<p class="mb-0">Hot Job post appears on the board for 7 days. If you want to post longer, each day costs an additional 30,000 KRW. Do you wish to add more days?</p>
							<p class="mb-0"><strong>7</strong> Days + <input type="number" class="text-center" name="credit_hot_quantity" placeholder="0" min="0" /> Additional Day(s)</p>
						</td>
						<td class="align-middle"><strong id="credit_hot_quantity">7</strong> Days <span id="credit_hot_price" style="margin-left:.5em;">&#8361; 275,000</span></td>
						<td class="align-middle"><input type="checkbox" name="credit_hot" /></td>
					</tr>
				</tbody>
			</table>
			<!-- /table : <?= $products[0] ?> -->

			<h3><?= $products[1] ?></h3>

			<!-- table : <?= $products[1] ?> -->
			<table class="table table-bordered table-hover text-center">
				<thead class="thead-light">
					<tr>
						<th width="50%">PACKAGE</th>
						<th width="30%">PRICE</th>
						<th width="20%">SELECT</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1 Post</td>
						<td>&#8361; 55,000</td>
						<td><input type="checkbox" name="credit_job" /></td>
					</tr>
					<tr>
						<td>3 Posts</td>
						<td>&#8361; 132,000</td>
						<td><input type="checkbox" name="credit_job" /></td>
					</tr>
					<tr>
						<td>5 Posts</td>
						<td>&#8361; 165,000</td>
						<td><input type="checkbox" name="credit_job" /></td>
					</tr>
				</tbody>
			</table>
			<!-- /table : <?= $products[1] ?> -->

			<h3><?= $products[2] ?></h3>

			<!-- table : <?= $products[2] ?> -->
			<table class="table table-bordered table-hover text-center">
				<thead class="thead-light">
					<tr>
						<th width="50%">PACKAGE</th>
						<th width="30%">PRICE</th>
						<th width="20%">SELECT</th>
					</tr>
				</thead>
				<tbody>
<?php if(false){ ?>
					<!-- <tr>
						<td>7 Days</td>
						<td>&#8361; 33,000</td>
						<td><input type="checkbox" name="credit_resume" /></td>
					</tr> -->
					<!-- <tr>
						<td>14 Days</td>
						<td>&#8361; 59,400</td>
						<td><input type="checkbox" name="credit_resume" /></td>
					</tr> -->
					<!-- <tr>
						<td>21 Days</td>
						<td>&#8361; 79,200</td>
						<td><input type="checkbox" name="credit_resume" /></td>
					</tr> -->
					<!-- <tr>
						<td>28 Days</td>
						<td>&#8361; 92,400</td>
						<td><input type="checkbox" name="credit_resume" /></td>
					</tr> -->
<?php } ?>
					<tr>
						<td>14 Days</td>
						<td>&#8361; 60,000</td>
						<td><input type="checkbox" name="credit_resume" /></td>
					</tr>
					<tr>
						<td>28 Days</td>
						<td>&#8361; 80,000</td>
						<td><input type="checkbox" name="credit_resume" /></td>
					</tr>
				</tbody>
			</table>
			<!-- /table : <?= $products[2] ?> -->

			<h3>My Order</h3>

			<!-- table : My Order -->
			<table class="table table-bordered table-hover text-center" id="tableMyOrder">
				<thead>
					<tr class="table-primary">
						<th width="50%">PRODUCT</th>
						<th width="30%">PACKAGE</th>
						<th width="20%">PRICE</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2">Total (including VAT)</td>
						<td>&#8361; 0</td>
					</tr>
				</tfoot>
			</table>
			<!-- /table : My Order -->

			<!-- .row : Check Out -->
			<div class="row justify-content-center">
				<div class="col-4">
					<button type="submit" class="btn btn-light btn-block" disabled>CHECK OUT</button>
				</div>
			</div>
			<!-- /.row : Check Out -->

		</section>
		<!-- /section -->

			</div>
		</div>
	</form>
	<!-- /form -->

	<script defer>
		$('#formSelectProduct input[type="checkbox"]').on('change', function(){
			$(this).parents('table').find('input[type="checkbox"]').not(this).prop('checked', false);
			formSelectProduct();
		});
		$('#formSelectProduct input[name="credit_hot_quantity"]').on('change', function(){
			var credit_hot_quantity = $(this).val()?parseInt($(this).val()):0;
			$('#credit_hot_quantity').text(7 + credit_hot_quantity);
			$('#credit_hot_price').text('₩ ' + Number(275000 + credit_hot_quantity*30000).toLocaleString('en'));
			$('input[type="checkbox"][name="credit_hot"]').prop('checked', true);
			formSelectProduct();
		});
		$('#formSelectProduct').on('submit', function(){
			$('#tableMyOrder>tbody>tr').each(function(){
				$(this).append('<input type="hidden" name="credit_product[]" value="' + $(this).find('td:first-child').text() + '"/>');
				$(this).append('<input type="hidden" name="credit_package[]" value="' + $(this).find('td:nth-child(2)').text().replace(/[^0-9]/g, '') + '"/>');
				$(this).append('<input type="hidden" name="credit_price[]" value="' + $(this).find('td:nth-child(3)').text().replace(/[^0-9]/g, '') + '"/>');
			});
			$('#tableMyOrder>tfoot>tr').append('<input type="hidden" name="credit_total" value="' + $('#tableMyOrder>tfoot>tr>td:last-child').text().replace(/[^0-9]/g, '') + '"/>');
		});
		function formSelectProduct(){
			$('#tableMyOrder>tbody').empty();
			if($('input[type="checkbox"][name="credit_hot"]').prop('checked')){
				var credit_hot_quantity = $('input[name="credit_hot_quantity"]').val()?parseInt($('input[name="credit_hot_quantity"]').val()):0;
				$('#tableMyOrder>tbody').append(
					$('<tr></tr>').html([
						'<td><?= $products[0] ?></td>',
						'<td>' + (7 + credit_hot_quantity) + ' Days </td>',
						'<td>₩ ' + Number(275000 + credit_hot_quantity*30000).toLocaleString('en') + '</td>'
					])
				);
			}
			$('input[type="checkbox"][name="credit_job"]').each(function(){
				if($(this).prop('checked')){
					$('#tableMyOrder>tbody').append(
						$('<tr></tr>').html([
							'<td><?= $products[1] ?></td>',
							'<td>' + $(this).parent().prev().prev().text() + '</td>',
							'<td>' + $(this).parent().prev().text() + '</td>'
						])
					);
				}
			});
			$('input[type="checkbox"][name="credit_resume"]').each(function(){
				if($(this).prop('checked')){
					$('#tableMyOrder>tbody').append(
						$('<tr></tr>').html([
							'<td><?= $products[2] ?></td>',
							'<td>' + $(this).parent().prev().prev().text() + '</td>',
							'<td>' + $(this).parent().prev().text() + '</td>'
						])
					);
				}
			});
			var total = 0;
			$('#tableMyOrder>tbody>tr>td:last-child').each(function(){
				total += parseInt($(this).text().replace(/[^0-9]/g, ''));
			});
			$('#tableMyOrder>tfoot>tr>td:last-child').html('₩ ' + Number(total).toLocaleString('en'));
			if($('input[type="checkbox"]:checked').length)
				$('button[type="submit"]').prop('disabled', false);
			else $('button[type="submit"]').prop('disabled', true);
		}
	</script>