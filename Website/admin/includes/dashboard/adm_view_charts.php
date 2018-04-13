<div class="row">
	<div class="col-lg-12">
		<table class="table table-bordered table-hover" id="view-all">
			<thead>
				<tr>
					<th class="text-center">Posts</th>
					<th class="text-center">Comments</th>
					<th class="text-center">Users</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<tr>
					<td><div id="post_chart_div"></div></td>
					<td><div id="com_chart_div"></div></td>
					<td><div id="user_chart_div"></div></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	google.charts.load( 'current', {
		'packages': [ 'corechart' ]
	} );

	google.charts.setOnLoadCallback( drawPostChart );
	google.charts.setOnLoadCallback( drawCommentChart );
	google.charts.setOnLoadCallback( drawUserChart );

	function drawPostChart() {
		var data = new google.visualization.DataTable();
		data.addColumn( 'string', 'Topping' );
		data.addColumn( 'number', 'Slices' );
		data.addRows( [
			[ 'Published', <?php echo $post_pub_count; ?> ],
			[ 'Draft', <?php echo $post_draft_count; ?> ]
		] );
		var options = {
			width: 300,
			height: 300,
			colors: [ '#337ab7', 'blue' ],
			legend: {
				position: 'none',
			},
		};
		var chart = new google.visualization.PieChart( document.getElementById( 'post_chart_div' ) );
		chart.draw( data, options );
	}

	function drawCommentChart() {
		var data = new google.visualization.DataTable();
		data.addColumn( 'string', 'Topping' );
		data.addColumn( 'number', 'Slices' );
		data.addRows( [
			[ 'Approved', <?php echo $com_app_count; ?> ],
			[ 'Unapproved', <?php echo $com_unapp_count; ?> ]
		] );
		var options = {
			width: 300,
			height: 300,
			colors: [ '#5cb85c', 'green' ],
			legend: {
				position: 'none',
			},
		};
		var chart = new google.visualization.PieChart( document.getElementById( 'com_chart_div' ) );
		chart.draw( data, options );
	}

	function drawUserChart() {
		var data = new google.visualization.DataTable();
		data.addColumn( 'string', 'Topping' );
		data.addColumn( 'number', 'Slices' );
		data.addRows( [
			[ 'User', <?php echo $normal_user_count; ?> ],
			[ 'Sub', <?php echo $sub_count; ?> ],
			[ 'Admin', <?php echo $admin_count; ?> ]
		] );
		var options = {
			width: 300,
			height: 300,
			colors: [ '#f0ad4e', 'darkorange', 'orange' ],
			legend: {
				position: 'none',
			},
		};
		var chart = new google.visualization.PieChart( document.getElementById( 'user_chart_div' ) );
		chart.draw( data, options );
	}
</script>