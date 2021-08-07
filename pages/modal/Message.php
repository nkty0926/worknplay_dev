
	<!-- .modal#modalFormMessage -->
	<form class="modal needs-validation" id="modalFormMessage" tabindex="-1" role="dialog" aria-hidden="true" autocomplete="off">
		<div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
			<div class="modal-content">
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
			<div class="form-group">
				<h5 class="modal-title">Send a Message To "<span id="modalFormMessageName"><?= $modalFormMessage['name'] ?></span>"</h5>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="title" placeholder="Title*" maxlength="255" required />
			</div>
			<div class="form-group">
				<textarea class="form-control" name="content" rows="5" placeholder="Message*" required></textarea>
			</div>
			<div class="text-right">
				<input type="hidden" name="table" value="<?= $modalFormMessage['table'] ?>" />
				<input type="hidden" name="pk" value="<?= $modalFormMessage['pk'] ?>" />
				<button type="submit" class="btn btn-primary" name="action" value="Message">Send Message</button>
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<script defer>
			$('[data-toggle="modal"][data-target="#modalFormMessage"]').on('click', function(){
				if($(this).data('name'))
					$('#modalFormMessageName').text($(this).data('name'));
				if($(this).data('pk'))
					$('#modalFormMessage').find('input[name="pk"]').val($(this).data('pk'));
				if($(this).data('name') || $(this).data('pk'))
					$('#modalFormMessage').find('input[name="title"], textarea[name="message"]').val('');
			});
			$('#modalFormMessage').on('submit', function(){
				$.ajax({ type: 'post', url: '/actions/Message', data: 'action=Message&' + $(this).serialize(), success: function(result){
					location.reload();
				} }); return false;
			});
		</script>
			</div>
		</div>
	</form>
	<!-- /.modal#modalFormMessage -->
