
	<!-- .modal#modalFormReplyMessage -->
	<form class="modal needs-validation" id="modalFormReplyMessage" method="post" action="" tabindex="-1" role="dialog" aria-hidden="true" autocomplete="off">
		<div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
			<div class="modal-content">
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
			<div class="form-group">
				<h5 class="modal-title">Reply Message To "<span id="modalFormReplyMessageName"></span>"</h5>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="title" placeholder="Title*" maxlength="255" required />
			</div>
			<div class="form-group">
				<textarea class="form-control" name="content" rows="5" placeholder="Message*" required></textarea>
			</div>
			<div class="text-right">
				<input type="hidden" name="parent" value=""/>
				<button type="submit" class="btn btn-primary" name="action" value="ReplyMessage">Send Message</button>
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<script defer>
			$('[data-toggle="modal"][data-target="#modalFormReplyMessage"]').on('click', function(){
				$('#modalFormReplyMessageName').text($(this).data('name'));
				$('#modalFormReplyMessage').find('input[name="parent"]').val($(this).data('parent'));
				$('#modalFormReplyMessage').find('input[name="title"], textarea[name="content"]').val('');
			});
		</script>
			</div>
		</div>
	</form>
	<!-- /.modal#modalFormReplyMessage -->
