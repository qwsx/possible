<script type="text/javascript">
		$(function() {
			$( "#query" ).autocomplete({
						source: function(req, add){
							$.getJSON("/machine/tag_json.php?lan=<? echo $lan ?>&callback=?", req, function(data) {
								var suggestions = [];
								$.each(data, function(i, val){								
									suggestions.push(val.name);
								});
								add(suggestions);
							});
						}
			});
		});
</script>